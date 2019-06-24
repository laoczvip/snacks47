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

    public function tree($data,$pid)
    {
        static $list = [];
        foreach($data as $k=>$v){
            if($pid==$v->pid){
                $list[] = $v;
                return $this->tree($data,$v->id);
            }
        }
    }
    //公共商品分类
    public static function Cates_data($pid=0)
    {
        $cates  = Cates::all();
        static $list = []; 
        foreach($cates as $k=>$v){
            if($pid==$v->pid){
                $list[] = $v;
                static::Cates_data($v->id);
            }
        }
        return $list;
        
    }
    //分类名
    public static function Cates_name()
    {
        $cates  = Cates::all();
        $cates_name = [];
        foreach($cates as $k=>$v){
            $cates_name[$v->id] = $v->title;
        }

        return $cates_name;
    }
    //商品属性
    public static function Flavour()
    {
        $flavour = DB::table('flavour')->get();
        $list = [];
        foreach($flavour as $k=>$v){ 
            $list[$v->id] = $v->fname;
        }

        return $list;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
    public function create()
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //商品添加
       
        $goods_data['title'] = $request->input('title',''); 
        $goods_data['created_at'] = date('Y-m-d H:i:s',time());
       

       
       
        $goods = goods::insert($goods_data);

        $goods_sel = goods::orderBy('id','desc')->first();
        $gid = $goods_sel->id;
       
        if($goods){
             $goodssku_data = $request->all('title','flavorties','price','stock','weight','status','desc');
             $goodssku_data['gid'] = $gid;
             $goodssku_data['original'] = $request->input('original',0);
             $goodssku_data['parameter'] = $request->input('parameter','');
             if($request->hasFile('showcase')){
             $goodssku_data['showcase'] = $request->file('showcase')->store(date('Ymd'));
             } else {
                 $goodssku_data['showcase'] = 0;
             }
             $goodssku_data['created_at'] = $goods_data['created_at'];
             $goodssku_data['cid'] = $request->input('cid',0);
             $goodssku = DB::table('goods_sku')->insert($goodssku_data);
             if($goodssku){
                return redirect('/admin/goods/create')->with('success','添加成功');
             } else {
                return back()->with('error','添加失败');
             }
        }
       
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->input('id',0);
        $goods_sku = DB::table('goods_sku')->where('cid',$id)->first();
        $cates = GoodsController::Cates_data();
         foreach($cates as $k=>$v){
            $n = substr_count($v->path,',');
            $cates[$k]->title = str_repeat('|--', $n).$v->title; 
        }
        $cates_name = GoodsController::Cates_name();
        $flavour = DB::table('flavour')->get();
        $flavour_data = GoodsController::Flavour();
        return view('admin.goods.edit',['cates'=>$cates,'goods_sku'=>$goods_sku,'cates_name'=>$cates_name,'flavour'=>$flavour,'flavour_data'=>$flavour_data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //商品id
        $id = $request->input('id',0);
        
         //接收值
        $data['title'] = $request->input('title','');
        $data['flavorties'] = $request->input('flavorties','');
        $data['price'] = $request->input('price',0);
        $data['stock'] = $request->input('stock',0);
        $data['weight'] = $request->input('weight',0);
        $data['status'] = $request->input('status',-1);
        $data['desc'] = $request->input('desc','');
        $data['original'] = $request->input('original',0);
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
        if($res){
            $data_sku['title'] = $request->input('title','');
           

            $sku = DB::table('goods')->where('id',$id)->update($data_sku);
            if($sku){
                return redirect('admin/goods/create')->with('success','修改成功');
            } else {
                return back()->with('error','插入goods修改失败');
            }
        } else {
            return back()->with('error','goods_sku没修改');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {   
      
    }
    public function del(Request $request)
    {
       $id = $request->input('id',0);

       $store = DB::table('goods_sku')->where('id',$id)->first();
       dd($store);
       $sto = $store->stock; 
       if($sto==0){
            DB::table('goods_sku')->delete($id);
            echo json_encode('ok');
       } else {
            echo json_encode('err');
       }
       

    }
}
