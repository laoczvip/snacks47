<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsers;
use App\Models\Users;
use App\Models\Usersinfo;
use Hash;
use DB;


class UserController extends Controller
{
    /**
     * 加载用户列表试图
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requets)
    {

        $users = Users::paginate(2);
        return view('admin.user.index',[
                    'users'=>$users,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * 执行添加用户
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsers $request)
    {
        /*$this->validate($request, [
            'number' => 'required|regex:/^[a-zA-Z0-9]{4,16}$/',
            'ufile' => 'required',
            'email' => 'required',
            'pass' => 'required|regex:/^[\w]{6,18}/',
            'upass' => 'required|same:pass',
            'tel' => 'required|regex:/^1{1}[3-9]{1}[\d]{9}$/',
        ],[
            'number.required'=>'请输入用户名',
            'number.regex'=>'用户名格式错误',
            'email.required'=>'请输入邮箱',
            'upass.required'=>'请输入确认密码',
            'upass.same'=>'两次密码不一致',
            'tel.required'=>'请输入电话',
            'tel.regex'=>'手机号格式错误',
            'pass.regex'=>'密码格式错误',
            'pass.required'=>'请输入密码',
            'ufile.required'=>'请选择头像',
        ]);*/
        DB::beginTransaction();

        //上传头像
        if ($request->hasFile('ufile')) {
            //创建文件上传对象
            $file_path = $request->file('ufile')->store(date('Ymd'));
        }else{
            $file_path = "";
        }
        $data = $request->all();
        $user = new Users;
        $user->number = $data['number'];
        $user->name = $data['number'];
        $user->password = Hash::make($data['upass']);
        $res1  = $user->save();
        if ($res1) {
            // 获取uid
            $uid = $user->id;
        }

        // 压入头像
        $usersinfo = new Usersinfo;
        $usersinfo->uid = $uid;
        $usersinfo->ufile = $file_path;
        $usersinfo->tel = $data['tel'];
        $usersinfo->tel = $data['tel'];
        $usersinfo->email = $data['email'];
        $res2 = $usersinfo->save();
        if ($res1 && $res2) {
            DB::commit();
            return redirect('admin/users')->with('success','添加成功');
        }else{
            DB::rollBack();
            return back()->with('error','添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 修改用户信息
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUsers $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function SoftDeletion()
    {
        return view('admin.user.soft');
    }
}
