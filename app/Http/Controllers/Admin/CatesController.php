<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use DB;
class CatesController extends Controller
{

    /**
     * [ 商品分类列表 ]
     * @param Request $request [ 查询所有的数据 ]
     * @return [type]  [视图跳转]
     */
    public function Index(Request $request)
    {
        //显示商品分类列表
        $cid = $request->input('cid',0);

        if ($cid != 0) {
         $cates = Cates::where('id',$cid)->paginate(2);
        } else {
         $cates = Cates::where('pid',0)->paginate(5);
        }

        $cates_data = GoodsController::Cates_data();

        return view('admin.cates.index',[
                    'cates'=>$cates,
                    'cates_data'=>$cates_data,
                    'cid'=>$cid,
                    ]);
    }

    /**
     * 加载添加页面
     * @return  [type] [视图跳转]
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
     * 添加商品类
     * @param Request $request [添加的参数值]
     * @return [type] [视图跳转]
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
     * 加载子类
     *
     * @param [type] $[id&&cid] [description]
     * @return [type] [视图跳转]
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
     * 加载修改页
     * @param Request $request [类id]
     * @return [type] [视图跳转]
     */
    public function Edit(Request $request)
    {
        //类名修改
        $id = $request->input('cid',0);
        $cate_data = Cates::find($id);
        return view('admin.cates.edit',['cate_data'=>$cate_data]);
    }

    /**
     * 类名修改
     * @param Request $request [类id]
     * @return [type] [视图跳转]
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
     * 类删除
     * @param Request $request [类id]
     * @return [type] [视图跳转]
     */
    public function Delete(Request $request)
    {
        $id = $request->input('id',0);
        $case_data =Cates::where('id',$id)->first();

        $cate = Cates::where('pid',$id)->first();


        if(empty($cate)){
             $cates =Cates::destroy($id);
               if($cates){
                    return redirect('admin/cates/show?id='.$case_data->pid)->with('success','删除成功');
               } else{
                    return back()->with('error','删除失败');
               }
        } else {
            return back()->with('error','该类含有子类');
        }


    }
    /**
     * 修改类状态
     * @param [type] $[id] [类id]
     * @return    [type] [视图跳转]
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
            $ress = DB::table('cates')->where('pid',$id)->update($status);
                $data = DB::table('cates')->find($id);

                return redirect("admin/cates/show?id=".$data->pid);
        } else {
            return back()->with('error','修改失败');
        }
    }
}
