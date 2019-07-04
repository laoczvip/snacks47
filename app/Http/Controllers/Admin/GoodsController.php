<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\goods;
use App\Models\Cates;
use DB;
use Illuminate\Support\Facades\Storage;
class GoodsController extends Controller
{

    /**
     *分类排序
     *@return   [array,pid]
     */
    public function tree($data,$pid)
    {
        static $list = [];
        foreach($data as $k=>$v){
            if($pid == $v->pid){
                $list[] = $v;
                return $this->tree($data,$v->id);
            }
        }
    }
    /**
     * 公共商品分类排序
     * @param integer [$pid]
     * @return   [$list]
     */
    public static function Cates_data($pid=0)
    {
        $cates  = Cates::all();
        static $list = [];
        foreach($cates as $k=>$v){
            if($pid == $v->pid){
                $list[] = $v;
                static::Cates_data($v->id);
            }
        }
        return $list;

    }
    /**
     * 分类名赋值
     * @return   [array]
     */
    public static function Cates_name()
    {
        $cates  = Cates::all();
        $cates_name = [];
        foreach($cates as $k=>$v){
            $cates_name[$v->id] = $v->title;
        }

        return $cates_name;
    }
    /**
     * 商品属性赋值
     * @return   [array]
     */
    public static function Flavour()
    {
        $flavour = DB::table('flavour')->get();
        $list = [];
        foreach($flavour as $k=>$v){
            $list[$v->touch][] = $v->fname;
        }

        return $list;
    }
    /**
     * 商品列表
     *
     * @return [type] [视图]
     */
    public function Index(Request $request)
    {

        //搜索cid
        $cid = $request->input('cid',0);
        //搜索商品名称
        $name = $request->input('name','');
        if($name!=null){

            $goods_sku = DB::table('goods_sku')->orderBy('created_at','desc')->where('title','like','%'.$name.'%')->paginate(5);

        } else if($cid!=0){

             $goods_sku = DB::table('goods_sku')->where('cid',$cid)->orderBy('created_at','desc')->paginate(5);
        } else {
             $goods_sku = DB::table('goods_sku')->orderBy('created_at','desc')->paginate(5);
        }

        //显示所有类，排序
        $cates = GoodsController::Cates_data();
        //显示已id为键 名字为值的类
        $cates_name = GoodsController::Cates_name();
        $flavour_data = GoodsController::Flavour();


        return view('admin.goods.index',[
            'cates'=>$cates,
            'cates_name'=>$cates_name,
            'goods_sku'=>$goods_sku,
            'flavour_data'=>$flavour_data,
            'cid' =>$cid,
            'name'=>$name,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Create()
    {

        $cates = GoodsController::Cates_data();

        foreach($cates as $k=>$v){
            $n = substr_count($v->path,',');
            $cates[$k]->title = str_repeat('|--', $n).$v->title;
        }
        $flavour = DB::table('flavour')->get();

        return view('admin.goods.create',['cates'=>$cates,'flavour'=>$flavour]);
    }

    /**
     * 商品添加
     *
     * @param  Request  $request [接收新商品数据]
     * @return [bool] [视图跳转]
     */
    public function Store(Request $request)
    {
        $data = $this->validate($request,[
                'title' => 'required|regex:/^.{1,255}$/',
                'showcase' => 'required',
                'fname' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'status' => 'required',
                'parameter' => 'required',
                'desc' => 'required',
            ],[
                'title.required'=>'商品名称不能为空',
                'title.regex'=>'输入的值不能为数字且6-255字符',
                'showcase.required'=>'展示图不能为空',
                'fname.required'=>'商品属性不能为空',
                'price.required'=>'商品价格不能为空',
                'stock.required'=>'商品库存不能为空',
                'status.required'=>'商品名称不能为空',
                'parameter.required'=>'商品参数不能为空',
                'desc.required'=>'商品详情不能为空',
            ]);

        //商品添加

        $goods_data['title'] = $request->input('title','');
        $goods_data['created_at'] = date('Y-m-d H:i:s',time());

        $touch = date('YmdHis');
        $goodssku_data = $touch;
        $touchs = $request->except('cid','title','price','stock','status','desc','_token','showcase','parameter');


        $list = $touchs['fname'];
        $count = count($list);
        $lists = [];
        for($i=0;$i<$count;$i++){
            $lists[]['fname'] = $list[$i];
            $lists[$i]['touch']=$touch;
        }
        $flavours = DB::table('flavour')->insert($lists);
        if($flavours){
            $goods_data['sid'] = 0;
        $goods = goods::insert($goods_data);

        $goods_sel = goods::orderBy('id','desc')->first();
        $gid = $goods_sel->id;

        if($goods){
             $goodssku_data = $request->all('title','price','stock','status','desc','parameter');
             $goodssku_data['gid'] = $gid;

             $goodssku_data['parameter'] = $request->input('parameter','');
             if($request->hasFile('showcase')){
             $goodssku_data['showcase'] = $request->file('showcase')->store(date('Ymd'));
             } else {
                 $goodssku_data['showcase'] = 0;
             }
             $goodssku_data['touch'] = $touch;
             $goodssku_data['created_at'] = $goods_data['created_at'];
             $goodssku_data['cid'] = $request->input('cid',0);
             $goodssku = DB::table('goods_sku')->insert($goodssku_data);

             if($goodssku){
                return redirect('/admin/goods')->with('success','添加成功');
             } else {
                return back()->with('error','添加失败');
             }
           }
        }
    }

    /**
     * 加载修改页面
     * @param  Request $request [商品id]
     * @return [view]           [视图跳转]
     */
    public function Edit(Request $request)
    {
        $id = $request->input('id',0);
        $goods_sku = DB::table('goods_sku')->where('gid',$id)->first();

        $cates = GoodsController::Cates_data();
         foreach($cates as $k=>$v){
            $n = substr_count($v->path,',');
            $cates[$k]->title = str_repeat('|--', $n).$v->title;
        }
        $cates_name = GoodsController::Cates_name();
        $flavour = DB::table('flavour')->get();
        $flavour_data = GoodsController::Flavour();
        return view('admin.goods.edit',[
            'cates'=>$cates,
            'goods_sku'=>$goods_sku,
            'cates_name'=>$cates_name,
            ]);
    }

      /**
       * [update 商品修改]
       * @param  Request $request [需要更新的字段]
       * @return [view]           [视图跳转]
       */
    public function Update(Request $request)
    {
          $data = $this->validate($request,[
                'title' => 'required|regex:/^.{6,255}$/',
                'price' => 'required',
                'stock' => 'required',
                'status' => 'required',
                'parameter' => 'required',
                'desc' => 'required',
            ],[
                'title.required'=>'商品名称不能为空',
                'title.regex'=>'输入的值不能为数字且6-255字节之间(一个汉字为三个字节)',
                'price.required'=>'商品价格不能为空',
                'stock.required'=>'商品库存不能为空',
                'status.required'=>'商品名称不能为空',
                'parameter.required'=>'商品参数不能为空',
                'desc.required'=>'商品详情不能为空',
            ]);
        //商品id
        $id = $request->input('id',0);
         //接收值
        $data['title'] = $request->input('title','');

        $data['price'] = $request->input('price',0);
        $data['stock'] = $request->input('stock',0);
        $data['status'] = $request->input('status',-1);
        $data['desc'] = $request->input('desc','');
        $data['parameter'] = $request->input('parameter',0);
        //类id
        $data['cid'] = $request->input('cid','');

        if($request->hasFile('showcase')){
            $data['showcase'] = $request->file('showcase')->store(date('Ymd'));
            if(!empty($request->input('showcase'))){
                Storage::delete($request->input('showcate'));
            }
        } else {
            $data['showcase'] = $request->input('showcase','');
        }

        $res =  DB::table('goods_sku')->where('gid',$id)->update($data);

       
            $data_sku['title'] = $request->input('title','');
            $data_sku['sid'] = 0;

            $sku = DB::table('goods')->where('id',$id)->update($data_sku);
            if($sku||$res){
                return redirect("admin/goods")->with('success','修改成功');
            } else {
                return back()->with('error','修改失败');
            }
        } 
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * 删除商品
     * @param  Request $request [商品id]
     * @return [json]           [是否删除成功]
     */
    public function Del(Request $request)
    {
       $id = $request->input('id',0);

       $store = DB::table('goods_sku')->where('id',$id)->first();
       $sto = $store->status;
       if($sto != 0){
            DB::table('goods_sku')->delete($id);
            echo json_encode('成功删除');
       } else {
            echo json_encode('商品正上架中');
       }


    }
}

