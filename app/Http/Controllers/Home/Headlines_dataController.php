<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Weds;

class Headlines_dataController extends Controller
{

    /**
     * [ 上一篇 ]
     * @param [int] $id [ 头条ID ]
     */
    private  function Prev($id)
    {
      $data = DB::table('headlines')->where('id','<',$id)->orderBy('id','desc')->first();
      if ($data) {
         return $data;
       }else{
          return false;
       }

    }

    /**
     * [ 下一篇 ]
     * @param [type] $id [ 头条ID ]
     */
    private  function Next($id)
    {
      $data = DB::table('headlines')->where('id','>',$id)->orderBy('id','asc')->first();
      if($data){
         return $data;
       }else{
          return false;
       }

    }



    /**
     * [ 头条首页 ]
     * @param Request $request [ 接收头条ID ]
     */
    public function Index(Request $request)
    {
        $count = ShopcartController::CountCar();


    	$id = $request->input('id',0);

    	// 上一条
        $article_prev = self::prev($id,$request->input('id',0));

        // 下一条
        $article_next = self::next($id,$request->input('id',0));

        // 获取公告里的头条
    	$headlines_data = DB::table('headlines')->where('id',$id)->first();

    	$weds = weds::find(1);
        $friendly = DB::table('friendly')->where('lstatus',1)->get();
        // 只显示五条
    	$datas = DB::select("select  * from headlines order By id desc limit 5");

    	return view('home.headlines_data.index',[
        'weds'=>$weds,
        'headlines_data'=>$headlines_data,
        'friendly'=>$friendly,
        'datas'=>$datas,'article_prev'=>$article_prev,
        'article_next'=>$article_next,
        'count'=>$count,
        ]);
    }

    /**
     * [ 全部文章列表 ]
     */
    public function List()
    {
        $count = ShopcartController::CountCar();
      $weds = weds::find(1);
      $friendly = DB::table('friendly')->where('lstatus',1)->get();
      $data = DB::table('headlines')->Paginate(5);
      // 获取公告里的头条
      $datas = DB::select("select  * from headlines order By id desc limit 5");

      return view('home.headlines_data.list',[
                  'weds'=>$weds,
                  'friendly'=>$friendly,
                  'data'=>$data,
                  'count'=>$count,
                  'datas'=>$datas
                  ]);
    }


}
