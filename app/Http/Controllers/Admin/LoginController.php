<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use Captcha;


class LoginController extends Controller
{
    /**
     * 加载登陆页面
     * @return [ 视图 ]
     */
    public function login()
    {
        session(['admin_login'=>false]);
        session(['admin_user'=>null]);
        return view('admin.login.login');
    }

    /**
     * 执行登陆操作
     * @return [ string ] [ 账号密码 ]
     */
    public function dologin(Request $request)
    {
        // 验证码验证
        if (!Captcha::check($request->input('code'))) {
                return 2;
        }


        $number = $request->input('number','');
        $password = $request->input('password','');
        // 获取对应的信息
        $user_data = DB::table('users')->where('number',$number)->first();

        // 否
        if (!$user_data) {
            echo 1;
            exit;
        }

        if ($user_data->type != 2) {
            echo 3;
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

