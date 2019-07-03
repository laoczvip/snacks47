<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
        <title>个人资料</title>
        <link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
        <link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
        <link href="/h/css/personal.css" rel="stylesheet" type="text/css">
        <link href="/h/css/infstyle.css" rel="stylesheet" type="text/css">
        <script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="/h/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>
        <link rel="icon" href="/uploads/{{ $weds->icon }}"/>
        <script src="/layer/layer.js" type="text/javascript" charset="utf-8"></script>
    </head>
    <body>
        <!--头 -->
        @include('home.public.hmtop')

    <!-- 显示错误报告 开始 -->
    @if(session('error'))
            <script>
                    layer.msg("{{session('error')}}", {icon: 5});
            </script>
    @endif
    @if(session('success'))
            <script>
                    layer.msg("{{session('success')}}", {icon: 6});
            </script>
    @endif
    <!-- 显示错误报告 结束 -->
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
                <form action="/center/ImplementInformation" method="post" class="am-form am-form-horizontal"  enctype="multipart/form-data">

                    <div class="user-info">
                        <!--标题 -->
                        <div class="am-cf am-padding">
                            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
                        </div>
                        <hr/>

                        <!--头像 -->
                        <div class="user-infoPic">

                            <div class="filePic">
                                <input type="file" name="ufile" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
                                <input type="hidden" name="file" value="{{session('home_user')->userinfo->ufile}}">
                                <img class="am-circle am-img-thumbnail" src="/uploads/{{session('home_user')->userinfo->ufile}}" alt="" />
                            </div>

                            <p class="am-form-help">头像</p>

                            <div class="info-m">
                                <div><b>账号：<i>{{session('home_user')->number}}</i></b></div>
                                <div><b>昵称：<i>{{session('home_user')->name}}</i></b></div>
                                <div class="u-level">
                                    <span class="rank r2">
                                         <s class="vip1"></s><a class="classes" href="#">铜牌会员</a>
                                    </span>
                                </div>
                                <div class="u-safety">
                                    <a href="safety.html">
                                     账户安全
                                    <span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">60分</i></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!--个人信息 -->
                        <div class="info-main">
                            {{ csrf_field() }}
                                <div class="am-form-group">
                                    <label for="user-name2" class="am-form-label">昵称</label>
                                    <div class="am-form-content">
                                        <input type="text" id="user-name2" name="name" value="{{ session('home_user')->name }}" placeholder="你的昵称">

                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-phone" class="am-form-label">电话</label>
                                    <div class="am-form-content">
                                        <input id="user-phone" placeholder="你的联系方式" name="tel" value="{{ session('home_user')->userinfo->tel}}" type="tel">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-email" class="am-form-label">电子邮件</label>
                                    <div class="am-form-content">
                                        <input id="user-email" placeholder="Email" name="email" value="{{ session('home_user')->email}}" type="email">
                                    </div>
                                </div>

                                <div class="info-btn">
                                    <input type="submit"  class="am-btn am-btn-danger" value="保存修改">
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
                <!--底部-->
        @include('home.public.footer')

            </div>
        @include('home.public.list')

        </div>

    </body>

</html>