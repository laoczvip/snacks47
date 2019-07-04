<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Comment;
use DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     * 显示评论列表
     * @return \Illuminate\Http\Response
     */
    public function Index()
    {
        //商品名赋值
        $goods = DB::table('goods_sku')->get();

        $goods_sku = [];
        foreach($goods as $v){
            $goods_sku[$v->id] = $v->title; 
        }

        // 分页查询数据
        $comment = Comment::paginate(2);
        //用户名赋值
        $user = Users::all();
        $list = [];
        foreach($user as $v){
            $list[$v->id] = $v->name;
        }
        
        // 显示评论 列表
        return view('admin.comment.index',['comment' => $comment,'list'=>$list,'goods_sku'=>$goods_sku]);
    }

    /**
     * Show the form for creating a new resource.
     * 评论 添加 
     * @return \Illuminate\Http\Response
     */
    public function Create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Store(Request $request)
    {
        //
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
     * 评论 删除
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Destroy($id)
    {
        //
    }
}
