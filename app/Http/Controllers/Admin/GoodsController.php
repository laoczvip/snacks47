<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\goods;
use App\Models\Cates;
class GoodsController extends Controller
{
    public function tree($data,$pid)
    {
        static $list = [];
        foreach($data as $k=>$v){
            if($pid==$v->pid){
                $list[] = $v;
                $this->tree($data,$v->id);
            }
        }
    }
    //公共商品分类
    public static function Cates_data($pid=0)
    {
        $cates  = Cates::all();
        static $list = []; 
        foreach($cates as $k=>$v){
            if($pid==$v->pid){
                $list[] = $v;
                static::Cates_data($v->id);
            }
        }
        return $list;
        
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods = goods::all();
        $cates = GoodsController::Cates_data();
        return view('admin.goods.index',['goods'=>$goods,'cates'=>$cates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cates = GoodsController::Cates_data();
        
        return view('admin.goods.create',['cates'=>$cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
