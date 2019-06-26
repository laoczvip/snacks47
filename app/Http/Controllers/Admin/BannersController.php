<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banners;
use DB;
use Illuminate\Support\Facades\Storage;

class BannersController extends Controller
{   
    /**
     * 
     * 修改状态
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function ChangeStatus(Request $request)
    {
        // 获取状态
        $status = $request->input('status');

        // 获取id
        $id = $request->input('id');
       

        // 执行修改
        $res = DB::table('banners')->where('id',$id)->update(['status'=>$status]);
        if($res){
                return redirect('/admin/banners')->with('success','修改成功');
            }else{
                return back()->with('error','修改失败');
            }

    }

    /**
     * 删除
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function Delete(Request $request)
    {   

    // 获取要删除的id
    $id = $request->input('id');
    
    // 执行删除
    $res = Banners::destroy($id);
    // $res = DB::table('banners')->where('id',$id)->delete();

    if($res){
            return "ok";
        }else{
            return "err";
        }

       // if ($res) {
           
       //      return redirect('admin/banners')->with('success','删除成功');
       //  }else{
           
       //      return back()->with('error','删除失败');
       //  }
       
    }

    /**
     * 获取软删除
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function Soft()
    {
        // 获取软删除.
        $del_banners = Banners::onlyTrashed()->get();
        return view('admin.banners.soft',[
            'del_banners'=>$del_banners,
            ]);
    }

    /**
     * 恢复删除
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function HuiFu($id)
    {
        $res = Banners::withTrashed()->where('id',$id)->restore();
        
        if($res){
                return redirect('/admin/banners')->with('success','恢复成功');
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
        
        $banner = Banners::find($id);
        
        $res2 = DB::table('banners')->where('id',$id)->delete();

         if($res2){
                return back()->with('success','删除成功');
            }else{
                return back()->with('error','删除失败');
            }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index(Request $request)
    {   
        $search = $request->input('search');
        $banners = Banners::where('title','like','%'.$search.'%')->paginate(5);
        return view('admin.banners.index',[
                    'banners'=>$banners,
                    'search'=>$search,
            ]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Store(Request $request)
    {

           //检查文件上传
        if($request->hasFile('url')){
             $file_path = $request->file('url')->store(date('Ymd'));
        }else{
            $file_path = "";
        }

        $data = $request->all();
        // dd($data);
        
        $banners = new Banners;
        $banners->title = $data['title'];
        $banners->desc = $data['desc'];
        $banners->url = $file_path;
        $banners->status = $data['status'];
        $banners->jump = $data['jump'];
        $res = $banners->save();
 
       // if($res){
       //          return redirect('admin/banners')->with('success','添加成功');
       //      }else{
       //          return back()->with('error','添加失败');
       //      }

         if ($res) {
           
            return redirect('admin/banners')->with('success','添加成功');
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Edit($id)
    {
        //
        // 获取当前要修改的数据
        $data = DB::table('banners')->where('id',$id)->first();
        return view('admin.banners.edit',['data'=>$data]); 

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Update(Request $request, $id)
    {
        //
        // 执行文件上传

      if($request->hasFile('url')){

        // 删除以前旧图片
        Storage::delete($request->input('url_path'));

        $path = $request->file('url')->store(date('Ymd'));
      }else{
        $path =  $request->input('url_path');

      }

      // 接受用户提交的值
      $data['title'] = $request->input('title','');
      $data['desc'] = $request->input('desc','');
      $data['jump'] = $request->input('jump','');
      $data['url'] = $path;
      $data['updated_at'] = date('Y-m-d H:i:s',time());
      //dd($data);exit;
      // 执行修改
      $res = DB::table('banners')->where('id',$id)->update($data);
      //dd($res);
      // 判断逻辑
      if($res){
        return redirect('admin/banners')->with('success','修改成功');
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
      
       
    }

    

    //  public function SoftDeletion()
    // {
    //     // 获取软删除
    
    //     return view('admin.banners.soft');
    // }



}
