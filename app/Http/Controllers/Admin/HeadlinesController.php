<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Headlines;
use DB;
use Illuminate\Support\Facades\Storage;

class HeadlinesController extends Controller
{
     /**
     *  头条列表
     * @param Request $request [ 所有的头条数据 ]
     */
    public function Index(Request $request)
    {
        // 接收搜索条件
        $search = $request->input('search');

         // 接收数据
        $headlines = Headlines::where('htitle','like','%'.$search.'%')->paginate(5);

        return view('admin.headlines.index',[
                     'headlines'=>$headlines,
                     'search'=>$search,
            ]);

    }


    /**
     *  修改头条状态 ( 是否显示 )
     *
     * @param Request $request [ 头条ID ]
     */
    public function ChangeStatus(Request $request)
    {
        // 获取状态
        $status = $request->input('status');

        // 获取id
        $id = $request->input('id');


        // 执行修改
        $res = DB::table('headlines')->where('id',$id)->update(['status'=>$status]);
        if($res){
                return redirect('/admin/headlines')->with('success','修改成功');
            }else{
                return back()->with('error','修改失败');
            }

    }


    /**
     *  删除头条
     *
     * @param Request $request [ 接收头条ID ]
     */
    public function Delete(Request $request)
    {
        $id = $request->input('id');

        $res = Headlines::destroy($id);
        // $res = DB::table('banners')->where('id',$id)->delete();

        if($res){
                return "ok";
            }else{
                return "err";
            }
    }


    /**
     *  获取软删除
     *
     */
    public function Soft()
    {
        // 获取软删除.
        $del_headlines = Headlines::onlyTrashed()->get();

        return view('admin.headlines.soft',['del_headlines'=>$del_headlines,]);
    }


    /**
     *  恢复删除
     *
     * @param [ int ] $id [ 需要恢复的ID ]
     */
    public function HuiFu($id)
    {
        $res = Headlines::withTrashed()->where('id',$id)->restore();

        if($res){
            return redirect('/admin/headlines')->with('success','恢复成功');
        }else{
            return back()->with('error','恢复失败');
        }

    }



    /**
     *  永久删除
     *
     *  @param [ int ] $id [ 需要删除的ID ]
     */
    public function Delete_data($id)
    {

        $banner = Headlines::find($id);

        $res2 = DB::table('headlines')->where('id',$id)->delete();

        if($res2){
                return back()->with('success','删除成功');
            }else{
                return back()->with('error','删除失败');
            }

    }



    /**
     * 加载添加头条页面
     *
     */
    public function Create()
    {
        return view('admin.headlines.create');
    }


    /**
     *  执行添加头条
     * @param Request $request [ 接收新的数据 ]
     */
    public function Store(Request $request)
    {
        //
        // 数据验证
         $this->validate($request, [
            'htitle' => 'required|max:128',
            'auth' => 'required|max:32',
            'hcontent' => 'required',
            'thumb' => 'required',

         ],[
            'htitle.required'=>'标题必填',
            'htitle.max'=>'标题过长',
            'auth.required'=>'作者必填',
             'auth.max'=>'作者过长',
            'hcontent.required'=>'文章必填',
            'thumb.required'=>'请选择缩略图',

         ]);


           //检查文件上传
        if($request->hasFile('thumb')){
             $file_path = $request->file('thumb')->store(date('Ymd'));
        }else{
            $file_path = "";
        }

        // 添加到数据表
        $headlines = new Headlines;
        $headlines->auth = $request['auth'];
        $headlines->htitle = $request['htitle'];
        $headlines->hcontent = $request['hcontent'];
        $headlines->status = $request['status'];
        $headlines->thumb = $file_path;
        $res = $headlines->save();

        if ($res) {
            return redirect('admin/headlines')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
        }

    }



    /**
     * 显示修改页面
     * @param [ int ] $id [ 需要修改的ID ]
     */
    public function Edit($id)
    {

        // 获取要修改的数据
        $data = DB::table('headlines')->where('id',$id)->first();
        return view('admin.headlines.edit',[
                    'data'=>$data,
            ]);
    }


    /**
     * 执行头条修改
     * @param Request $request [ 接收需要更新的内容 ]
     * @param [ int ]  $id      [ 需要修改的ID ]
     */
    public function Update(Request $request, $id)
    {
         if($request->hasFile('thumb')){

        // 删除以前旧图片
        Storage::delete($request->input('thumb_path'));

        $path = $request->file('thumb')->store(date('Ymd'));
        }else{
            $path =  $request->input('thumb_path');

        }

         // 接受提交的值
        $data['htitle'] = $request->input('htitle','');
        $data['auth'] = $request->input('auth','');
        $data['hcontent'] = $request->input('hcontent','');
        $data['thumb'] = $path;

        // 执行修改
        $res = DB::table('headlines')->where('id',$id)->update($data);

         // 判断逻辑
        if($res){
          return redirect('admin/headlines')->with('success','修改成功');
         }else{
           return back()->with('error','修改失败');
        }
    }

}
