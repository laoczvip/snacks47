<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class IndexController extends Controller
{
    /**
     * 加载后台首页
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 用户总数
        $num = self::num('users');
        // 商品总数
        $goods_num = self::num('goods');
        $menuy = DB::table('Salesvolume')->get();
        foreach ($menuy as $key => $v) {
            $menuy = $v->menuy;
        }

        return view('admin.index.index',[
            'num'=>$num,
            'goods_num'=>$goods_num,
            'menuy'=>$menuy,
            ]);
    }

    /**
     * 统计数据库总条数
     * @param  [type] $table [数据表名称]
     * @return [type]        [itn]
     */
    public static function num($table)
    {
        $quantity = DB::select("select count(*) from $table");
        // 提取字符串中的数字
        $data = json_encode($quantity[0]);
        $num='';
        for($i=0;$i<strlen($data);$i++){
            if(is_numeric($data[$i])){
                $num.=$data[$i];
            }
        }
        return $num;
    }


}
