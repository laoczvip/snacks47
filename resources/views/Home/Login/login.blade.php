<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>{{ $weds->name }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" />
    <link href="/h/css/dlstyle.css" rel="stylesheet" type="text/css">
    <script src="/a/js/jquery.js"></script>
    <script src="/a/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <link rel="icon" href="/uploads/{{ $weds->icon }}"/>
    <script src="/layui/layui.js"></script>
</head>

<body>
    <div class="login-boxtitle">
        <a href="/"><img alt="logo" src="/h/images/logobig.png" /></a>
    </div>
    <div class="login-banner">
        <div class="login-main">
            <div class="login-banner-bg"><span></span><img src="/h/images/big.jpg" /></div>
            <div class="login-box">

                        <h3 class="title">登录商城</h3>

                        <div class="clear"></div>

                    <div class="login-form">
                      <form>
                            <div class="user-name">
                                <label for="user"><i class="am-icon-user"></i></label>
                                <input type="text" name="number" id="number" placeholder="邮箱/手机/用户名">
                            </div>
                            <div class="user-pass">
                                <label for="password"><i class="am-icon-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="请输入密码">
                            </div>
                            <div class="user-pass" style="margin-top: 5px;height: -34px;"">
                                <label for="password" style="margin-top:3px ";><i class="am-icon-lock"></i></label>
                                <input type="text"   id="code" name="code" placeholder="验证码" style="width: 191px;margin-top: -15px;">
                                <img src="{{captcha_src()}}" style="cursor:pointer;position:relative;top: 7px;"" onclick="this.src='{{captcha_src()}}'+Math.random()">
                            </div>
                      </form>
                   </div>

                    <div class="login-links">
                        <label for="remember-me"><input id="remember-me" type="checkbox">记住密码</label>
                            <a href="/changepassword" class="am-fr">忘记密码</a>
                            <a href="/register" class="zcnext am-fr am-btn-default">注册</a>
                            <br />
                    </div>
                <div class="am-cf">
                    <input type="button"  value="登 录" onclick="login()" class="am-btn am-btn-primary am-btn-sm">
                </div>
                <div class="partner">
                        <h3>合作账号</h3>
                    <div class="am-btn-group">
                        <li><a href="#" onclick="a()"><i class="am-icon-qq am-icon-sm"></i><span>QQ登录</span></a></li>
                        <li><a href="#" onclick="a()"><i class="am-icon-weibo am-icon-sm"></i><span>微博登录</span> </a></li>
                        <li><a href="#" onclick="a()"><i class="am-icon-weixin am-icon-sm"></i><span>微信登录</span> </a></li>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @include('home.public.footer')
</body>
<script>
//一般直接写在一个js文件中
    layui.use(['layer', 'form'], function(){
      var layer = layui.layer
      ,form = layui.form;

    });
</script>
<script>


    function login(){
            var number = $('#number').val();
            var password = $('#password').val();
            var code = $('#code').val();
             $.get('/dologin',{number,password,code},function(res){
                if (res == 2) {
                    layer.msg('验证码错误', {icon: 2});
                    return false;
                }

                if(res == 1){
                    layer.msg('用户名或密码错误', {icon: 2});
                    return false;
                }

                if(res == 3){
                    layer.msg('账号未激活,请留意邮箱!', {icon: 2});
                    return false;
                }
                window.location.href = '/';
            },'html');
        }

    function a(){
            layer.msg('正在开发中哦', {icon: 6});
    }
</script>

</html>