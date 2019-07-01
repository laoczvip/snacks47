<div class=tip>
        <div id="sidebar">
            <div id="wrap">
                <div id="prof" class="item ">
                    @if(!session('home_login'))
                    <a href="# ">
                        <span class="setting "></span>
                    </a>
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
                    <a href="# ">
                        <span class="setting "></span>
                    </a>
                    <div class="ibar_login_box status_login ">
                        <div class="avatar_box ">
                            <p class="avatar_imgbox "><img src="/uploads/{{session('home_user')->userinfo->ufile}}" /></p>
                            <ul class="user_info ">
                                <li>{{ session('home_user')->name }}</li>
                                <li>级&nbsp;别普通会员</li>
                            </ul>
                        </div>
                        <div class="login_btnbox ">
                            <a href="/center/order " class="login_order ">我的订单</a>
                            <a href="/center/collection " class="login_favorite ">我的收藏</a>
                        </div>
                        <i class="icon_arrow_white "></i>
                    </div>
                    @endif
                </div>
                 @if(session('home_login'))
                <a href="/shopcart ">
                    <div id="shopCart " class="item ">
                        <a href="/shopcart ">
                            <span class="message "></span>
                        </a>
                        <p>
                            购物车
                        </p>
                        <p class="cart_num ">{{ $count }}</p>
                    </div>
                </a>

                <div id="brand " class="item ">
                    <a href="/center/collection ">
                        <span class="wdsc "><img src="/h/images/wdsc.png " /></span>
                    </a>
                    <div class="mp_tooltip ">
                        我的收藏
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
        @endif
