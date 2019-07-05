<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFriendly;
use App\Models\Friendly;
use DB;

class FriendlyController extends Controller
{
    /**
     * Display a listing of the resource.
     * 友情链接列表 显示
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 接收搜索的参数
        $find = $request->input('find','');

        // 分页查询数据
        $friendly = Friendly::where('lname','like','%'.$find.'%')->paginate(2);
        // dd($friendly);
        // 加载 列表页面
        return view('admin.friendly.index',['friendly' => $friendly,'params'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     * 友情链接 添加
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.friendly.create');
    }

    /**
     * 数据上传库
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFriendly $request)
    {
        // 验证数据
        /*$this->validate($request, [
                'lname' => 'required',
                'lurl' => 'required',
                'limg' => 'required',
            ],[
                'lname.required' => '链接名称必填',
                'lurl.required' => '跳转地址必填',
                'limg.required' => '展示图必选',
            ]);*/

        // dump($request->all());
        
        $data = $request->except(['_token']);

        /*dd($data);
        die;*/

        // 检查文件上传
        if ($request->hasFile('limg')) {
            // 创建文件上传对象
            $limg = $request->file('limg')->store(date('Ymd'));
        } else {
            return back()->whith('error',请选择图片);
        }

        // 接收数据
        $friendly = new Friendly;
        $friendly->lname = $data['lname'];
        $friendly->lurl = 'http://'.$data['lurl'];
        $friendly->limg = $limg;
        $friendly->lstatus = $data['lstatus'];
        $res = $friendly->save();
        // 执行 添加到数据库
        if ($res) {
            return redirect('/admin/friendly')->with('success','添加成功');
        } else {
            return back()->with('error','添加失败');
        }
    }


    /**
     * 友情链接显示修改页面 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $friendly = Friendly::find($id);

        // 加载 修改 页面
        return view('admin.friendly.edit',['friendly'=>$friendly]);
    }

    /**
     * @param  友情链接 修改
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 验证数据
        $this->validate($request, [
                'lname' => 'required',
                'lurl' => 'required',
                'limg' => 'required',
                'lstatus' => 'required',
            ],[
                'lname.required' => '链接名称必填',
                'lurl.required' => '跳转地址必填',
                'limg.required' => '展示图必选',
                'lstatus.required' => '状态必选',
            ]);

        // 获取头像
        if ($request->hasFile('limg')) {
            $file_path = $request->file('limg')->store(date('Ymd'));
        } else {
            $file_path = $request->input('old_limg');
        }

        $friendly = Friendly::find($id);
        $friendly->lname = $request->input('lname','');
        $friendly->lurl = $request->input('lurl','');
        $friendly->limg = $file_path;
        $friendly->lstatus= $request->input('lstatus','');
        $res = $friendly->save();

        if ($res) {
            return redirect('/admin/friendly')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }
    }

    /**
     *执行删除
     * @param  友情链接 删除
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id',0);

        // 执行删除
        // $res = friendly::destroy($id);
        $res = DB::table('friendly')->where('id',$id)->delete();

        if($res){
                echo "ok";
            }else{
                echo "err";
            }
    }

    /**
     *友情链接 快速激活 状态
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function ChangeStatus(Request $request)
    {
        // 获取状态
        $lstatus = $request->input('lstatus');
        // 获取id
        $id = $request->input('id');
       

        // 执行修改
        $res = DB::table('friendly')->where('id',$id)->update(['lstatus'=>$lstatus]);
        if($res){
                return back()->with('success','修改成功');
            }else{
                return back()->with('error','修改失败');
            }

    }

}
