<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
        <title>我的收藏</title>
        <link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
        <link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
        <link href="/h/css/personal.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="/uploads/{{ $weds->icon }}"/>
        <link href="/h/css/colstyle.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <!--头 -->
        @include('home.public.hmtop')

            <div class="nav-table">
                <div class="long-title"><span class="all-goods">全部分类</span></div>
                 <div class="nav-cont">
                      <ul>
                            <li class="index"><a href="/index.php">首页</a></li>
                      </ul>
                </div>
            </div>
            <b class="line"></b>
        <div class="center">
            <div class="col-main">
                <div class="main-wrap">

                    <div class="user-collection">
                        <!--标题 -->
                        <div class="am-cf am-padding">
                            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的收藏</strong> / <small>My&nbsp;Collection</small></div>
                        </div>
                        <hr/>

                        <div class="you-like">
                            <div class="s-bar">
                                我的收藏
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
                                        </div>
                                        <div class="s-tp">
                                            <p>
                                                <a href="javascript:;" class="c-nodo J_delFav_btn">取消收藏</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            @empty
                                              <img src="/h/images/kkry.jpg" width="500px">
                            @endforelse
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