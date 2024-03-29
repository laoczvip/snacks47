<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Collect;
use DB;

class CollectionController extends Controller
{
    /**
     * [ 用户收藏 ]
     * @param [int] $gid [商品ID]
     */
    public function Collection($gid)
    {
        $collect = new Collect;
        // 添加数据
        $collect->uid = session('home_user')->id;
        $collect->gid = $gid;
        DB::update("update goods set collect=collect+1 where id=".$gid);

        $res = $collect->save();
        if ($res) {
            return 1;
        }else{
            return 2;
        }
    }

    /**
     * [ 用户取消收藏 ]
     * @param [ int ] $id [ 商品的ID ]
     */
    public function Del($id)
    {
        $uid = session('home_user')->id;
        // 查询用户已收藏的商品
        $res = Collect::where('uid',$uid)->where('gid',$id)->get();

        DB::update("update goods set collect=collect-1 where id=".$id);


        foreach ($res as $k => $v) {
            $cid = $v->id;
        }

        // 删除已收藏的商品
        $res = DB::delete('delete from collect where id ='.$cid);
        if ($res) {
            return 1;
        }else{
            return 2;
        }
    }
}
