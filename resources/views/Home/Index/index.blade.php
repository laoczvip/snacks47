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
                            <li class="banner1" style="background-color: #fff;width:100px;"><a href="{{ $v->jump }}"><img src="/uploads/{{ $v->url }}"; style="width:60%;height:100%;"></a></li>
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

                                                                    <dt><span title="蛋糕">{{$val->title}}</span></dt>
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
                                <span>[头条]</span>{{ $v->htitle }}
                            </a></li>
                           @endforeach
                    @if(!session('home_login'))
                    <div class="mod-vip">
                        <div class="m-baseinfo">
                            <a href="person/index.html">
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
                            <li><a target="_blank" href="/home/headlines_data/index?id={{ $v->id }}"><span>[特惠]</span>{{ $v->htitle }}</a></li>
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
                    <div class="am-u-sm-4 am-u-lg-3 ">
                        <div class="info ">
                            <h3>真的有鱼</h3>
                            <h4>开年福利篇</h4>
                        </div>
                        <div class="recommendationMain one">
                            <a href="introduction.html"><img src="/h/images/tj.png "></img></a>
                        </div>
                    </div>
                    <div class="am-u-sm-4 am-u-lg-3 ">
                        <div class="info ">
                            <h3>囤货过冬</h3>
                            <h4>让爱早回家</h4>
                        </div>
                        <div class="recommendationMain two">
                            <img src="/h/images/tj1.png "></img>
                        </div>
                    </div>
                    <div class="am-u-sm-4 am-u-lg-3 ">
                        <div class="info ">
                            <h3>浪漫情人节</h3>
                            <h4>甜甜蜜蜜</h4>
                        </div>
                        <div class="recommendationMain three">
                            <img src="/h/images/tj2.png "></img>
                        </div>
                    </div>

                </div>
                <div class="clear "></div>
                <!--热门活动 -->

                <div class="am-container activity ">
                    <div class="shopTitle ">
                        <h4>活动</h4>
                        <h3>每期活动 优惠享不停 </h3>
                        <span class="more ">
                          <a href="# ">全部活动<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                    </span>
                    </div>
                  <div class="am-g am-g-fixed ">
                    <div class="am-u-sm-3 ">
                        <div class="icon-sale one "></div>
                            <h4>秒杀</h4>
                        <div class="activityMain ">
                            <img src="/h/images/activity1.jpg "></img>
                        </div>
                        <div class="info ">
                            <h3>春节送礼优选</h3>
                        </div>
                    </div>

                    <div class="am-u-sm-3 ">
                      <div class="icon-sale two "></div>
                        <h4>特惠</h4>
                        <div class="activityMain ">
                            <img src="/h/images/activity2.jpg "></img>
                        </div>
                        <div class="info ">
                            <h3>春节送礼优选</h3>
                        </div>
                    </div>

                    <div class="am-u-sm-3 ">
                        <div class="icon-sale three "></div>
                        <h4>团购</h4>
                        <div class="activityMain ">
                            <img src="/h/images/activity3.jpg "></img>
                        </div>
                        <div class="info ">
                            <h3>春节送礼优选</h3>
                        </div>
                    </div>

                    <div class="am-u-sm-3 last ">
                        <div class="icon-sale "></div>
                        <h4>超值</h4>
                        <div class="activityMain ">
                            <img src="/h/images/activity.jpg "></img>
                        </div>
                        <div class="info ">
                            <h3>春节送礼优选</h3>
                        </div>
                    </div>

                  </div>
               </div>
                <div class="clear "></div>

                @forelse($cates as $cate)
                <div id="f1">
                <!--甜点-->

                <div class="am-container ">
                    <div class="shopTitle ">
                        <h4>{{$cate->title}}</h4>
                        <h3>每一道甜品都有一个故事</h3>
                        <div class="today-brands ">
                        @forelse($cate->sub as $val)
                            <a href="# ">{{$val->title}}</a>
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
                            <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
                        </div>
                        <a href="# ">
                            <div class="outer-con ">
                                <div class="title ">
                                开抢啦！
                                </div>
                                <div class="sub-title ">
                                    零食大礼包
                                </div>
                            </div>
                              <img src="/h/images/act1.png " />
                        </a>
                        <div class="triangle-topright"></div>
                    </div>



                     @forelse($goods as $goods_data)
                     @forelse($cate->sub as $cate_data)
                     @forelse($cate_data->sub as $cate_datas)

                     @if($goods_data->cid==$cate_datas->id)


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
                            <a href="/home/personal/introduction?id={{$goods_data->gid}}&cid={{$goods_data->cid}}"><img  height="60%" src="/uploads/{{$goods_data->showcase}}" /></a>
                        </div>


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
    <div class=tip>
        <div id="sidebar">
            <div id="wrap">
                <div id="prof" class="item ">
                    <a href="# ">
                        <span class="setting "></span>
                    </a>
                    @if(!session('home_login'))
                    <div class="ibar_login_box status_login ">
                        <div class="avatar_box ">
                            <p class="avatar_imgbox "><img src="/h/images/no-img_mid_.jpg " /></p>
                            <ul class="user_info ">
                                <li>请先登陆</li>
                                <li>级&nbsp;别普通会员</li>
                            </ul>
                        </div>
                        <div class="login_btnbox ">
                            <a href="# " class="login_order ">我的订单</a>
                            <a href="# " class="login_favorite ">我的收藏</a>
                        </div>
                        <i class="icon_arrow_white "></i>
                    </div>
                    @else

                    <div class="ibar_login_box status_login ">
                        <div class="avatar_box ">
                            <p class="avatar_imgbox "><img src="uploads/{{session('home_user')->userinfo->ufile}}" /></p>
                            <ul class="user_info ">
                                <li>{{ session('home_user')->name }}</li>
                                <li>级&nbsp;别普通会员</li>
                            </ul>
                        </div>
                        <div class="login_btnbox ">
                            <a href="# " class="login_order ">我的订单</a>
                            <a href="# " class="login_favorite ">我的收藏</a>
                        </div>
                        <i class="icon_arrow_white "></i>
                    </div>
                    @endif
                </div>
                <div id="shopCart " class="item ">
                    <a href="# ">
                        <span class="message "></span>
                    </a>
                    <p>
                        购物车
                    </p>
                    <p class="cart_num ">0</p>
                </div>
                <div id="asset " class="item ">
                    <a href="# ">
                        <span class="view "></span>
                    </a>
                    <div class="mp_tooltip ">
                        我的资产
                        <i class="icon_arrow_right_black "></i>
                    </div>
                </div>

                <div id="foot " class="item ">
                    <a href="# ">
                        <span class="zuji "></span>
                    </a>
                    <div class="mp_tooltip ">
                        我的足迹
                        <i class="icon_arrow_right_black "></i>
                    </div>
                </div>

                <div id="brand " class="item ">
                    <a href="#">
                        <span class="wdsc "><img src="/h/images/wdsc.png " /></span>
                    </a>
                    <div class="mp_tooltip ">
                        我的收藏
                        <i class="icon_arrow_right_black "></i>
                    </div>
                </div>

                <div id="broadcast " class="item ">
                    <a href="# ">
                        <span class="chongzhi "><img src="/h/images/chongzhi.png " /></span>
                    </a>
                    <div class="mp_tooltip ">
                        我要充值
                        <i class="icon_arrow_right_black "></i>
                    </div>
                </div>

                <div class="quick_toggle ">
                    <li class="qtitem ">
                        <a href="# "><span class="kfzx "></span></a>
                        <div class="mp_tooltip ">客服中心<i class="icon_arrow_right_black "></i></div>
                    </li>
                    <!--二维码 -->
                    <li class="qtitem ">
                        <a href="#none "><span class="mpbtn_qrcode "></span></a>
                        <div class="mp_qrcode " style="display:none; "><img src="/h/images/weixin_code_145.png " /><i class="icon_arrow_white "></i></div>
                    </li>
                    <li class="qtitem ">
                        <a href="#top " class="return_top "><span class="top "></span></a>
                    </li>
                </div>

                <!--回到顶部 -->
                <div id="quick_links_pop " class="quick_links_pop hide "></div>

            </div>

        </div>
        <div id="prof-content " class="nav-content ">
            <div class="nav-con-close ">
                <i class="am-icon-angle-right am-icon-fw "></i>
            </div>
            <div>
                我
            </div>
        </div>
        <div id="shopCart-content " class="nav-content ">
            <div class="nav-con-close ">
                <i class="am-icon-angle-right am-icon-fw "></i>
            </div>
            <div>
                购物车
            </div>
        </div>
        <div id="asset-content " class="nav-content ">
            <div class="nav-con-close ">
                <i class="am-icon-angle-right am-icon-fw "></i>
            </div>
            <div>
                资产
            </div>

            <div class="ia-head-list ">
                <a href="# " target="_blank " class="pl ">
                    <div class="num ">0</div>
                    <div class="text ">优惠券</div>
                </a>
                <a href="# " target="_blank " class="pl ">
                    <div class="num ">0</div>
                    <div class="text ">红包</div>
                </a>
                <a href="# " target="_blank " class="pl money ">
                    <div class="num ">￥0</div>
                    <div class="text ">余额</div>
                </a>
            </div>

        </div>
        <div id="foot-content " class="nav-content ">
            <div class="nav-con-close ">
                <i class="am-icon-angle-right am-icon-fw "></i>
            </div>
            <div>
                足迹
            </div>
        </div>
        <div id="brand-content " class="nav-content ">
            <div class="nav-con-close ">
                <i class="am-icon-angle-right am-icon-fw "></i>
            </div>
            <div>
                收藏
            </div>
        </div>
        <div id="broadcast-content " class="nav-content ">
            <div class="nav-con-close ">
                <i class="am-icon-angle-right am-icon-fw "></i>
            </div>
            <div>
                充值
            </div>
        </div>
    </div>
    <script>
        window.jQuery || document.write('<script src="/h/basic/js/jquery.min.js "><\/script>');
    </script>
    <script type="text/javascript " src="/h/basic/js/quick_links.js "></script>
</body>

</html>