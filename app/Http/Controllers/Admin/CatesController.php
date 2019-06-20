<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use DB;
class CatesController extends Controller
{
    /**
     * Index a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index(Request $request)
    {
        //显示商品分类列表
        $cid = $request->input('cid',0);

        if($cid!=0){
         $cates = Cates::where('id',$cid)->paginate(2);
        } else {
         $cates = Cates::where('pid',0)->paginate(5);
        }
       
        $cates_data = GoodsController::Cates_data();
        return view('admin.cates.index',['cates'=>$cates,'cates_data'=>$cates_data,'cid'=>$cid]);
    }

    /**
     * Create the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Create(Request $request)
    {   
        $pid = $request->input('id',0);

        if($pid){
            $cates = Cates::find($pid);
        } else {
            $cates['pid'] = null;
        }

        //显示商品添加类
        return view('admin.cates.create',['cates'=>$cates,]);
    }
    /**
     * Insert the form for creating a new insert.
     *
     * @return cates add
     */
    public function Insert(Request $request)
    {
        //商品添加类
        $data['title'] = $request->input('title','');
        $pid = $request->input('pid',0);

        if($pid == 0){
            $data['pid'] = 0;
            $data['path'] = $data['pid'].',';
        } else {
            $path = Cates::find($pid);
            $data['pid'] = $pid;
             $data['path'] = $path->path.$path->id.',';
           
        }
       
        
        $data['status'] = 1;
        $data['add_time'] = date('Y-m-d H:i:s');
        $title = $request->input('title','');
        $cates_datas = DB::table('cates')->where('title',$title)->first();
        if(!$cates_datas){
            $res = Cates::insert($data);
            if($res){
                return redirect("/admin/cates/create?id=$pid")->with('success','添加成功');
            } else {
                return back()->with('error','添加失败');
            }
        } else{
            return back()->with('error','类名已存在');
        }
        

    }
    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 显示子类
     */
    public function Show(Request $request)
    {
        $pid = $request->input('id',0);
        $cid = $request->input('cid',0);
        if($cid !=0){
            $cate = Cates::where('id',$cid)->paginate(5);
        } else {
            $cate = Cates::where('pid',$pid)->paginate(5);
        }

        
      
        return view('admin.cates.show',['cate'=>$cate,'cid'=>$cid]);
    }

    /**
     * Edit the form for editing the specified resource.
     *
     * @param  int  $id
     * @return [type] [cates] [edit]
     */
    public function Edit(Request $request)
    {
        //类名修改
        $id = $request->input('cid',0);
        $cate_data = Cates::find($id);
        return view('admin.cates.edit',['cate_data'=>$cate_data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return [type] [cates] [update]
     */
    public function Update(Request $request)
    {
        $id = $request->input('id',0);
        $title['title'] = $request->input('title','');
        $title_new['title'] = $request->input('title_new','');
        if($id){
            if($title_new){
                if($title != ''){
                    $res = DB::table('cates')->where('id',$id)->update($title);
                    if($res){
                        return redirect('admin/cates/edit?cid='.$id);
                    }
                } else {
                    dd($title_new);
                    $res = DB::table('cates')->where('id',$id)->update($title_new);
                    return redirect('admin/cates/edit?cid='.$id);
                }
            } else {
                return back()->with('error','原类名称不能为空');
            }
        } else{
            return back();
        }
        
    }
    /**
     * Delete the specified resource from storage.
     *
     * @param  int  $id
     * @return [type] [cates] [delete]
     */
    public function Delete($id)
    {
        $cate = Cates::where('pid',$id)->first();
        
        if(empty($cate)){
             $cates =Cates::destroy($id);
               if($cates){
                    return redirect('admin/cates/show?id='.$cate->pid)->with('success','删除成功');
               } else{
                    return back()->with('error','删除失败');
               }
        } else {
            return back()->with('error','该类含有子类');
        }
      
        
    }
    /**
     * @param     status
     * @return    [type] [cates] [store]
     */
    public function Store(Request $request)
    {
        $id['id'] = $request->input('id',0);
        $sta = $request->input('status',0);
        
        if($sta==1){
            $status['status'] = 0;
        } else {
            $status['status'] = 1;
        }
        
        $res = DB::table('cates')->where('id',$id)->update($status);
        if($res){
            $data = DB::table('cates')->find($id);

            return redirect("admin/cates/show?id=".$data->pid);
        } else {
            return back()->with('error','修改失败');
        }
    }
}
