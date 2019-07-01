<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Weds;
use Illuminate\Support\Facades\Storage;

class ConfigureController extends Controller
{
    /**
     * [ 网站配置页面 ]
     * @return [ 视图 ]
     */
    public function index()
    {
        $weds = Weds::find(1);
        return view('admin.configure.index',['weds'=>$weds]);
    }

    /**
     * [ 关闭网站 ]
     * @return [ int ] [ 成功 ]
     */
    public function  off()
    {
        $weds = Weds::find(1);
        $weds->statu = 0;
        $weds->save();
        return  1;
    }
    /**
     * [ 开启网站 ]
     * @return [int] [成功]
     */
    public function kaiqi()
    {
        $weds = Weds::find(1);
        $weds->statu = 1;
        $weds->save();
        return  1;
    }

    /**
     * [ 加载修改页面 ]
     * @return [HTML]
     */
    public function edit()
    {
        $weds = Weds::find(1);
        return view('admin.configure.update',['weds'=>$weds]);
    }

    /**
     * [ 执行修改网站信息 ]
     * @param  Request $request [description]
     * @return [bool]           [受影响行数]
     */
    public function update(Request $request)
    {
        $this->validate($request, [
                'tel' => 'required|regex:/^1{1}[3-9]{1}[\d]{9}$/',
                'name' => 'required',
                'describe' => 'required',
                'tel' => 'required',
                'url' => 'required',
                'filing' => 'required',
                'cright' => 'required',
            ],[
                'tel.regex'=>'手机号格式错误',
                'tel.required'=>'请输入联系电话',
                'name.required'=>'请输入网站标题',
                'describe.required'=>'请输入网站描述',
                'cright.required'=>'请输入版权号',
                'url.required'=>'请输入网站地址',
                'filing.required'=>'请输入网站备案号',
        ]);

        // 判断是否换网站logo
        if ($request->hasFile('logo')) {
            Storage::delete($request->input('ulogo'));
            $logo = $request->file('logo')->store('Logo');
        }else{
            $logo = $request->input('ulogo');
        }

        // 判断是否换网站图标
        if ($request->hasFile('icon')) {
            Storage::delete($request->input('uicon'));
            $icon = $request->file('icon')->store('Logo');
        }else{
            $icon = $request->input('uicon');
        }

        $data = $request->all();

        // 执行修改
        $weds = Weds::find(1);
        $weds->tel = $data['tel'];
        $weds->name = $data['name'];
        $weds->describe = $data['describe'];
        $weds->cright = $data['cright'];
        $weds->filing = $data['filing'];
        $weds->logo = $logo;
        $weds->icon = $icon;
        $weds->url = $data['url'];
        $res = $weds->save();
        if ($res) {
            return redirect('/admin/configure/index')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }
}
