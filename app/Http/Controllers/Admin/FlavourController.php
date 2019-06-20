<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class FlavourController extends Controller
{
    /**
     * 显示 index
     * @param   $[name] [商品属性]
     * @return   [flavour]
     */
   	public function index()
   	{
   		$data = DB::table('flavour')->get();
   		return view('admin.flavour.index',['data'=>$data]);
   	}

   	/**
   	 * 添加 create
   	 * @param [type] $[name] [添加]
   	 * @return   [flavour]
   	 */
   	
   	public function create()
   	{
   		return view('admin/flavour/create');
   	}

   	 /**
   	 * 插入 store
   	 * @param [type] $[name] [插入]
   	 * @return   [flavour]
   	 */
   	public function store(Request $request)
   	{
   		$fname['fname'] = $request->input('fname','');
   		$res = DB::table('flavour')->insert($fname);
   		if($res){
   			return redirect('admin/flavour/create')->with('success','添加成功');
   		} else {
   			return back()->with('error','添加失败');
   		}
   	}

   	/**
   	 * 删除
   	 * @param   $[name] [删除]
   	 * @return [type] [destroy]
   	 */
   	
   	public function destroy(Request $request)
   	{
   		$id = $request->input('id',0);
   		if($id!=0){
            $goods_sku = DB::table('goods_sku')->where('flavorties',$id)->first();
            if(!$goods_sku){
                $res = DB::table('flavour')->where('id',$id)->delete();
                if($res){
                     echo json_encode('ok');
                } else {
                     echo json_encode('err');
                }
            }else {
                     echo json_encode('errr');
            }
         }
   	}

   	/**
   	 * 修改页面
   	 * @param [type] $[name] [修改]
   	 * @return   [edit]
   	 */
   	public function edit(Request $request)
   	{
   		$id = $request->input('id',0);
   		$data = DB::table('flavour')->where('id',$id)->first();
   		return view('admin.flavour.edit',['data'=>$data]);
   	}

   	/**
   	 * 修改
   	 * @param [type] $[name] [修改]
   	 * @return   [update] 
   	 */
   	
   	public function update(Request $request)
   	{
   		$id = $request->input('id',0);
   		$data['fname'] = $request->input('fname','');

   		$res = DB::table('flavour')->where('id',$id)->update($data);
   		if($res){
   			return redirect('admin/flavour/index')->with('success','修改成功');
   		} else {
   			return redirect('admin/flavour/edit?id='.$id)->with('error','修改失败');
   		}

   	}
}
