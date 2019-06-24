<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
        <title>评价管理</title>
        <link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
        <link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
        <link href="/h/css/personal.css" rel="stylesheet" type="text/css">
        <link href="/h/css/cmstyle.css" rel="stylesheet" type="text/css">
        <script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
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

                <div class="user-comment">
                    <!--标题 -->
                    <div class="am-cf am-padding">
                        <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">评价管理</strong> / <small>Manage&nbsp;Comment</small></div>
                    </div>
                    <hr/>

                    <div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

                        <ul class="am-avg-sm-2 am-tabs-nav am-nav am-nav-tabs">
                            <li class="am-active"><a href="#tab1">所有评价</a></li>
                            <li><a href="#tab2">有图评价</a></li>

                        </ul>

                        <div class="am-tabs-bd">
                            <div class="am-tab-panel am-fade am-in am-active" id="tab1">

                                <div class="comment-main">
                                    <div class="comment-list">
                                        <ul class="item-list">


                                            <div class="comment-top">
                                                <div class="th th-price">
                                                    <td class="td-inner">评价</td>
                                                </div>
                                                <div class="th th-item">
                                                    <td class="td-inner">商品</td>
                                                </div>
                                            </div>
                                            <li class="td td-item">
                                                <div class="item-pic">
                                                    <a href="#" class="J_MakePoint">
                                                        <img src="/h/images/kouhong.jpg_80x80.jpg" class="itempic">
                                                    </a>
                                                </div>
                                            </li>

                                            <li class="td td-comment">
                                                <div class="item-title">
                                                    <div class="item-opinion">好评</div>
                                                    <div class="item-name">
                                                        <a href="#">
                                                            <p class="item-basic-info">美康粉黛醉美唇膏 持久保湿滋润防水不掉色</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="item-comment">
                                                    宝贝非常漂亮，超级喜欢！！！ 口红颜色很正呐，还有第两支半价，买三支免单一支的活动，下次还要来买。就是物流太慢了，还要我自己去取快递，店家不考虑换个物流么？
                                                </div>

                                                <div class="item-info">
                                                    <div>
                                                        <p class="info-little"><span>颜色：12#玛瑙</span> <span>包装：裸装</span> </p>
                                                        <p class="info-time">2015-12-24</p>

                                                    </div>
                                                </div>
                                            </li>

                                        </ul>

                                    </div>
                                </div>

                            </div>
                            <div class="am-tab-panel am-fade" id="tab2">

                                <div class="comment-main">
                                    <div class="comment-list">
                                        <ul class="item-list">


                                            <div class="comment-top">
                                                <div class="th th-price">
                                                    <td class="td-inner">评价</td>
                                                </div>
                                                <div class="th th-item">
                                                    <td class="td-inner">商品</td>
                                                </div>
                                            </div>
                                            <li class="td td-item">
                                                <div class="item-pic">
                                                    <a href="#" class="J_MakePoint">
                                                        <img src="/h/images/kouhong.jpg_80x80.jpg" class="itempic">
                                                    </a>
                                                </div>
                                            </li>

                                            <li class="td td-comment">
                                                <div class="item-title">
                                                    <div class="item-opinion">好评</div>
                                                    <div class="item-name">
                                                        <a href="#">
                                                            <p class="item-basic-info">美康粉黛醉美唇膏 持久保湿滋润防水不掉色</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="item-comment">
                                                    宝贝非常漂亮，超级喜欢！！！ 口红颜色很正呐，还有第两支半价，买三支免单一支的活动，下次还要来买。就是物流太慢了，还要我自己去取快递，店家不考虑换个物流么？
                                                <div class="filePic"><img src="/h/images/image.jpg" alt=""></div>
                                                </div>

                                                <div class="item-info">
                                                    <div>
                                                        <p class="info-little"><span>颜色：12#玛瑙</span> <span>包装：裸装</span> </p>
                                                        <p class="info-time">2015-12-24</p>

                                                    </div>
                                                </div>
                                            </li>

                                        </ul>

                                    </div>
                                </div>

                            </div>
                        </div>
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