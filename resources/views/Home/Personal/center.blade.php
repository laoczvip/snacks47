<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
        <title>个人中心</title>
        <link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
        <link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
        <link href="/h/css/personal.css" rel="stylesheet" type="text/css">
        <link href="/h/css/systyle.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="/uploads/{{ $weds->icon }}"/>
    </head>
    <body>
        <!--头 -->
        @include('home.public.hmtop')

            <div class="nav-table">
                       <div class="long-title"><span class="all-goods">全部分类</span></div>
                       <div class="nav-cont">
                            <ul>
                                <li class="index"><a href="/">首页</a></li>
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
                    <div class="wrap-left">
                        <div class="wrap-list">
                            <div class="m-user">
                                <!--个人信息 -->
                                <div class="m-bg"></div>
                                <div class="m-userinfo">
                                    <div class="m-baseinfo">
                                        <a href="information.html">
                                            <img src="/uploads/{{session('home_user')->userinfo->ufile}}">
                                        </a>
                                        <em class="s-name">({{session('home_user')->name}})<span class="vip1"></em>
                                        <div class="s-prestige am-btn am-round">
                                            </span>会员福利</div>
                                    </div>
                                    <div class="m-right">
                                        <div class="m-new">
                                            <a href="news.html"><i class="am-icon-bell-o"></i>消息</a>
                                        </div>
                                        <div class="m-address">
                                            <a href="address.html" class="i-trigger">我的收货地址</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-container-bottom"></div>

                            <!--订单 -->
                            <div class="m-order">
                                <div class="s-bar">
                                    <i class="s-icon"></i>我的订单
                                    <a class="i-load-more-item-shadow" href="order.html">全部订单</a>
                                </div>
                                <ul>
                                    <li><a href="order.html"><i><img src="/h/images/pay.png"/></i><span>待付款</span></a></li>
                                    <li><a href="order.html"><i><img src="/h/images/send.png"/></i><span>待发货<em class="m-num">1</em></span></a></li>
                                    <li><a href="order.html"><i><img src="/h/images/receive.png"/></i><span>待收货</span></a></li>
                                    <li><a href="order.html"><i><img src="/h/images/comment.png"/></i><span>待评价<em class="m-num">3</em></span></a></li>
                                    <li><a href="change.html"><i><img src="/h/images/refund.png"/></i><span>退换货</span></a></li>
                                </ul>
                            </div>
                            <!--九宫格-->
                            <div class="user-patternIcon">
                                <div class="s-bar">
                                    <i class="s-icon"></i>我的常用
                                </div>
                                <ul>

                                    <a href="home/shopcart.html"><li class="am-u-sm-4"><i class="am-icon-shopping-basket am-icon-md"></i><img src="/h/images/iconbig.png"/><p>购物车</p></li></a>
                                    <a href="collection.html"><li class="am-u-sm-4"><i class="am-icon-heart am-icon-md"></i><img src="/h/images/iconsmall1.png"/><p>我的收藏</p></li></a>
                                    <a href="home/home.html"><li class="am-u-sm-4"><i class="am-icon-gift am-icon-md"></i><img src="/h/images/iconsmall0.png"/><p>为你推荐</p></li></a>
                                    <a href="comment.html"><li class="am-u-sm-4"><i class="am-icon-pencil am-icon-md"></i><img src="/h/images/iconsmall3.png"/><p>好评宝贝</p></li></a>
                                    <a href="foot.html"><li class="am-u-sm-4"><i class="am-icon-clock-o am-icon-md"></i><img src="/h/images/iconsmall2.png"/><p>我的足迹</p></li></a>
                                </ul>
                            </div>
                            <!--物流 -->
                            <div class="m-logistics">

                                <div class="s-bar">
                                    <i class="s-icon"></i>我的物流
                                </div>
                                <div class="s-content">
                                    <ul class="lg-list">

                                        <li class="lg-item">
                                            <div class="item-info">
                                                <a href="#">
                                                    <img src="/h/images/65.jpg_120x120xz.jpg" alt="抗严寒冬天保暖隔凉羊毛毡底鞋垫超薄0.35厘米厚吸汗排湿气舒适">
                                                </a>

                                            </div>
                                            <div class="lg-info">

                                                <p>快件已从 义乌 发出</p>
                                                <time>2015-12-20 17:58:05</time>

                                                <div class="lg-detail-wrap">
                                                    <a class="lg-detail i-tip-trigger" href="logistics.html">查看物流明细</a>
                                                    <div class="J_TipsCon hide">
                                                        <div class="s-tip-bar">中通快递&nbsp;&nbsp;&nbsp;&nbsp;运单号：373269427686</div>
                                                        <div class="s-tip-content">
                                                            <ul>
                                                                <li>快件已从 义乌 发出2015-12-20 17:58:05</li>
                                                                <li>义乌 的 义乌总部直发车 已揽件2015-12-20 17:54:49</li>
                                                                <li class="s-omit"><a data-spm-anchor-id="a1z02.1.1998049142.3" target="_blank" href="#">··· 查看全部</a></li>
                                                                <li>您的订单开始处理2015-12-20 08:13:48</li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="lg-confirm">
                                                <a class="i-btn-typical" href="#">确认收货</a>
                                            </div>
                                        </li>
                                        <div class="clear"></div>

                                        <li class="lg-item">
                                            <div class="item-info">
                                                <a href="#">
                                                    <img src="/h/images/88.jpg_120x120xz.jpg" alt="礼盒袜子女秋冬 纯棉袜加厚 女式中筒袜子 韩国可爱 女袜 女棉袜">
                                                </a>

                                            </div>
                                            <div class="lg-info">

                                                <p>已签收,签收人是青年城签收</p>
                                                <time>2015-12-19 15:35:42</time>

                                                <div class="lg-detail-wrap">
                                                    <a class="lg-detail i-tip-trigger" href="logistics.html">查看物流明细</a>
                                                    <div class="J_TipsCon hide">
                                                        <div class="s-tip-bar">天天快递&nbsp;&nbsp;&nbsp;&nbsp;运单号：666287461069</div>
                                                        <div class="s-tip-content">
                                                            <ul>

                                                                <li>已签收,签收人是青年城签收2015-12-19 15:35:42</li>
                                                                <li>【光谷关山分部】的派件员【关山代派】正在派件 电话:*2015-12-19 14:27:28</li>
                                                                <li class="s-omit"><a data-spm-anchor-id="a1z02.1.1998049142.7" target="_blank" href="//wuliu.taobao.com/user/order_detail_new.htm?spm=a1z02.1.1998049142.7.8BJBiJ&amp;trade_id=1479374251166800&amp;seller_id=1651462988&amp;tracelog=yimaidaologistics">··· 查看全部</a></li>
                                                                <li>您的订单开始处理2015-12-17 14:27:50</li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="lg-confirm">
                                                <a class="i-btn-typical" href="#">确认收货</a>
                                            </div>
                                        </li>

                                    </ul>

                                </div>

                            </div>

                            <!--收藏夹 -->
                            <div class="you-like">
                                <div class="s-bar">我的收藏
                                    <a class="am-badge am-badge-danger am-round">降价</a>
                                    <a class="am-badge am-badge-danger am-round">下架</a>
                                    <a class="i-load-more-item-shadow" href="#"><i class="am-icon-refresh am-icon-fw"></i>换一组</a>
                                </div>
                                <div class="s-content">
                                @forelse($collect as $k=>$v)
                                    @foreach($good as $kk=>$vv)
                                        @if($v->gid == $vv->gid)
                                        <div class="s-item-wrap">
                                            <div class="s-item">

                                                <div class="s-pic">
                                                    <a href="http://lamp.com/home/personal/introduction?ids={{ $v->gid }}" class="s-pic-link">
                                                        <img height="150px" src="/uploads/{{ $vv->showcase }}" alt="{{ $vv->title }}" title="{{ $vv->title }}" class="s-pic-img s-guess-item-img" >
                                                    </a>
                                                </div>
                                                <div class="s-info">
                                                    <div class="s-title">
                                                        <a href="/home/personal/introduction?id={{ $vv->gid }}&cid={{ $vv->cid }}" title="{{ $vv->title }}">{{ $vv->title }}</a>
                                                        </div>
                                                    <div class="s-price-box">
                                                        <span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">{{ $vv->price }}</em></span>
                                                        <span class="s-history-price"><em class="s-price-sign">¥</em><em class="s-value">68.00</em></span>
                                                    </div>
                                                    <div class="s-extra-box">
                                                        <span class="s-comment">好评: 98.03%</span>
                                                        <span class="s-sales">月销: 219</span>
                                                    </div>
                                                </div>
                                                <div class="s-tp">
                                                    <span class="ui-btn-loading-before">找相似</span>
                                                    <i class="am-icon-shopping-cart"></i>
                                                    <span class="ui-btn-loading-before buy">加入购物车</span>
                                                    <p>
                                                        <a href="javascript:;" class="c-nodo J_delFav_btn">取消收藏</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                            @empty
                            <img src="/h/images/kkry.jpg" width="800px">
                            @endforelse

                                </div>

                                <a href="/center/collection">
                                    <div class="s-more-btn i-load-more-item" data-screen="0">
                                        <i class="am-icon-refresh am-icon-fw"></i>更多
                                    </div>
                                </a>

                            </div>

                        </div>
                    </div>

                    <div class="wrap-right">

                        <!-- 日历-->
                        <div class="day-list">
                            <div class="s-bar">
                                <a class="i-history-trigger s-icon" href="#"></a>我的日历
                                <a class="i-setting-trigger s-icon" href="#"></a>
                            </div>
                            <div class="s-care s-care-noweather">
                                <div class="s-date">
                                    <em>21</em>
                                    <span>星期一</span>
                                    <span>2015.12</span>
                                </div>
                            </div>
                        </div>
                        <!--新品 -->
                        <div class="new-goods">
                            <div class="s-bar">
                                <i class="s-icon"></i>今日新品
                                <a class="i-load-more-item-shadow">15款新品</a>
                            </div>
                            <div class="new-goods-info">
                                <a class="shop-info" href="#" target="_blank">
                                    <div class="face-img-panel">
                                        <img src="/h/images/imgsearch1.jpg" alt="">
                                    </div>
                                    <span class="new-goods-num ">4</span>
                                    <span class="shop-title">剥壳松子</span>
                                </a>
                                <a class="follow " target="_blank">关注</a>
                            </div>
                        </div>

                        <!--热卖推荐 -->
                        <div class="new-goods">
                            <div class="s-bar">
                                <i class="s-icon"></i>热卖推荐
                            </div>
                            <div class="new-goods-info">
                                <a class="shop-info" href="#" target="_blank">
                                    <div >
                                        <img src="/h/images/imgsearch1.jpg" alt="">
                                    </div>
                                    <span class="one-hot-goods">￥9.20</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                <!--底部-->
        @include('home.public.footer')
            </div>

        @include('home.public.list')
        </div>
        <!--引导 -->
        <div class="navCir">
            <li><a href="home/home.html"><i class="am-icon-home "></i>首页</a></li>
            <li><a href="home/sort.html"><i class="am-icon-list"></i>分类</a></li>
            <li><a href="home/shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>
            <li class="active"><a href="index.html"><i class="am-icon-user"></i>我的</a></li>
        </div>
    </body>

</html>