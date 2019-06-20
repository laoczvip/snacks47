<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class LoginController extends Controller
{
    /**
     * 加载登陆页面
     * @return [type] [description]
     */
    public function login()
    {
        session(['admin_login'=>false]);
        session(['admin_user'=>null]);
        return view('admin.login.login');
    }

    /**
     * 执行登陆操作
     * @return [type] [description]
     */
    public function dologin(Request $request)
    {
        $number = $request->input('number','');
        $password = $request->input('password','');

        $user_data = DB::table('users')->where('number',$number)->first();


        if (!$user_data) {
            echo 1;
            exit;
        }

        // 验证密码
        if (!Hash::check($password, $user_data->password)) {
            echo 1;
            exit;
        }
        session(['admin_login'=>true]);
        session(['admin_user'=>$user_data]);

        // 跳转
        return redirect('/admin');

    }
}

