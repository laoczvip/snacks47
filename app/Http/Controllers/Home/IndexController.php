<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Weds;
use App\Http\Controllers\Home\ShopcartController;

class IndexController extends Controller
{
    //
    /**
     * [ 无限分类分类 ]
     */
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
                if ($v->pid == $pid) {
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
        $count = ShopcartController::CountCar();
        $weds = weds::find(1);
        //菜单栏分类
        $cates = IndexController::Cates_child();
        //商品栏
        $goods = DB::table('goods_sku')->get()->toArray();

    /*************************莫薛贵***********************************/
        $shaky = DB::table('shaky')->get();
















    /******************************************************************/

    /*************************谢肇韬***********************************/
        // 获取友情链接数据
        $friendly = DB::table('friendly')->where('lstatus',1)->get();



























    /******************************************************************/



    /*************************梁伟杰***********************************/
    // 获取轮播图数据
    $banners_data = DB::table('banners')->where('status',1)->Where('deleted_at',null)->Paginate(5);

    $headlines_asc = DB::select("select  * from headlines where status=1 order By id desc limit 2");
    // 跳过最前两条信息,显示三条信息
    $headlines_desc = DB::select("select  * from headlines where status=1 order By id desc limit 2,3");

    // 获取推荐商品(销量最高)的数据
    $buy = DB::select("select * from goods_sku order By buy asc limit 3");





























    /******************************************************************/




        return view('home.index.index',[
            'cates'=>$cates,
            'goods'=>$goods,
            'weds'=>$weds,
            'banners_data'=>$banners_data,
            'headlines_asc'=>$headlines_asc,
            'headlines_desc'=>$headlines_desc,
            'friendly'=>$friendly,
            'count'=>$count,
            'shaky'=>$shaky,
            'buy'=>$buy,
            ]);

    /**
     * 加载首页商品遍历
     * @return [type] [cates] [goods]
     */





       // return view('home.index.index',['cates'=>$cates]);
    }

    public function Maintain()
    {
        return view('home.index.503');
    }

}
