<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>后台登录</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="/a/css/style.css" />
<style>
canvas{z-index:-1;position:absolute;}
</style>
<script src="/a/js/jquery.js"></script>
<script src="/a/js/verificationNumbers.js"></script>
<script src="/a/js/Particleground.js"></script>

</head>
<body style="background:url('/a/images/1560848875.jpg');background-size: cover;">
  <dl class="admin_login">
  <form action="/admin/dologin" method="post">
  {{ csrf_field() }}

     <dt>
        <strong>站点后台管理系统</strong>
        <em>Management System</em>
     </dt>
     <br>
     <dd class="user_icon">
        <input type="text" name="number"  id="number" placeholder="账号" class="login_txtbx" autocomplete="off"/>
     </dd>
     <dd class="pwd_icon">
        <input type="password" name="password" id="password" placeholder="密码" class="login_txtbx" autocomplete="off"/>
     </dd>
     <br>
     <dd>
        <input type="button" onClick="login()" value="立即登录" class="submit_btn"/>
     </dd>
    </form>
     <dd>
        <p>© 2015-2016 DeathGhost 版权所有</p>
        <p>陕B2-20080224-1</p>
     </dd>
  </dl>
</body>
<script src="/layui/layui.js"></script>
<script>
//一般直接写在一个js文件中
    layui.use(['layer', 'form'], function(){
      var layer = layui.layer
      ,form = layui.form;


    });
</script>

    <script>
        function login(){
            let number = $('#number').val();
            let password = $('#password').val();
             $.get('/admin/dologin',{number,password},function(res){
                if (res == 1) {
                    layer.msg('用户名或密码错误', {icon: 2});
                    return false;
                };
                window.location.href = '/admin';
            },'html');
        }
    </script>

</html>
