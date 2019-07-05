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
     * 显示评论列表
     * @return \Illuminate\Http\Response
     */
    public function Index(Request $request)
    {
        // 接收搜索的参数
        $find = $request->input('find','');

        //商品名赋值
        $goods = DB::table('goods_sku')->get();

        $goods_sku = [];
        foreach($goods as $v){
            $goods_sku[$v->id] = $v->title; 
        }

        // 分页查询数据
        $comment = Comment::where('content','like','%'.$find.'%')->paginate(10);
        //用户名赋值
        $user = Users::all();
        $list = [];
        foreach($user as $v){
            $list[$v->id] = $v->name;
        }
        
        // 显示评论 列表
        return view('admin.comment.index',[
            'comment' => $comment,
            'list'=>$list,
            'goods_sku'=>$goods_sku,
            'params'=>$request->all(),
            ]);
    }
}
