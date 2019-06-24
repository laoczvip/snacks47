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
     * 删除
     * @param  [type] $id [description]
     * @return [type]     [description]
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
     * 获取软删除
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function Soft()
    {
        // 获取软删除.
        $del_headlines = Headlines::onlyTrashed()->get();

        return view('admin.headlines.soft',[
                    'del_headlines'=>$del_headlines,
            ]);
    }

    /**
     * 恢复删除
     * @param  [type] $id [description]
     * @return [type]     [description]
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
     * 永久删除
     * @param  [type] $id [description]
     * @return [type]     [description]
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
     * Display a listing of the resource.
     * 显示头条列表
     * @return \Illuminate\Http\Response
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
     * Show the form for creating a new resource.
     *加载添加头条页面
     * @return \Illuminate\Http\Response
     */
    public function Create()
    {
        return view('admin.headlines.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加头条
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Store(Request $request)
    {
        //
        // 数据验证
         $this->validate($request, [
            'htitle' => 'required|max:128',
            'auth' => 'required|max:32',
            'hcontent' => 'required',

         ],[
            'htitle.required'=>'标题必填',
            'htitle.max'=>'标题过长',
            'auth.required'=>'作者必填',
             'auth.max'=>'作者过长',
            'hcontent.required'=>'文章必填',
            
         ]);

        $headlines = new Headlines;
        $headlines->auth = $request['auth'];
        $headlines->htitle = $request['htitle'];
        $headlines->hcontent = $request['hcontent'];
        $res = $headlines->save();

        if ($res) {
           
            return redirect('admin/headlines')->with('success','添加成功');
        }else{
           
            return back()->with('error','添加失败');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *显示修改头条的页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     *执行头条修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Update(Request $request, $id)
    {
         // 接受用户提交的值
        $data['htitle'] = $request->input('htitle','');
        $data['auth'] = $request->input('auth','');
        $data['hcontent'] = $request->input('hcontent','');
     
        //dd($data);exit;
        // 执行修改
        $res = DB::table('headlines')->where('id',$id)->update($data);
        //dd($res);
         // 判断逻辑
        if($res){
          return redirect('admin/headlines')->with('success','修改成功');
         }else{
           return back()->with('error','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Destroy($id)
    {
        //
    }
}
