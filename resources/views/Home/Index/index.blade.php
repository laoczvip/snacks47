<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ $weds->name  }}</title>
    <link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
    <link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />
    <link href="/h/basic/css/demo.css" rel="stylesheet" type="text/css" />
    <link href="/h/css/hmstyle.css" rel="stylesheet" type="text/css"/>
    <link href="/h/css/skin.css" rel="stylesheet" type="text/css" />
    <script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
    <script src="/h/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
    <link rel="icon" href="/uploads/{{ $weds->icon }}"/>
     <style type="text/css">
    .hides {
      overflow:hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
     </style>
</head>
<body>
        @include('home.public.hmtop')
        <div class="clear"></div>
        </div>
        <div class="banner">
                  <!--轮播 -->
                    <div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
                        <ul class="am-slides">
                            @foreach($banners_data as $k=>$v)
                            <li class="banner1" style="background-color: #fff;width:100px;"><a href="{{ $v->jump }}"><img src="/uploads/{{ $v->url }}"; style="width:42%;height:100%;"></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="clear"></div>
        </div>
        <div class="shopNav">
            <div class="slideall">

                   <div class="long-title"><span class="all-goods">全部分类</span></div>
                   <div class="nav-cont">
                        <ul>
                            <li class="index"><a href="/index.php">首页</a></li>
                        </ul>
                    </div>

                    <!--侧边导航 -->
                    <div id="nav" class="navfull">
                        <div class="area clearfix">
                            <div class="category-content" id="guide_2">

                                <div class="category">
                                    <ul class="category-list" id="js_climit_li">
                                      @forelse($cates as $cate)
                                        <?php static $i = 1;?>
                                        @if($cate->status==1)
                                        <li class="appliance js_toggle relative first">
                                            <div class="category-info">
                                                <h3 class="category-name b-category-name"><i><img src="/h/images/<?php echo  $i++;?>.png"></i><a class="ml-22" title="点心">{{$cate->title}}</a></h3>
                                                <em>&gt;</em></div>
                                            <div class="menu-item menu-in top">
                                                <div class="area-in">
                                                    <div class="area-bg">
                                                        <div class="menu-srot">
                                                            <div class="sort-side">

                                                             @forelse($cate->sub as $val)
                                                             @if($val->status==1)
                                                                <dl class="dl-sort">

                                                                    <dt><span title="{{$val->title}}">{{$val->title}}</span></dt>
                                                                     @forelse($val->sub as $v)

                                                                     @if($v->status==1)
                                                                    <dd><a href="/home/personal/search?id={{$v->id}}"><span>{{$v->title}}</span></a></dd>
                                                                     @endif
                                                                     @empty
                                                                     @endforelse
                                                                </dl>
                                                              @endif
                                                             @empty
                                                             @endforelse

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <b class="arrow"></b>
                                        </li>
                                       @endif
                                      @empty
                                      @endforelse

                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!--轮播-->

                    <script type="text/javascript">
                        (function() {
                            $('.am-slider').flexslider();
                        });
                        $(document).ready(function() {
                            $("li").hover(function() {
                                $(".category-content .category-list li.first .menu-in").css("display", "none");
                                $(".category-content .category-list li.first").removeClass("hover");
                                $(this).addClass("hover");
                                $(this).children("div.menu-in").css("display", "block")
                            }, function() {
                                $(this).removeClass("hover")
                                $(this).children("div.menu-in").css("display", "none")
                            });
                        })
                    </script>



                <!--小导航 -->
                <div class="am-g am-g-fixed smallnav">
                    <div class="am-u-sm-3">
                        <a href="sort.html"><img src="/h/images/navsmall.jpg" />
                            <div class="title">商品分类</div>
                        </a>
                    </div>
                    <div class="am-u-sm-3">
                        <a href="#"><img src="/h/images/huismall.jpg" />
                            <div class="title">大聚惠</div>
                        </a>
                    </div>
                    <div class="am-u-sm-3">
                        <a href="/center/index"><img src="/h/images/mansmall.jpg" />
                            <div class="title">个人中心</div>
                        </a>
                    </div>
                    <div class="am-u-sm-3">
                        <a href="#"><img src="/h/images/moneysmall.jpg" />
                            <div class="title">投资理财</div>
                        </a>
                    </div>
                </div>

                <!--走马灯 -->

                <div class="marqueen" style="margin-left: 1px;">
                    <span class="marqueen-title">商城头条</span>
                    <div class="demo">

                        <ul>
                            @foreach($headlines_asc as $k=>$v)

                            <li class="title-first"><a target="_blank" href="/home/headlines_data/index?id={{ $v->id }}">
                                <img src="/h/images/TJ2.jpg"></img>
                                <span></span>{{ $v->htitle }}
                            </a></li>
                           @endforeach
                    @if(!session('home_login'))
                    <div class="mod-vip">
                        <div class="m-baseinfo">
                            <a href="/login">
                                <img src="/h/images/getAvatar.do.jpg">
                            </a>
                            <em>
                                Hi,<span class="s-name">请先登陆</span>
                                <a href="#"><p>点击更多优惠活动</p></a>
                            </em>
                        </div>
                        <div class="member-logout">
                            <a class="am-btn-warning btn" href="/login">登录</a>
                            <a class="am-btn-warning btn" href="/register">注册</a>
                        </div>
                        <div class="member-login">
                            <a href="#"><strong>0</strong>待收货</a>
                            <a href="#"><strong>0</strong>待发货</a>
                            <a href="#"><strong>0</strong>待付款</a>
                            <a href="#"><strong>0</strong>待评价</a>
                        </div>
                        <div class="clear"></div>
                    </div>
                    @else
                    <div class="mod-vip">
                        <div class="m-baseinfo">
                            <a href="/center/index">
                                <img src="uploads/{{session('home_user')->userinfo->ufile}}">
                            </a>
                            <em>
                                Hi,<span class="s-name">{{  session('home_user')->name }}</span>
                                <a href="#"><p>点击更多优惠活动</p></a>
                            </em>
                        </div>
                        <div class="member-logout">
                            <a class="am-btn-warning btn" href="/center/index">个人中心</a>
                        </div>

                        <div class="member-logout" style="margin-top: -24px;margin-left: 99px;"">
                            <a class="am-btn-warning btn" href="/out">退出登陆</a>
                        </div>


                        <div class="member-login">
                            <a href="#"><strong>0</strong>待收货</a>
                            <a href="#"><strong>0</strong>待发货</a>
                            <a href="#"><strong>0</strong>待付款</a>
                            <a href="#"><strong>0</strong>待评价</a>
                        </div>
                        <div class="clear"></div>
                    </div>
                    @endif
                            @foreach($headlines_desc as $k=>$v)
                            <li><a target="_blank" href="/home/headlines_data/index?id={{ $v->id }}"><span></span>{{ $v->htitle }}</a></li>
                            @endforeach

                        </ul>
                    <div class="advTip"><img src="/h/images/advTip.jpg"/></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <script type="text/javascript">
                if ($(window).width() < 640) {
                    function autoScroll(obj) {
                        $(obj).find("ul").animate({
                            marginTop: "-39px"
                        }, 500, function() {
                            $(this).css({
                                marginTop: "0px"
                            }).find("li:first").appendTo(this);
                        })
                    }
                    $(function() {
                        setInterval('autoScroll(".demo")', 3000);
                    })
                }
            </script>
        </div>
        <div class="shopMainbg">
            <div class="shopMain" id="shopmain">

                <!--今日推荐 -->

                <div class="am-g am-g-fixed recommendation">
                    <div class="clock am-u-sm-3" >
                        <img src="/h/images/2016.png "></img>
                        <p>今日<br>推荐</p>
                    </div>

                    @foreach($buy as $k=>$v)
                     <div class="am-u-sm-4 am-u-lg-3 ">
                            <div class="info"; style="width:150px;">
                                <h3 class="hides";>{{ $v->title }}</h3>
                                <h4>暑假福利篇</h4>
                            </div>
                            <div class="recommendationMain one">
                                <a href="/home/personal/introduction?ids={{$v->gid}}"><img style="width:120px;height:110px;" src="/uploads/{{ $v->showcase }} "></img></a>
                            </div>
                     </div>
                     @endforeach


                </div>
                <div class="clear "></div>
                <!--热门活动 -->
                        <style>
                          .mytime{ line-height: 20px; width: 300px; margin: 0 auto;color:red;padding: :0px;}
                         </style>
                <div class="am-container activity ">
                    <div class="shopTitle ">
                        <h4>活动</h4>
                        <h3>每期活动 优惠享不停 </h3>
                        <span class="more ">
                          <a href="# ">全部活动<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                    </span>
                    </div>
                 <div class="am-g am-g-fixed ">
                  @forelse($shaky as $shaky_data)


                        <div class="am-u-sm-3">
                            <div class="icon-sale one "></div>
                                <a href="javascript:;" onclick="urls({{$shaky_data->id}})"><h4>{{$shaky_data->sname}}</h4> </a>
                            <div class="activityMain ">
                                <img src="/uploads/{{$shaky_data->profile}} " height="100%">
                            </div>


                        <div class="mytime jsTime" data-time="{{$shaky_data->ctime}}" id="kaiqi"></div>

                        <div class="mytime jsTime2" data-time="{{$shaky_data->jtime}}">时间1</div>
                      </div>
                 @empty
                 @endforelse

               </div>
               <script src="/layui/layui.js">
               layui.use('layer',
                    function(){
                        var layer = layui.layer;
                });
                </script>

               <!-- 验证时间是否符合条件，符合跳转到商品页面 -->
<script>

    function urls(id){
        $.get('home/shakys/show',{id:id},function(res){
            if(res=='活动未开启'|| res=='活动已结束'){
                layer.msg(res, {icon: 5});

            } else{

                document.location.href = "/home/shakys/show?ids="+id;
            }
        },'json');
    }

</script>
        </div>
<script>
     const countdown = {
      domList : document.querySelectorAll('.jsTime'),
      formatNumber(n){
       // return n.toString().padStart(2, '0'); // 用padStart方法要注意兼容问题
       n = n.toString();
       return n[1] ? n : '0' + n;
      },
      setTime(dom){
       //获取设置的时间 如：2019-3-28 14:00:00 ios系统得加正则.replace(/\-/g, '/');
       const leftTime = new Date(dom.getAttribute('data-time').replace(/\-/g, '/')) - new Date();
       if (leftTime >= 0) {
        const d = Math.floor(leftTime / 1000 / 60 / 60 / 24);
        const h = Math.floor(leftTime / 1000 / 60 / 60 % 24);
        const m = Math.floor(leftTime / 1000 / 60 % 60);
        const s = Math.floor(leftTime / 1000 % 60);
        dom.innerHTML = `剩余${ d > 0 ? d + '天' : '' }${ [h, m, s].map(this.formatNumber).join(':') }`;
       } else {
        clearInterval(dom.$timer);
        dom.innerHTML = '秒杀已开启';
       }
      },
      start(){
       this.domList.forEach((dom) => {
        this.setTime(dom);
        dom.$timer = setInterval(() => {
         this.setTime(dom);
        }, 1e3);
       });
      },
     };
     countdown.start();
</script>
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
      obj.innerHTML = '秒杀活动离结束还有' + otime;
      //
      timer = setTimeout(fn, 1e3);
      } else {
      clearTimeout(timer);
      obj.innerHTML = '秒杀已结束';
      if(obj.innerHTML=='秒杀已结束'){
        $('.am-u-sm-3 > #kaiqi').css('display','none');
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
                <div class="clear "></div>
                <span hidden>{{$i = 1}}</span>
                <span hidden>{{$a = 1}}</span>
                @forelse($cates as $cate)
                <div id="f{{$a++}}">
                <!--甜点-->

                <div class="am-container ">
                    <div class="shopTitle ">
                        <h4>{{$cate->title}}</h4>
                        <h3>每一道甜品都有一个故事</h3>
                        <div class="today-brands ">
                        @forelse($cate->sub as $val)
                            <a href="/">{{$val->title}}</a>
                        @empty
                        @endforelse
                        </div>
                        <span class="more ">
                <a href="# ">更多美味<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                    </span>
                    </div>
                </div>

                <div class="am-g am-g-fixed floodFour" style="overflow: hidden;  text-overflow: ellipsis;height:480px;">
                    <div class="am-u-sm-5 am-u-md-4 text-one list ">
                        <div class="word">
                        @forelse($cate->sub as $val)
                            <a class="outer" href="#"><span class="inner"><b class="text">{{$val->title}}</b></span></a>
                        @empty
                        @endforelse
                        </div>
                        <a href="# ">
                              <img src="/h/images/act{{$i++}}.png " />
                        </a>
                        <div class="triangle-topright"></div>
                    </div>



                     @forelse($goods as $goods_data)

                         @forelse($cate->sub as $cate_data)
                             @forelse($cate_data->sub as $cate_datas)

                                 @if($goods_data->cid==$cate_datas->id)
                                     @if($goods_data->sid == 0)

                                        <div class="am-u-sm-3 am-u-md-2 text-two">
                                            <div class="outer-con">
                                                <div class="title " style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;width:100px;">
                                                   {{$goods_data->title}}
                                                </div>
                                                <div class="sub-title ">
                                                    ¥{{$goods_data->price}}
                                                </div>
                                                <i class="am-icon-shopping-basket am-icon-md  seprate"></i>
                                            </div>
                                            <a href="/home/personal/introduction?ids={{$goods_data->gid}}"><img  height="60%" src="/uploads/{{$goods_data->showcase}}" /></a>
                                        </div>

                                    @endif
                                @endif
                            @empty
                            @endforelse
                         @empty
                        @endforelse
                     @empty
                    @endforelse

                </div>
             <div class="clear "></div>
             </div>
            @empty
            @endforelse








                <div class="clear "></div>
                </div>



                @include('home.public.footer')

    </div>
    </div>
    <!--引导 -->
    <div class="navCir">
        <li class="active"><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
        <li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
        <li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>
        <li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li>
    </div>


    <!--菜单 -->
    @include('home.public.tip')
    <script>
        window.jQuery || document.write('<script src="/h/basic/js/jquery.min.js "><\/script>');
    </script>
    <script type="text/javascript " src="/h/basic/js/quick_links.js "></script>
</body>

</html>