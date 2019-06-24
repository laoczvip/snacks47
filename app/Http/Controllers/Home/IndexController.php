<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Weds;


class IndexController extends Controller
{
    //无限分类分类
    public  function Cates_child()
    {
        $cates = DB::table('cates')->orderBy('path','asc')->get()->toArray();

        $ss = $this->tree($cates);
        return $ss;

    }
    //商品分类遍历

    //无限循环
    public function tree($cates_data,$pid=0)
    {

            $list = [];

            foreach ($cates_data as $k=>$v){
                if ($v->pid == $pid){
                        $list[]= $v;
                        $v->sub = $this->tree($cates_data,$v->id);
                }

        }
        return $list;
    }
    /**
     * 加载前台首页
     *
     * @return \Illuminate\Http\Response
     */

    public function Index()
    {
        $weds = weds::find(1);
        //菜单栏分类
        $cates = IndexController::Cates_child();
        //商品栏
        $goods = DB::table('goods_sku')->get()->toArray();

    /*************************莫薛贵***********************************/

















    /******************************************************************/

    /*************************谢肇韬***********************************/




























    /******************************************************************/



    /*************************梁伟杰***********************************/































    /******************************************************************/






        return view('home.index.index',['cates'=>$cates,'goods'=>$goods,'weds'=>$weds]);

    /**
     * 加载首页商品遍历
     * @return [type] [cates] [goods]
     */





       // return view('home.index.index',['cates'=>$cates]);
    }

}
