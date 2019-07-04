<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
class ShakyController extends Controller
{
    /**
     * 加载活动类
     * @return  [type] [index]
     */
    public function Index()
    {
    	$shaky = DB::table('shaky')->get();
    	return view('admin.shaky.index',['shaky'=>$shaky]);
    }
    /**
     * 加载添加活动页面
     * @return  [type] [create]
     */
    public function Create()
    {
    	$shaky = DB::table('shaky')->get();
    	return view('admin.shaky.create',['shaky'=>$shaky]);
    }
    /**
     * 添加活动类
     * @return  [type] [insert]
     */
    public function Shore(Request $request)
    {
    	        $data = $this->validate($request,[
                'sname' => 'required|min:1|max:10',
                'ctime' => 'required|regex:/^[0-9]\d{3}-\d{2}-\d{2}.*?\d{2}:\d{2}:\d{2}$/',
                'jtime' => 'required|regex:/^[0-9]\d{3}-\d{2}-\d{2}.*?\d{2}:\d{2}:\d{2}$/',   
            ],[   
                'ctime.required'=>'开启时间不能为空',
                'ctime.regex'=>'开启时间格式不对',
                'jtime.required'=>'结束时间不能为空',
                'jtime.regex'=>'结束时间格式不对',
                'sname.required'=>'活动名不能为空',

                'sname.min'=>'输入活动名称不能少于1个字符',
                'sname.max'=>'输入活动名称不能大于10个字符'
            ]);
        if($request->hasFile('profile')){
            $path = $request->file('profile')->store(date('Ymd'));
        } else{
            $path = '';
        }
        $data['profile'] = $path;
    	$res = DB::table('shaky')->insert($data);
    	if($res){
    		return redirect('admin/shaky/index')->with('success','添加成功');
    	} else {
    		return back()->with('error','添加失败');
    	}
    }
    /**
     * 加载修改活动类页面
     * @return  [type] [edit]
     */
    public function Edit(Request $request)
    {
        $id = $request->input('id',0);
        $shaky = DB::table('shaky')->where('id',$id)->first();
        return view('admin.shaky.edit',['shaky'=>$shaky]);
    }
    /**
     * 压入修改活动类
     * @return  [type] [update]
     */
    public function Update(Request $request)
    {
        $id = $request->input('id',0);
        $profile = $request->input('profile');
         $data = $this->validate($request,[
                'sname' => 'required|min:1|max:10',
                'ctime' => 'required|regex:/^[0-9]\d{3}-\d{2}-\d{2}.*?\d{2}:\d{2}:\d{2}$/',
                'jtime' => 'required|regex:/^[0-9]\d{3}-\d{2}-\d{2}.*?\d{2}:\d{2}:\d{2}$/',   
            ],[   
                'ctime.required'=>'开启时间不能为空',
                'ctime.regex'=>'开启时间格式不对',
                'jtime.required'=>'结束时间不能为空',
                'jtime.regex'=>'结束时间格式不对',
                'sname.required'=>'活动名不能为空',
                'sname.unique'=>'活动名称要唯一的',
                'sname.min'=>'输入活动名称不能少于1个字符',
                'sname.max'=>'输入活动名称不能大于10个字符'
            ]);
        if($request->hasFile('profile')){
            $path = $request->file('profile')->store(date('Ymd'));
            Storage::delete($profile);
        } else{
            $path = $profile;
        }
        $data['profile'] = $path;
        
        $shaky = DB::table('shaky')->where('id',$id)->update($data);
        if($shaky){
            return redirect('admin/shaky/index')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }
    }
    /**
     * 删除活动类
     * @return  [type] [del]
     */
    public function Del(Request $request)
    {
        $id = $request->input('id',0);

        $shakys = DB::table('shaky_sku')->where('sid',$id)->first();
      
        if($shakys==null){
             $shaky = DB::table('shaky')->where('id',$id)->delete();
             if($shaky){
                echo json_encode('删除成功');
             } else{
                echo json_encode('删除失败');
             }
        } else{
            echo json_encode('该活动还含有子商品');
        }
       
    }
}
