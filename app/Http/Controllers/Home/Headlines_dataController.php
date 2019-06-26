<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Weds;

class Headlines_dataController extends Controller
{
	  // 上一篇
    private  function Prev($id)
    {
      $data = DB::table('headlines')->where('id','<',$id)->orderBy('id','desc')->first();
      if($data){
         return $data;
       }else{
          return false;
       }

    }

    // 下一篇
    private  function Next($id)
    {
      $data = DB::table('headlines')->where('id','>',$id)->orderBy('id','asc')->first();
      if($data){
         return $data;
       }else{
          return false;
       }

    }



    //
    public function Index(Request $request)
    {

    	$id = $request->input('id',0);
    	// 上一条
      $article_prev = self::prev($id,$request->input('id',0));

      // 下一条
      $article_next = self::next($id,$request->input('id',0));
    	$headlines_data = DB::table('headlines')->where('id',$id)->first();
    	$weds = weds::find(1);
    	$datas = DB::select("select  * from headlines order By id desc limit 1,6");
      $friendly = DB::table('friendly')->where('lstatus',1)->get();

    	return view('home.headlines_data.index',[
        'weds'=>$weds,
        'headlines_data'=>$headlines_data,
        'friendly'=>$friendly,
        'datas'=>$datas,'article_prev'=>$article_prev,'article_next'=>$article_next,]);
    }


}
