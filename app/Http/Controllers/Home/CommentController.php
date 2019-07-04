<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Weds;
use DB;
use App\Models\Comment;

class CommentController extends Controller
{

    /**
     * Display a listing of the resource.
     * 获取商品属性
     * @return \Illuminate\Http\Response
     */
    public function Good()
    {
        $comment = DB::table('goods_sku')->get();
        return $comment;
    }

    /**
     * Display a listing of the resource.
     * 获取商品名
     * @return \Illuminate\Http\Response
     */
    public function Goods_Name()
    {
        $goods = CommentController::Good();
        
        $list = [];
        foreach($goods as $k=>$v){
            $list[$v->id] = $v->title;
        }
        return $list;
    }

    /**
     * Display a listing of the resource.
     * 获取商品图片
     * @return \Illuminate\Http\Response
     */
    public function Goods_ProFile()
    {
        $goods = CommentController::Good();
        $list = []; 
        foreach($goods as $k=>$v){
            $list[$v->id] = $v->showcase;
        }
        return $list;   
    }

    /**
     * Display a listing of the resource.
     * 获取商品价格
     * @return \Illuminate\Http\Response
     */
    public function Goods_Price()
    {
        $goods = CommentController::Good();
        $list = [];
        foreach($goods as $k=>$v){
            $list[$v->id] = $v->price;
        }
        return $list;
    }
    
     /**
     * Display a listing of the resource.
     * 获取商品口味
     * @return \Illuminate\Http\Response
     */
    public function Order_details()
    {
        //商品属性
        $goods = DB::table('order_details')->get();
        $list = [];
        foreach($goods as $k=>$v){
            $list[$v->gid][] = $v;
        }
        
        return $list;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index(Request $request)
    {
        $data = DB::table('comment');
        $uid = session('home_user')->id;
        $oid = $request->input('oid',0);
        $comment = DB::table('order_details')->where('oid',$oid)->get();
        $Goods_Name = CommentController::Goods_Name();
        $Goods_Profile = CommentController::Goods_ProFile();
        $Order_details = CommentController::Order_details();
        $count = ShopcartController::CountCar();
        $weds = weds::find(1);
        $friendly = DB::table('friendly')->where('lstatus',1)->get();
        $comments = DB::table('comment')->where('uid',$uid)->orderBy('created_at','desc')->paginate(30);

        return view('home.comment.index',[
            'count'=>$count,
            'weds'=>$weds,
            'friendly'=>$friendly,
            'comment'=>$comment,
            'Goods_Name'=>$Goods_Name,
            'Goods_Profile'=>$Goods_Profile,
            'Order_details'=>$Order_details,
            'comments'=>$comments,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Create(Request $request)
    {
        $oid = $request->input('oid',0);
        $comment = DB::table('order_details')->where('oid',$oid)->get();
        $Goods_Name = CommentController::Goods_Name();
        $Goods_Profile = CommentController::Goods_ProFile();
        $Goods_Price = CommentController::Goods_Price();
        $Order_details = CommentController::Order_details();
        // dd($Order_details);
        
        $count = ShopcartController::CountCar();
        $weds = weds::find(1);
        $friendly = DB::table('friendly')->where('lstatus',1)->get();
        $uid = session('home_user')->id;
       
                
        // dd($uid);
        // echo "222";
        return view('home.Comment.create',[
            'count'=>$count,
            'weds'=>$weds,
            'friendly'=>$friendly,
            'comment'=>$comment,
            'Goods_Name'=>$Goods_Name,
            'Goods_Profile'=>$Goods_Profile,
            'Goods_Price'=>$Goods_Price,
            'Order_details'=>$Order_details,
            'oid'=>$oid,

            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Store(Request $request)
    { 
         // 文件上传
        
        
        $list = $request->except('_token');
        $a = count($list['gid']);
            $data['gid'] = $list['gid'];
            $data['content'] = $list['content'];
            $data['rank'] = $list['rank'];
            $orderId = $request->input('orderId',0);
            $oid = $request->input('oid',0);
            $arr = [];
            $len = count($data['gid']);

            for($i = 0;$i < $len;$i++){
                $arr['gid'] = $data['gid'][$i];
                $arr['content'] = $data['content'][$i];
                $arr['rank'] = $data['rank'][$i];
                $arr['uid'] = $list['uid'];
                $arr['created_at'] = date('Y-m-d H:i:s');
                $arr['orderId'] = $orderId;
                $res =  DB::table('comment')->insert($arr);
            }

            if ($res) {
                return redirect("/center/order")->with('success','添加成功');
            } else {
                return back()->with('error','添加失败');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * 评论 删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Destroy(Request $request)
    {
        
        $id = $request->input('id',0);
        // 执行删除
        // $res = comment::destroy($id);
        $res = DB::table('comment')->where('id',$id)->delete();

        if($res){
                echo json_encode('删除成功');
            }else{
                echo json_encode('删除失败');
            }
    }
}
