<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <link href="/bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <title>搜索页面</title>

        <link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
        <link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />

        <link href="/h/basic/css/demo.css" rel="stylesheet" type="text/css" />
        <link href="/h/css/seastyle.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="/bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/h/basic/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="/h/js/script.js"></script>
    </head>

    <body>

        <!--顶部导航条 -->
        @include('home.public.hmtop')
            <div class="clear"></div>
            <b class="line"></b>

           <div class="search">
            <div class="search-list">
            <div class="nav-table">
                       <div class="long-title"><span class="all-goods">秒杀商品</span></div>

                       <div class="nav-cont">
                            <ul>
                                <li class="index"><a href="" style=" font-weight:normal;"><div class="mytime jsTime2" data-time="{{$shaky_one->jtime}}" style="color:red;font-size:32px;"></div></a></li>

                            </ul>
                            <div class="nav-extra">
                                <i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
                                <i class="am-icon-angle-right" style="padding-left: 10px;"></i>
                            </div>
                        </div>
            </div>
            <script>
                 //时间格式处理
                 const formatNumber = n => {
                 n = n.toString();
                 return n[1] ? n : '0' + n;
                 };
                 //团购倒计时
                 const teamCountTime = (obj) => {
                 var timer = null;
                 function fn(){

                  //获取设置的时间 如：2019-3-28 14:00:00 ios系统得加正则.replace(/\-/g, '/');
                  var setTime = obj.getAttribute('data-time').replace(/\-/g, '/');
                  //获取当前时间
                  var date = new Date(),
                   now  = date.getTime(),
                   endDate = new Date(setTime),
                   end  = endDate.getTime();
                  //时间差
                  var leftTime = end - now;
                  //d,h,m,s 天时分秒
                  var d, h,m,s;
                  var otime = '';
                  if (leftTime >= 0) {
                  d = Math.floor(leftTime / 1000 / 60 / 60 / 24);
                  h = Math.floor(leftTime / 1000 / 60 / 60 % 24);
                  m = Math.floor(leftTime / 1000 / 60 % 60);
                  s = Math.floor(leftTime / 1000 % 60);
                  if (d <= 0) {
                   otime = [h, m, s].map(formatNumber).join(':');
                  } else {
                   otime = d + '天' + [h, m, s].map(formatNumber).join(':');
                  }
                  obj.innerHTML = '欢迎您来到秒杀页面！活动还剩余时间：' + otime;
                  //
                  timer = setTimeout(fn, 1e3);
                  } else {
                  clearTimeout(timer);
                  obj.innerHTML = '秒杀已结束';
                  if(obj.innerHTML=='秒杀已结束'){
                    $('#kaiqi').css('display','none');
                  }
                  }
                 }
                 fn();
                 };
                 let jsTimes = document.querySelectorAll('.jsTime2');
                 jsTimes.forEach((obj) => {
                 teamCountTime(obj);
                 });
            </script>

                    <div class="am-g am-g-fixed">
                        <div class="am-u-sm-12 am-u-md-12">
                        <div class="theme-popover">
                            <div class="clear"></div>
                        </div>
                            <div class="search-content">

                                <div class="clear"></div>

                                @if($shaky_one1 == null)
                                <div style="margin:20px auto; text-align:center;">-------------暂无商品----------</div>
                                @else
                                <ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
                                @forelse($shaky as $k=>$v)

                                    <li>
                                        <div class="i-pic limit">
                                            <a href="javascript:;" onclick="urls({{$v->gid}},{{$v->sid}})"><img src="/uploads/{{$goods_sku[$v->gid]}}"/></a>
                                            <p class="title fl" >
                                                <del>
                                                <b>原价</b>
                                                <b>¥</b>
                                                <strong>{{$v->original}}</strong>
                                                </del>
                                            </p>
                                            <p class="price fl">
                                                <b>秒杀价格</b>
                                                <b>¥</b>
                                                <strong>{{$v->original-$v->preferential}}</strong>
                                            </p>
                                            <p class="number f1">
                                                &nbsp;&nbsp;剩余库存:<span>{{$v->stock}}</span>
                                            </p>
                                        </div>
                                    </li>

                                @empty
                                @endforelse
                                </ul>
                                 @endif
                            </div>
<script>
    function urls(gid,sid){

        $.get('/home/personal/introduction',{sid:sid},function(res){

            if(res=='活动未开启'|| res=='活动已结束'){
                alert(res);
               document.location.href = "/";
            } else{

                document.location.href = "/home/personal/introduction?gids="+gid;
            }
        },'json');
    }

</script>
                        </div>
                        <nav aria-label="Page navigation">
                            <!--分页 -->
                            <aside>
                                {{$shaky->appends(['ids'=>$sids])->links()}}
                            </aside>
</nav>
                    </div>
                    @include('home.public.footer')
                </div>

            </div>

        <!--引导 -->
        <div class="navCir">
            <li><a href="/h/home.html"><i class="am-icon-home "></i>首页</a></li>
            <li><a href="/h/sort.html"><i class="am-icon-list"></i>分类</a></li>
            <li><a href="/h/shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>
            <li><a href="/h/person/index.html"><i class="am-icon-user"></i>我的</a></li>
        </div>

        <!--菜单 -->
    @include('home.public.tip')

        <script>
            window.jQuery || document.write('<script src="/h/basic/js/jquery-1.9.min.js"><\/script>');
        </script>
        <script type="text/javascript" src="/h/basic/js/quick_links.js"></script>

<div class="theme-popover-mask"></div>

    </body>

</html>