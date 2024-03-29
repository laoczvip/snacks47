<div class="hmtop">
        <!--顶部导航条 -->
        <div class="am-container header">
        @if(!session('home_login'))
            <ul class="message-l">
                <div class="topMessage">
                    <div class="menu-hd">
                        <a href="/login" target="_top" class="h">亲,请登录</a>
                        <a href="/register" target="_top">免费注册</a>
                    </div>
                </div>
            </ul>
        @else
        <ul class="message-l">
            <div class="topMessage">
                <div class="menu-hd">
                    <a href="/center/index" target="_top" class="h">您好!&nbsp;&nbsp;{{session('home_user')->name }}</a>
                    <a href="/out" target="_top" class="h">退出</a>
                </div>
            </div>
        </ul>
        @endif
            <ul class="message-r">
                <div class="topMessage home">
                    <div class="menu-hd"><a href="/index.php" target="_top" class="h">商城首页</a></div>
                </div>
                <div class="topMessage my-shangcheng">
                    <div class="menu-hd MyShangcheng"><a href="/center/index" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
                </div>
                <div class="topMessage mini-cart">
                    <div class="menu-hd">
                        <a id="mc-menu-hd" href="/shopcart" target="_top">
                                <i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span>
                                    <strong id="J_MiniCartNum" class="h">{{ $count }}</strong>
                        </a>
                    </div>
                </div>
                <div class="topMessage favorite">
                    <div class="menu-hd"><a href="/center/collection" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
                    </div>
            </ul>
            </div>

            <!--悬浮搜索框-->

            <div class="nav white">
                <!-- <div class="logo"><img src="/uploads/{{$weds->logo}}"></div> -->
                <div class="logoBig" style="margin-left: -131px;">
                    <li><a href="/index.php"><img src="/uploads/{{$weds->logo}}" style="width: 180%;"/></a></li>
                </div>

                <div class="search-bar pr">
                    <a name="index_none_header_sysc" href="#"></a>
                    <form action="/home/personal/search" method="get">
                        <input id="searchInput" name="title" type="text" placeholder="搜索" autocomplete="off">
                        <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
                    </form>
                </div>
            </div>
        </div>
