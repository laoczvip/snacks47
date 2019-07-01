<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ShakysController extends Controller
{
    /**
     * 加载添加商品列表
     * @return  [type] [index]
     */
    public function Index(Request $request)
    {
    	$id = $request->input('id',0);
        //显示商品表
    	$shop = DB::table('goods')->paginate(10);
        //显示秒杀表
        $shakys = DB::table('shaky_sku')->get();
        $list = [];
        foreach($shakys as $k=>$v){
            $list[$v->gid] = $v->gid;
        }
        
    	//$shaky = DB::table('shaky')->where('id',$id)->first();
    	return view('admin.shakys.index',['shop'=>$shop,'ids'=>$id,'list'=>$list]);
    }
    /**
     * 加载添加页面
     * @return  [type] [create]
     */
    public function Create(Request $request)
    {
        
    	$id = $request->input('id',0);
        $sid = $request->input('sid',0);
        
        //确认该商品是否已经添加过
        $shaky = DB::table('shaky_sku')->where('gid',$id)->first();
         if($shaky){
            return back()->with('error','该商品已添加到活动列');
        }
    	$goods = DB::table('goods')->where('id',$id)->first();
    	$goods_sku = DB::table('goods_sku')->where('gid',$id)->first();
    	return view('admin/shakys/create',['id'=>$id,'goods'=>$goods,'goods_sku'=>$goods_sku,'sid'=>$sid]);
    }
    /**
     * 加入活动表
     * @return  [type] [insert]
     */
    public function Shore(Request $request)
    {

        
       
        // form 判断
        $stock = $request->input('stock','');
        $stock1 = $request->input('stock1','');
        $original = $request->input('original',0);
        $preferential = $request->input('preferential',0);

        $data = $request->except('_token','stock','stock1');
        if($stock>=$stock1||$stock<0){
            return back()->with('error','库存数量不能大于原库存或小于0');
        }
        if($preferential>$original||$preferential<0){
            return back()->with('error','优惠金额不能大于原价或小于0');
        }
        $data = $this->validate($request,[
                'stock' => 'required',
                'sid' => 'required',
                'gid' => 'required',
                'original' => 'required',
                'preferential' => 'required',                
            ],[
                'stock.required'=>'库存不能为空',
                'sid.required'=>'所属类不能为空',
                'gid.required'=>'商品id不能为空',
                'original.required'=>'原金额不能为空',
                'preferential.required'=>'优惠金额不能为空',
            ]);  
      
       $res = DB::table('shaky_sku')->insert($data);
       if($res){
        //商品id
           $gid =  $data['gid'];
           $goods_sku = DB::table('goods_sku')->where('gid',$gid)->first();

           $res_data['stock'] = $goods_sku->stock - $data['stock'];
           $res_datas['sid'] = $request->input('sid',0);

           $res_D =  DB::table('goods_sku')->where('gid',$gid)->update($res_data);
           $res_F =  DB::table('goods')->where('id',$gid)->update($res_datas);
           if($res_D&&$res_F){  
                return redirect('admin/shakys/index?id='.$res_datas['sid'])->with('success','成功加入');
           }
       } else {
            return back()->with('error','新添秒杀商品失败');
       }       
    }
    /**
     * 加载活动页面
     * @return  [type] [create]
     */
    public function Show(Request $request)
    {
        
        $id = $request->input('id',0);
      
        //确认该商品是否已经添加过
        $shaky = DB::table('shaky_sku')->where('sid',$id)->paginate(10);
      
        return view('admin/shakys/show',['shaky'=>$shaky,'sid'=>$id]);
    }
    /**
     * 加载修改活动商品页面
     * @return  [type] [edit]
     */
    public function Edit(Request $request)
    {
        $id = $request->input('id',0);
        $shaky = DB::table('shaky_sku')->where('id',$id)->first();
        return view('admin.shakys.edit',['shaky'=>$shaky]);
    }
    /**
     * 压入修改活动商品
     * @return  [type] [update]
     */
    public function Update(Request $request)
    {
        //获取原库存和新库存
        $stock = $request->input('stock',0);
        $stock1 = $request->input('stock1',0);
        //获取原价和优惠
        $original = $request->input('original',0);
        $preferential = $request->input('preferential',0);     
        if($stock<0){
             
            return back()->with('error','库存数量小于0');
        }
        if($preferential>$original||$preferential<0){
            return back()->with('error','优惠金额不能大于原价或小于0');
        }
          // form 判断
        $data = $this->validate($request,[
                'stock' => 'required',
                'gid' => 'required',
                'original' => 'required',
                'preferential' => 'required',             
            ],[
                'stock.required'=>'库存不能为空',
                'gid.required'=>'商品id不能为空',
                'original.required'=>'原金额不能为空',
                'preferential.required'=>'优惠金额不能为空',
            ]);   
        $id = $request->input('id',0); //活动id
        $gid = $request->input('gid',0); //商品id
        $sid = $request->input('sid',0); //活动类id
        $goods = DB::table('goods_sku')->where('gid',$gid)->first(); //查看商品表
        $goods_stock = $goods->stock;
        $gid_data['stock'] = ($stock1-$stock) + $goods_stock;  //操作活动商品的库存和原商品库存
        
        $shaky = DB::table('shaky_sku')->where('gid',$gid)->update($data); //修改活动表
        if($shaky){     
                $goods_data = DB::table('goods_sku')->where('gid',$gid)->update($gid_data); //修改商品表
                if($goods_data){
                return redirect('admin/shakys/show?id='.$sid)->with('success','修改成功');
                } else {
                    return back()->with('error','修改失败');
                }
            }    
    }
    /**
     * 删除活动商品
     * @return  [type] [del]
     */
    public function Del(Request $request)
    {
        $id = $request->input('id',0);
        $shaky_sku = DB::table('shaky_sku')->where('id',$id)->first();
            if($shaky_sku->stock==0){
                $shaky = DB::table('shaky_sku')->where('id',$id)->delete();
             if($shaky){
                echo json_encode('ok');
             } else{
                echo json_encode('err');
             }
            } else{
                echo json_encode('errr');
            }
            
        
       
    }
}
