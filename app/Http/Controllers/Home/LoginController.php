<?php
namespace App\Http\Controllers\home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Usersinfo;
use App\Models\Weds;
use Hash;
use Mail;
use DB;
use Captcha;
class LoginController extends Controller
{
    /**
     * [ 加载登陆页面 ]
     *
     * @return \Illuminate\Http\Response
     */
    public function Index()
    {
        $friendly = DB::table('friendly')->where('lstatus',1)->get();
        $weds = weds::find(1);

        return view('home.login.login',[
                'weds'=>$weds,
                'friendly'=>$friendly,
                ]);
    }

    /**
     * [ 登陆验证 ]
     * @return [ type ] [ 接收登录信息 ]
     */
    public function Dologin(Request $request)
    {

        // 验证码验证
        if(!Captcha::check($request->input('code'))){
                return 2;
        }

        $number = $request->input('number','');
        $password = $request->input('password','');

        // 获取用户输入的数据,进行匹配
        $user_data = Users::where('number', $number)->first();
        if (!$user_data) {
            echo 1;
        }else if (!Hash::check($password, $user_data->password)) {
            echo 1;
        }

        // 验证密码

        session(['home_login'=>true]);
        session(['home_user'=>$user_data]);
        session(['type'=>true]);

    }

    /**
     * [ 找回密码页面 ]
     */
    public function ChangePassword()
    {
        $friendly = DB::table('friendly')->where('lstatus',1)->get();
        $weds = weds::find(1);
        return view('home.login.changepassword',[
                'weds'=>$weds,
                'friendly'=>$friendly,
                ]);

    }

    /**
     * [ 用户找回密码 ]
     * @param Request $request [description]
     */
    public function CarriedChangePassword(Request $request)
    {
        $number = $request->input('number');
        $phone = $request->input('phone');
        // 查询对应的账号
        $user = Users::where('number',$number)->first();
        $tel =  $user->userinfo->tel;
        // 判断密码是否跟数据库一致
        if ($phone != $tel) {
            return 0;
            die;
        }else{
            return 1;
            die;
        }
    }

    /**
     * [ 手机验证码匹配 ]
     * @param  Request $request [ 用户的手机号码 ]
     * @return [视图]           [ 返回登录页面 ]
     */
    public function PasswordStore(Request $request)
    {

        // 验证手机验证码
        $phone =  $request->input('phone',0);
        $number =  $request->input('number');
        // 获取发送到手机上的验证码
        $k = $phone.'_code';
        $phone_code = session($k);
        $code = $request->input('code');

        if ($phone_code != $code) {
            echo "<script>alert('验证码错误');location.href='/changepassword'</script>";

        }
        $phone = $request->input('phone');
        $token = str_random(30);
        // 修改用户密码
        $user = Users::where('number',$number)->first();
        $user->password = Hash::make( $request->input('repass') );
        $user->token  = $token;
        $res = $user->save();
        if($res){
            return "<script>alert('修改成功,返回登录');location.href='/login'</script>";
        }else{
            return "<script>alert('修改失败,请稍后重试!!!');location.href='/login'</script>";
        }

    }


    /**
     * [ 用户退出 ]
     * @return [ 视图 ] [ 执行后跳到首页 ]
     */
    public function out()
    {
        // 清空session
        session(['home_login'=>false]);
        session(['home_user'=>null]);
        session(['type'=>false]);

        return redirect("/");
    }


    //
    /**
     * [ 激活 用户 (邮件) ]
     * @param [iit] $id    [用户的ID]
     * @param [script] $token [用户的token]
     */
    public function ChangeStatus($id,$token)
    {

        $user = Users::find($id);
        // 验证token
        if ($user->token != $token) {
            return view('home.register.404');

        }

        $user->status = 1;
        $user->token = str_random(30);
        if ($user->save()) {
            return view('home.register.success');

        }else{
            return view('home.register.404');
        }
    }

    /**
     * [ 执行邮箱注册 ]
     * @param Request $request [ 用户的注册数据 ]
     */
    public function Inert(Request $request)
    {

        $upass = $request->input( 'upass' );
        $email = $request->input( 'email' );
        $repass = $request->input( 'repass' );
        $token = str_random(30);

        $res = DB::table('users')->where('number',$email)->get();
        if(!empty($res[0])){
            echo "name";
            exit;
        }

        if(strlen($upass)<6){
            //检测用户密码的长度是否小于6
            echo "no";
            exit;
        }

        $user = new Users;
        $user->password = Hash::make( $upass );
        $user->email = $request->input( 'email' );
        $user->name = $request->input( 'email' );
        $user->number = $request->input('email');
        $user->token = $token;
        $user->type = 0;
        $res1 = $user->save();

        $userinfo =  new Usersinfo;
        $userinfo->email = $request->input( 'email' );
        $userinfo->uid = $user->id;
        $userinfo->ufile = '/DefaultAvatar/1.jpg';
        $res2 = $userinfo->save();

        if ($res1 && $res2) {
            // 发送邮件
            Mail::send('home.register.mail', ['id'=>$user->id,'token'=>$token], function ($m) use ($email) {
                // to 发送地址 subject 发送标题
                $s = $m->to( $email )->subject('【零食杂货店】提醒邮件');
                if ($s) {
                    echo   1;
                }
            });
        }
    }


    /**
     * [ 加载注册页面 ]
     *
     * @return \Illuminate\Http\Response
     */
    public function Register()
    {
        $friendly = DB::table('friendly')->where('lstatus',1)->get();
        $weds = weds::find(1);

        return view('home.login.register',[
                'weds'=>$weds,
                'friendly'=>$friendly,
            ]);
    }

    /**
     * [ 手机验证码匹配 ]
     * @param  Request $request [ 用户的手机号码 ]
     * @return [视图]           [ 返回登录页面 ]
     */
    public function Store(Request $request)
    {

        $res = DB::table('users')->where('number',$request->input('phone'))->get();
        if(!empty($res[0])){
            echo "<script>alert('手机号已被注册');location.href='/register'</script>";
        }
        die;
        if(strlen($request->input('repass'))<6){
             echo "<script>alert('用户密码的长度小于6');location.href='/register'</script>";
        }

        if (empty($request->input('repass'))) {
            echo "<script>alert('请输入确认密码');location.href='/register'</script>";
        }

        // 验证手机验证码
        $phone =  $request->input('phone',0);
        // 获取发送到手机上的验证码
        $k = $phone.'_code';
        $phone_code = session($k);
        $code = $request->input('code');


        if ($phone_code != $code) {
            echo "<script>alert('验证码错误');location.href='/register'</script>";

        }

        $phone = $request->input('phone');
        $token = str_random(30);

        $user = new Users;
        $user->password = Hash::make( $request->input('repass') );
        $user->name = $phone;
        $user->number = $phone;
        $user->token = $token;
        $user->type = 1;
        $res1 = $user->save();

        $userinfo =  new Usersinfo;
        $userinfo->uid = $user->id;
        $userinfo->tel = $phone;
        $userinfo->ufile = '/DefaultAvatar/1.jpg';
        $res2 = $userinfo->save();
        return "<script>alert('注册成功,返回登录');location.href='/login'</script>";
    }


    /**
     * [ 发送验证码 手机号 ]
     * @return [type] [description]
     */

    public function SendPhome(Request $request)
    {
        // 接收手机号
        $phone = $request->input('phone');

        $code = rand(1234,4321);

        // 如果存入到redis中,注意健名覆盖
        $k = $phone.'_code';

        session([$k => $code]);

        $url = "http://v.juhe.cn/sms/send";
        $params = array(
            'key'   => '118c98bbbdb267100345e44c158053a0', //您申请的APPKEY
            'mobile'    => $phone, //接受短信的用户手机号码
            'tpl_id'    => '132432', //您申请的短信模板ID，根据实际情况修改
            'tpl_value' =>'#code#='.$code, //您设置的模板变量，根据实际情况修改
            'dtype'=>'json'
        );

        $paramstring = http_build_query($params);
        $content = self::juheCurl($url, $paramstring);
    }

    /**
     * [ 请求接口返回内容 ]
     * @param  string $url [请求的URL地址]
     * @param  string $params [请求的参数]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
     */
    public static function juheCurl($url, $params = false, $ispost = 0)
    {
        $httpInfo = array();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'JuheData');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                curl_setopt($ch, CURLOPT_URL, $url.'?'.$params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }
        $response = curl_exec($ch);
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }
}
