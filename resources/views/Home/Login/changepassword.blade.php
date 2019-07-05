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
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="login-boxtitle">
        <a href="/"><img alt="logo" src="/h/images/logobig.png" /></a>
    </div>
    <div class="login-banner">
        <div class="login-main">
            <div class="login-banner-bg"><span></span><img src="/h/images/big.jpg" /></div>
            <div class="login-box">
                        <h3 class="title">找回密码</h3>
                        <div class="clear"></div>
                    <div class="login-form">
                       <div class="am-tab-panel">
                        <form method="post" action="/updatepassword">
                         {{ csrf_field() }}
                          <div class="user-name">
                                <label for="user"><i class="am-icon-user"></i></label>
                                <input type="text" name="number" id="number" placeholder="邮箱/手机/用户名">
                            </div>
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
                                    <input type="tel" name="code"  id="code" placeholder="请输入验证码">
                                    <a class="btn" href="javascript:void(0);"  onclick="phonenumber(this)">
                                        <span id="dyMobileButton">获取</span>
                                    </a>
                            </div>
                            <div class="user-pass">
                                    <label for="password">
                                        <i class="am-icon-lock"></i>
                                    </label>
                                    <input type="password" name="upass" id="upass"  placeholder="设置密码">
                            </div>
                            <div class="user-pass">
                                    <label for="passwordRepeat">
                                        <i class="am-icon-lock"></i>
                                    </label>
                                    <input type="password" name="repass" id="repass"  placeholder="确认密码">
                            </div>
                            <div class="am-cf">
                                <input type="submit" onclick="update()"  value="找回密码" class="am-btn am-btn-primary am-btn-sm am-fl">
                            </div>
                        </form>
                        <hr>
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
      // layer.alert('见到你真的很高兴', {icon: 6});

    });
</script>
<script>
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // 用户名/手机号码 验证  发送短信
    function phonenumber(obj){
            // 获取用户名
            let number = $('#number').val();

            if(number == null || number == "" || number == undefined){
                layer.msg('请输入用户名', function(){} );
                return false;
            }

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

            // 验证手机号码
            $.post('/carriedchangepassword',{number,phone},function(res){
                if (res == 0) {
                    layer.msg('账号或手机号不存在');
                    return false;
                }else if(res == 3){
                    layer.msg('用户不存在或者已被删除');
                    return false;
                }
            })


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
        function update(){
            let upass = $('#upass').val();
            let repass = $('#repass').val();
            let code = $('#code').val();

            if(upass == null || upass == "" || upass == undefined){
                layer.msg('请输入密码', function(){} );
                event.preventDefault();
            }

            if(upass != repass){
                layer.msg('两次密码不一致', function(){} );
                event.preventDefault();
            }

            if(code == null || code == "" || code == undefined){
                layer.msg('请输入验证码', function(){} );
                event.preventDefault();
            }
        }
</script>

</html>