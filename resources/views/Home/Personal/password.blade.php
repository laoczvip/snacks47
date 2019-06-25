<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
        <title>修改密码</title>
        <link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
        <link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
        <link href="/h/css/personal.css" rel="stylesheet" type="text/css">
        <link href="/h/css/stepstyle.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="/h/js/jquery-1.7.2.min.js"></script>
        <script src="/h/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
        <link rel="icon" href="/uploads/{{ $weds->icon }}"/>
    </head>

    <body>
        <!--头 -->
        @include('home.public.hmtop')

            <div class="nav-table">
                       <div class="long-title"><span class="all-goods">全部分类</span></div>
                       <div class="nav-cont">
                            <ul>
                                <li class="index"><a href="#">首页</a></li>
                                <li class="qc"><a href="#">闪购</a></li>
                                <li class="qc"><a href="#">限时抢</a></li>
                                <li class="qc"><a href="#">团购</a></li>
                                <li class="qc last"><a href="#">大包装</a></li>
                            </ul>
                            <div class="nav-extra">
                                <i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
                                <i class="am-icon-angle-right" style="padding-left: 10px;"></i>
                            </div>
                        </div>
            </div>
            <b class="line"></b>
        <div class="center">
            <div class="col-main">
                <div class="main-wrap">

                    <div class="am-cf am-padding">
                        <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改密码</strong> / <small>Password</small></div>
                    </div>
                    <hr/>
                    <!--进度条-->
                    <div class="m-progress">
                        <div class="m-progress-list">
                            <span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">重置密码</p>
                            </span>
                            <span class="step-2 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                <p class="stage-name">完成</p>
                            </span>
                            <span class="u-progress-placeholder"></span>
                        </div>
                        <div class="u-progress-bar total-steps-2">
                            <div class="u-progress-bar-inner"></div>
                        </div>
                    </div>
                    <form class="am-form am-form-horizontal">
                        <div class="am-form-group">
                            <label for="user-old-password" class="am-form-label">原密码</label>
                            <div class="am-form-content">
                                <input type="password" name="upass" id="user-old-password" placeholder="请输入原登录密码">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-new-password" class="am-form-label">新密码</label>
                            <div class="am-form-content">
                                <input type="password" name="password" id="user-new-password" placeholder="由数字、字母组合">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-confirm-password" name="rupass" class="am-form-label">确认密码</label>
                            <div class="am-form-content">
                                <input type="password" id="user-confirm-password" placeholder="请再次输入上面的密码">
                            </div>
                        </div>
                        <div class="info-btn">
                            <div class="am-btn am-btn-danger" onclick="password()">保存修改</div>
                        </div>

                    </form>

                    <script>

                        function password(){
                            let upass = $('#user-old-password').val();
                            let password = $('#user-new-password').val();
                            let rupass = $('#user-confirm-password').val();


                            if (password != rupass) {
                                layer.msg('两次密码不一致', function(){
                                //关闭后的操作
                                });
                                return false;
                            }

                            $.get('/center/ImplementPassword',{upass,password,rupass},function(res){
                                if(upass == null || upass == "" || upass == undefined){
                                        layer.msg('请输入原密码', function(){

                                        } );
                                        return false;

                                }else if (res == 1) {
                                    layer.msg('原密码错误', function(){
                                    //关闭后的操作
                                    });
                                    return false;
                                }else if(res == 2){
                                     layer.msg('请输入新的密码', function(){
                                    //关闭后的操作
                                    });
                                    return false;

                                }else if(res == 3){
                                    layer.msg('密码不能少于六位数', function(){
                                    //关闭后的操作
                                    });
                                    return false;
                                }else if(res == 4){
                                    layer.msg('修改成功,建议重新登录!', {
                                      time: 0 //不自动关闭
                                      ,btn: ['好的', '稍后']
                                      ,yes: function(index){
                                        layer.close(index);
                                        window.location.href = '/out';

                                      }
                                    });
                                };


                            },'html');
                        }
                    </script>


                </div>
                <!--底部-->
        @include('home.public.footer')
            </div>
        @include('home.public.list')

        </div>

    </body>

</html>