<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class FlavourController extends Controller
{
    /**
     * [ 显示 index ]
     * @param   $[name] [商品属性]
     * @return   [flavour]
     */
    public function Index(Request $request)
    {
      $touch = $request->input('touch','');

      $goods_sku = DB::table('goods_sku')->get();
      $list = [];
      foreach($goods_sku as $v){
        $list[$v->touch] = $v->touch;
      }
      if($touch==''){
        $data = DB::table('flavour')->paginate(5);
      } else {
        $data = DB::table('flavour')->where('touch',$touch)->paginate(5);
      }
      return view('admin.flavour.index',['data'=>$data,'list'=>$list,'touch'=>$touch]);
    }

    /**
     * 删除
     * @param   $[name] [删除]
     * @return [type] [destroy]
     */

    public function Destroy(Request $request)
    {
      $id = $request->input('id',0);
      if($id!=0){

                $res = DB::table('flavour')->where('id',$id)->delete();
                if($res){
                     echo json_encode('删除成功');
                } else {
                     echo json_encode('删除失败');
                }

         }
    }

    /**
     * 修改页面
     * @param [type] $[name] [修改]
     * @return   [type] [视图跳转]
     */
    public function Edit(Request $request)
    {
      $id = $request->input('id',0);
      $data = DB::table('flavour')->where('id',$id)->first();
      return view('admin.flavour.edit',['data'=>$data]);
    }

    /**
     * 修改
     * @param [type] $[name] [修改]
     * @return   [type] [视图跳转]
     */

    public function Update(Request $request)
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
