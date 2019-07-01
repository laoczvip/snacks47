<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ShakyController extends Controller
{
    /**
     * 遍历商品图片
     * @return  [type] [Showcase]
     */
    public static function Goods_data()
    {
        $goods = DB::table('goods_sku')->get();
        $list = [];
        foreach($goods as $v){
            $list[$v->gid] = $v->showcase;
        }
        return $list;
    }
    /**
     * 显示活动类商品
     * @return  [type] [index]
     */
    public function Index(Request $request)
    {
        $sid = $request->input('id',0);
        $sids = $request->input('ids',0);
        if($sid!=0){
            $shaky_one = DB::table('shaky')->where('id',$sid)->first();
        $date = date('Y-m-d H:i:s',time());
        $ctime = $shaky_one->ctime;
        $jtime = $shaky_one->jtime;
        if($ctime>$date){
            echo json_encode('活动未开启');

        } else if($ctime<$date&&$jtime<$date){
            echo json_encode('活动已结束');
        } else if($ctime<$date&&$jtime>$date){
            echo json_encode('ok');

        }
    }else if($sids!=0){
        $goods_sku = ShakyController::Goods_data();
        $shaky_one = DB::table('shaky')->where('id',$sids)->first();
        $shaky = DB::table('shaky_sku')->where('sid',$sids)->paginate(1);

        return view('home.shakys.show',['shaky'=>$shaky,'sids'=>$sids,'goods_sku'=>$goods_sku,'shaky_one'=>$shaky_one]);
        }


    }
}
