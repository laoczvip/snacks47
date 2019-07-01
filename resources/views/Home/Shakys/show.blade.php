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
        <div class="am-container header">
            <ul class="message-l">
                <div class="topMessage">
                    <div class="menu-hd">
                        <a href="/h/#" target="_top" class="h">亲，请登录</a>
                        <a href="/h/#" target="_top">免费注册</a>
                    </div>
                </div>
            </ul>
            <ul class="message-r">
                <div class="topMessage home">
                    <div class="menu-hd"><a href="/h/#" target="_top" class="h">商城首页</a></div>
                </div>
                <div class="topMessage my-shangcheng">
                    <div class="menu-hd MyShangcheng"><a href="/h/#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
                </div>
                <div class="topMessage mini-cart">
                    <div class="menu-hd"><a id="mc-menu-hd" href="/h/#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
                </div>
                <div class="topMessage favorite">
                    <div class="menu-hd"><a href="/h/#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
            </ul>
            </div>

            <!--悬浮搜索框-->

            <div class="nav white">
                <div class="logo"><img src="/h/images/logo.png" /></div>
                <div class="logoBig">
                    <li><img src="/h/images/logobig.png" /></li>
                </div>

                <div class="search-bar pr">
                    <a name="index_none_header_sysc" href="/h/#"></a>
                    <form>
                        <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
                        <input id="ai-topsearch" class="submit am-btn"  value="搜索" index="1" type="submit">
                    </form>
                </div>
            </div>
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
                                <div style="margin:50px auto; text-align:center;font-size:64px">-------------暂无资源----------</div>
                                @else
                                <ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
                                @forelse($shaky as $k=>$v)
                                
                               

                                    <li>
                                        <div class="i-pic limit">
                                            <a href="javascript:;" onclick="urls({{$v->gid}},{{$v->sid}})"><img src="/uploads/{{$goods_sku[$v->gid]}}"/></a>
                                            <p class="title fl" style="height:24px;line-height:12px;">
                                                <del>
                                                <b>原价</b>
                                                <b>¥</b>
                                                <strong>{{$v->original}}</strong>
                                                </del>
                                            </p>
                                            <p class="price fl" style="height:16px;line-height:8px;">
                                                <b>秒杀价格</b>
                                                <b>¥</b>
                                                <strong>{{$v->original-$v->preferential}}</strong>
                                            </p>
                                            <p class="number fl">
                                                剩余库存:<span>{{$v->stock}}</span>
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
                    <div class="footer">
                        <div class="footer-hd">
                            <p>
                                <a href="/h/#">恒望科技</a>
                                <b>|</b>
                                <a href="/h/#">商城首页</a>
                                <b>|</b>
                                <a href="/h/#">支付宝</a>
                                <b>|</b>
                                <a href="/h/#">物流</a>
                            </p>
                        </div>
                        <div class="footer-bd">
                            <p>
                                <a href="/h/#">关于恒望</a>
                                <a href="/h/#">合作伙伴</a>
                                <a href="/h/#">联系我们</a>
                                <a href="/h/#">网站地图</a>
                                <em>© 2015-2025 Hengwang.com 版权所有</em>
                            </p>
                        </div>
                    </div>
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
        <div class=tip>
            <div id="sidebar">
                <div id="wrap">
                    <div id="prof" class="item">
                        <a href="/h/#">
                            <span class="setting"></span>
                        </a>
                        <div class="ibar_login_box status_login">
                            <div class="avatar_box">
                                <p class="avatar_imgbox"><img src="/h/images/no-img_mid_.jpg" /></p>
                                <ul class="user_info">
                                    <li>用户名：sl1903</li>
                                    <li>级&nbsp;别：普通会员</li>
                                </ul>
                            </div>
                            <div class="login_btnbox">
                                <a href="/h/#" class="login_order">我的订单</a>
                                <a href="/h/#" class="login_favorite">我的收藏</a>
                            </div>
                            <i class="icon_arrow_white"></i>
                        </div>

                    </div>
                    <div id="shopCart" class="item">
                        <a href="/h/#">
                            <span class="message"></span>
                        </a>
                        <p>
                            购物车
                        </p>
                        <p class="cart_num">0</p>
                    </div>
                    <div id="asset" class="item">
                        <a href="/h/#">
                            <span class="view"></span>
                        </a>
                        <div class="mp_tooltip">
                            我的资产
                            <i class="icon_arrow_right_black"></i>
                        </div>
                    </div>

                    <div id="foot" class="item">
                        <a href="/h/#">
                            <span class="zuji"></span>
                        </a>
                        <div class="mp_tooltip">
                            我的足迹
                            <i class="icon_arrow_right_black"></i>
                        </div>
                    </div>

                    <div id="brand" class="item">
                        <a href="/h/#">
                            <span class="wdsc"><img src="/h/images/wdsc.png" /></span>
                        </a>
                        <div class="mp_tooltip">
                            我的收藏
                            <i class="icon_arrow_right_black"></i>
                        </div>
                    </div>

                    <div id="broadcast" class="item">
                        <a href="/h/#">
                            <span class="chongzhi"><img src="/h/images/chongzhi.png" /></span>
                        </a>
                        <div class="mp_tooltip">
                            我要充值
                            <i class="icon_arrow_right_black"></i>
                        </div>
                    </div>

                    <div class="quick_toggle">
                        <li class="qtitem">
                            <a href="/h/#"><span class="kfzx"></span></a>
                            <div class="mp_tooltip">客服中心<i class="icon_arrow_right_black"></i></div>
                        </li>
                        <!--二维码 -->
                        <li class="qtitem">
                            <a href="/h/#none"><span class="mpbtn_qrcode"></span></a>
                            <div class="mp_qrcode" style="display:none;"><img src="/h/images/weixin_code_145.png" /><i class="icon_arrow_white"></i></div>
                        </li>
                        <li class="qtitem">
                            <a href="/h/#top" class="return_top"><span class="top"></span></a>
                        </li>
                    </div>

                    <!--回到顶部 -->
                    <div id="quick_links_pop" class="quick_links_pop hide"></div>

                </div>

            </div>

            <div id="prof-content" class="nav-content">
                <div class="nav-con-close">
                    <i class="am-icon-angle-right am-icon-fw"></i>
                </div>
                <div>
                    我
                </div>
            </div>
            <div id="shopCart-content" class="nav-content">
                <div class="nav-con-close">
                    <i class="am-icon-angle-right am-icon-fw"></i>
                </div>
                <div>
                    购物车
                </div>
            </div>
            <div id="asset-content" class="nav-content">
                <div class="nav-con-close">
                    <i class="am-icon-angle-right am-icon-fw"></i>
                </div>
                <div>
                    资产
                </div>

                <div class="ia-head-list">
                    <a href="/h/#" target="_blank" class="pl">
                        <div class="num">0</div>
                        <div class="text">优惠券</div>
                    </a>
                    <a href="/h/#" target="_blank" class="pl">
                        <div class="num">0</div>
                        <div class="text">红包</div>
                    </a>
                    <a href="/h/#" target="_blank" class="pl money">
                        <div class="num">￥0</div>
                        <div class="text">余额</div>
                    </a>
                </div>

            </div>
            <div id="foot-content" class="nav-content">
                <div class="nav-con-close">
                    <i class="am-icon-angle-right am-icon-fw"></i>
                </div>
                <div>
                    足迹
                </div>
            </div>
            <div id="brand-content" class="nav-content">
                <div class="nav-con-close">
                    <i class="am-icon-angle-right am-icon-fw"></i>
                </div>
                <div>
                    收藏
                </div>
            </div>
            <div id="broadcast-content" class="nav-content">
                <div class="nav-con-close">
                    <i class="am-icon-angle-right am-icon-fw"></i>
                </div>
                <div>
                    充值
                </div>
            </div>
        </div>
        <script>
            window.jQuery || document.write('<script src="/h/basic/js/jquery-1.9.min.js"><\/script>');
        </script>
        <script type="text/javascript" src="/h/basic/js/quick_links.js"></script>

<div class="theme-popover-mask"></div>

    </body>

</html>