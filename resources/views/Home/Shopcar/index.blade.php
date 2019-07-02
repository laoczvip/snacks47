
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>购物车页面</title>
        <link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
        <link href="/h/basic/css/demo.css" rel="stylesheet" type="text/css" />
        <link href="/h/css/cartstyle.css" rel="stylesheet" type="text/css" />
        <link href="/h/css/optstyle.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/h/js/jquery.js"></script>
    </head>

    <body>


        @include('home.public.hmtop')
            <div class="clear"></div>

            <!--购物车 -->
            <div class="concent">
                <div id="cartTable">
                    <div class="cart-table-th">
                        <div class="wp">
                            <div class="th th-chk">
                                <div id="J_SelectAll1" class="select-all J_SelectAll">

                                </div>
                            </div>
                            <div class="th th-item">
                                <div class="td-inner">商品信息</div>
                            </div>
                            <div class="th th-price">
                                <div class="td-inner">单价</div>
                            </div>
                            <div class="th th-amount">
                                <div class="td-inner">数量</div>
                            </div>
                            <div class="th th-sum">
                                <div class="td-inner">金额</div>
                            </div>
                            <div class="th th-op">
                                <div class="td-inner">操作</div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    @forelse ($data as $k=>$v)
                    <tr class="item-list">
                        <div class="bundle  bundle-last ">
                            <div class="bundle-main">
                                <ul class="item-content clearfix">
                                    <li class="td td-chk">
                                    </li>
                                    <li class="td td-item">
                                        <div class="item-pic">
                                            <a href="#" target="_blank" data-title="美康粉黛醉美东方唇膏口红正品 持久保湿滋润防水不掉色护唇彩妆" class="J_MakePoint" data-point="tbcart.8.12">
                                                <img src="/uploads/{{ $v->showcase }}" width="100px" class="itempic J_ItemImg"></a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-basic-info">
                                                <a href="#" target="_blank" title= "{{$v->title }}" class="item-title J_MakePoint" data-point="tbcart.8.11">{{ $v->title }}</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="td td-info">
                                        <div class="item-props ">
                                            <span class="sku-line">颜色：{{$v->flavor}}</span>
                                            <span class="sku-line">包装：裸装</span>
                                            <i class="theme-login am-icon-sort-desc"></i>
                                        </div>
                                    </li>
                                    <li class="td td-price">
                                        <div class="item-price price-promo-promo">
                                            <div class="price-content">
                                                <div class="price-line">
                                                    <em class="price-original">78.00</em>
                                                </div>
                                                <div class="price-line">
                                                    <em class="J_Price price-now" tabindex="0">{{$v->price}}</em>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="td td-amount">
                                        <div class="amount-wrapper ">
                                            <div class="item-amount ">
                                                <div class="sl">
                                                    <a href="/descnum?id={{ $v->id }}"><button  style="width:23px;">-</button></a>
                                                    <input class="text_box" name="" type="text" value="{{ $v->num }}" style="width:30px;" />
                                                    <a href="/addnum?id={{ $v->id }}"><button style="width:23px;">+</button></a>

                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="td td-sum">
                                        <div class="td-inner">
                                            <em tabindex="0" class="J_ItemSum number">{{ $v->xiaoji }}</em>
                                        </div>
                                    </li>
                                    <li class="td td-op">
                                        <div class="td-inner">
                                            <a title="移入收藏夹" class="btn-fav" href="#">移入收藏夹</a>
                                            <a href="/delete?id={{ $v->id }}" data-point-url="#" class="delete">删除</a>

                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </tr>
                    @empty
                    <img src="http://img02.hua.com/pc/images/gwc_k2.jpg">
                    @endforelse
                <div class="float-bar-wrapper">

                    <div class="float-bar-right">

                        <div class="price-sum">
                            <span class="txt">合计:</span>
                            <strong class="price">¥<em id="J_Total">{{$pricecount}}</em></strong>
                        </div>
                        <div class="btn-area">
                            <a href="/payment" id="J_Go" class="submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
                                <span>结&nbsp;算</span></a>
                        </div>
                    </div>

                </div>

        @include('home.public.footer')


            </div>

            <!--操作页面-->

            <div class="theme-popover-mask"></div>

            <div class="theme-popover">
                <div class="theme-span"></div>
                <div class="theme-poptit h-title">
                    <a href="javascript:;" title="关闭" class="close">×</a>
                </div>
                <div class="theme-popbod dform">
                    <form class="theme-signin" name="loginform" action="" method="post">

                        <div class="theme-signin-left">

                            <li class="theme-options">
                                <div class="cart-title">口味：</div>
                                <ul>
                                    <li class="sku-line selected">12#川南玛瑙<i></i></li>
                                    <li class="sku-line">10#蜜橘色+17#樱花粉<i></i></li>
                                </ul>
                            </li>
                            <li class="theme-options">
                                <div class="cart-title">包装：</div>
                                <ul>
                                    <li class="sku-line selected">包装：裸装<i></i></li>
                                    <li class="sku-line">两支手袋装（送彩带）<i></i></li>
                                </ul>
                            </li>
                            <div class="theme-options">
                                <div class="cart-title number">数量</div>
                                <dd>
                                    <input class="min am-btn am-btn-default" name="" type="button" value="-" />
                                    <input class="text_box" name="" type="text" value="1" style="width:30px;" />
                                    <input class="add am-btn am-btn-default" name="" type="button" value="+" />
                                    <span  class="tb-hidden">库存<span class="stock">1000</span>件</span>
                                </dd>

                            </div>
                            <div class="clear"></div>
                            <div class="btn-op">
                                <div class="btn am-btn am-btn-warning">确认</div>
                                <div class="btn close am-btn am-btn-warning">取消</div>
                            </div>

                        </div>
                        <div class="theme-signin-right">
                            <div class="img-info">
                                <img src="/h/images/kouhong.jpg_80x80.jpg" />
                            </div>
                            <div class="text-info">
                                <span class="J_Price price-now">¥39.00</span>
                                <span id="Stock" class="tb-hidden">库存<span class="stock">1000</span>件</span>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        <!--引导 -->
        <div class="navCir">
            <li><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
            <li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
            <li class="active"><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>
            <li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li>
        </div>
    </body>

</html>