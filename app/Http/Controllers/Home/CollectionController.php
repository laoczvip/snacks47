<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Collect;
use DB;

class CollectionController extends Controller
{
    /**
     * [用户收藏]
     * @param [int] $gid [商品ID]
     */
    public function Collection($gid)
    {
        $collect = new Collect;
        $collect->uid = session('home_user')->id;
        $collect->gid = $gid;
        $res = $collect->save();
        if ($res) {
            return 1;
        }else{
            return 2;
        }
    }

    /**
     * [ 用户取消收藏 ]
     * @param [ type ] $id [ 商品的ID ]
     */
    public function Del($id)
    {
        $uid = session('home_user')->id;
        $res = Collect::where('uid',$uid)->where('gid',$id)->get();
        foreach ($res as $k => $v) {
            $cid = $v->id;
        }
        $res = DB::delete('delete from collect where id ='.$cid);
        if ($res) {
            return 1;
        }else{
            return 2;
        }
    }
}
