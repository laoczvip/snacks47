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
    <link rel="stylesheet" href="/h/AmazeUI-2.4.2/assets/css/amazeui.min.css" />
    <link href="/h/css/dlstyle.css" rel="stylesheet" type="text/css">
    <script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
    <script src="/h/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
    <link rel="icon" href="/uploads/{{ $weds->icon }}"/>
    <script src="/layui/layui.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>


    <div class="login-boxtitle">
        <a href="/">
            <img alt="" src="/uploads/{{ $weds->logo }}" />
        </a>
    </div>
    <div class="res-banner">
    <div class="res-main">
        <div class="login-banner-bg">
            <span></span>
            <img src="/h/images/big.jpg" /></div>
        <div class="login-box" style="height: 353px;">
            <div class="am-tabs" id="doc-my-tabs">
                <ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
                    <li class="am-active">
                        <a href="">邮箱注册</a></li>
                    <li>
                        <a href="">手机号注册</a></li>
                </ul>
      @if(session('error'))
    <div class="alert  alert-danger alert-dismissible" role="alert" style="width: 92em;margin-left: 378px;">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>{{session('error')}}</strong>
    </div>
    @endif

    @if(session('success'))
    <div class="alert  alert-info alert-dismissible" role="alert" style="width: 92em;margin-left: 378px;">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>{{session('success')}}</strong>
    </div>
    @endif
                <div class="am-tabs-bd">
                <!-- 邮箱注册开始 -->
                        <div class="am-tab-panel am-active">
                            <form method="post" action="/inert">
                            {{ csrf_field() }}
                                    <div class="user-email">
                                        <label for="email">
                                            <i class="am-icon-envelope-o"></i>
                                        </label>
                                        <input type="email" name="email" id="email" placeholder="请输入邮箱账号">
                                    </div>
                                    <div class="user-pass">
                                        <label for="password">
                                            <i class="am-icon-lock"></i>
                                        </label>
                                        <input type="password" name="upass"  id="upass"  placeholder="设置密码">
                                    </div>
                                    <div class="user-pass">
                                        <label for="passwordRepeat">
                                            <i class="am-icon-lock"></i>
                                        </label>
                                        <input type="password" name="repass" id="repass"  placeholder="确认密码">
                                    </div>
                                    <br>
                                    <input style="margin-left: 17px;width: 110px;" type="button" onclick="inert()"  value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                            </form>
                            <a href="/login"><input style="width: 110px;margin-top: -20px;font-size:20px;height: 42px;margin-left: 53px;" type="button" value="返回登录" class="am-btn am-btn-primary am-btn-sm am-fl"></a>
                        </div>
                <!-- 邮箱注册结束 -->


                <!-- 电话注册开始 -->
                    <div class="am-tab-panel">
                        <form method="post" action="/store">
                         {{ csrf_field() }}
                            <div class="user-phone">
                                <label for="phone">
                                    <i class="am-icon-mobile-phone am-icon-md"></i>
                                </label>
                                <input type="tel" name="phone" id="phone" placeholder="请输入手机号">
                            </div>
                            <div class="verification">
                                    <label for="code">
                                        <i class="am-icon-code-fork"></i>
                                    </label>
                                    <input type="tel" name="code"  placeholder="请输入验证码">
                                    <a class="btn" href="javascript:void(0);"    onclick="phonenumber(this)">
                                        <span id="dyMobileButton">获取</span>
                                    </a>
                            </div>
                            <div class="user-pass">
                                    <label for="password">
                                        <i class="am-icon-lock"></i>
                                    </label>
                                    <input type="password" name="upass"  placeholder="设置密码">
                            </div>
                            <div class="user-pass">
                                    <label for="passwordRepeat">
                                        <i class="am-icon-lock"></i>
                                    </label>
                                    <input type="password" name="repass"  placeholder="确认密码">
                            </div>
                            <div class="am-cf">
                                <input type="submit"   value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                            </div>
                        </form>
                        <hr>
                    </div>
                <!-- 电话注册结束 -->

                    <script>
                        // 邮箱注册电话注册互相切换
                        $(function() {$('#doc-my-tabs').tabs();})

                        $.ajaxSetup({
                        headers:{
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
                    });

                        // 电话注册开始
                        function phonenumber(obj){
                            // 获取用户的手机号
                            let phone = $('#phone').val();
                            // 验证格式
                            let phone_preg = /^1{1}[3-9]{1}[\d]{9}$/;

                            if (!phone_preg.test(phone)) {
                                layer.msg('手机号格式错误');
                                return false;
                            }
                            $(obj).attr('disabled',true);
                            $(obj).css('color','#ccc');
                            $(obj).css('cursor','no-drop');
                            $(obj).find('span').css('color','#ccc');
                            let time = null;


                            if ($('#dyMobileButton').html() == '获取') {
                                let i = 59;
                                time =  setInterval(function(){
                                    i--;
                                $(obj).find('span').html(i+'秒后');
                                    if (i < 1) {
                                        $(obj).attr('disabled',false);
                                        $(obj).css('color','#333');
                                        $(obj).css('cursor','ponter');
                                        $(obj).find('span').css('color','#333');
                                        $(obj).find('span').html('获取');
                                        clearInterval(time);
                                    }
                                },1000);



                               // 发送ajax 发送验证码
                               $.get('/sendPhome',{phone},function(res){
                                    fetch('url', {credentials:'include'});

                                    if (res.error_code == 0) {
                                        layer.alert('发送成功,验证码十分钟内有效', {icon: 1});

                                    }else{
                                        layer.msg('发送失败,请稍后重试!');
                                    }
                               },'json')

                            }
                        }

                        // 电话注册结束



                        // 邮箱注册开始
                            function inert(){
                                let email = $('#email').val();
                                let upass = $('#upass').val();
                                let repass = $('#repass').val();



                                if (upass != repass) {
                                    layer.msg('两次密码不一致', function(){

                                    });
                                    return false;
                                }

                                $.post('/inert',{email,upass,repass},function(res){

                                        if (res == 'no') {
                                            layer.msg('用户密码的长度不得少于6位', function(){
                                            //关闭后的操作
                                            });
                                            return false;
                                        };

                                        if (res == 'name') {
                                            layer.msg('此邮箱已经被注册', function(){
                                            //关闭后的操作
                                            });
                                            return false;
                                        };


                                        if (res == 1) {
                                            layer.alert('用户注册成功,注意查看邮箱,请尽快完成激活', {icon: 6});
                                            setTimeout(function(){
                                                window.location.href = '/login';
                                            },5000)
                                        }
                                   },'html');
                            }
                        // 邮箱注册结束
                    </script>
                </div>
            </div>
        </div>
    </div>
   <!-- 网站底部 -->
   @include('home.public.footer')
</body>
<script>
//一般直接写在一个js文件中
    layui.use(['layer', 'form'], function(){
      var layer = layui.layer
      ,form = layui.form;
    });
</script>
</html>