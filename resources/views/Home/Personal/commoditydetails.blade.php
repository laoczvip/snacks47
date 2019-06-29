<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
        <title>订单详情</title>
        <link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
        <link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
        <link href="/h/css/personal.css" rel="stylesheet" type="text/css">
        <link href="/h/css/orstyle.css" rel="stylesheet" type="text/css">
        <script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
        <script src="/h/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
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

                    <div class="user-orderinfo">

                        <!--标题 -->
                        <div class="am-cf am-padding">
                            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单详情</strong> / <small>Order&nbsp;details</small></div>
                        </div>
                        <hr/>
                        <!--进度条-->
                        @if($dtype == 0)
                        <div class="m-progress">
                            <div class="m-progress-list">
                                <span class="step-1 step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                   <p class="stage-name">拍下商品</p>
                                </span>
                                <span class=" step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                   <p class="stage-name">卖家发货</p>
                                </span>

                                <span class="step-3 step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">3<em class="bg"></em></i>
                                   <p class="stage-name">确认收货</p>
                                </span>
                                <span class="step-4 step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">4<em class="bg"></em></i>
                                   <p class="stage-name">交易完成</p>
                                </span>
                                <span class="u-progress-placeholder"></span>
                            </div>
                            <div class="u-progress-bar total-steps-2">
                                <div class="u-progress-bar-inner"></div>
                            </div>
                        </div>
                        @elseif($dtype == 1)
                        <div class="m-progress">
                            <div class="m-progress-list">
                                <span class="step-1 step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                   <p class="stage-name">拍下商品</p>
                                </span>
                                <span class="step-2 step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                   <p class="stage-name">卖家发货</p>
                                </span>

                                <span id="step-3" class=" step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">3<em class="bg"></em></i>
                                   <p class="stage-name">确认收货</p>
                                </span>
                                <span id="step-4" class=" step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">4<em class="bg"></em></i>
                                   <p class="stage-name">交易完成</p>
                                </span>
                                <span class="u-progress-placeholder"></span>
                            </div>
                            <div class="u-progress-bar total-steps-2">
                                <div class="u-progress-bar-inner"></div>
                            </div>
                        </div>
                        @else
                        <div class="m-progress">
                            <div class="m-progress-list">
                                <span class="step-1 step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                   <p class="stage-name">拍下商品</p>
                                </span>
                                <span class="step-2 step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                   <p class="stage-name">卖家发货</p>
                                </span>

                                <span  class="step-2 step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">3<em class="bg"></em></i>
                                   <p class="stage-name">确认收货</p>
                                </span>
                                <span  class="step-2 step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">4<em class="bg"></em></i>
                                   <p class="stage-name">交易完成</p>
                                </span>
                                <span class="u-progress-placeholder"></span>
                            </div>
                            <div class="u-progress-bar total-steps-2">
                                <div class="u-progress-bar-inner"></div>
                            </div>
                        </div>
                        @endif
                        <div class="order-infoaside">
                            <div class="order-logistics">

                                    <div class="icon-log">
                                        <i><img src="/h/images/receive.png"></i>
                                    </div>
                                    <div class="latest-logistics">
                                        <p class="text">
                                            @if($dtype == 0)
                                                商家正在努力备货中...
                                            @elseif($dtype == 1)
                                                商家已发货,宝贝已经在路上了
                                            @elseif($dtype == 3)
                                                已签收,签收人是青年城签收，感谢使用天天快递，期待再次为您服务
                                            @endif
                                        </p>
                                        <div class="time-list">
                                            <span class="date">{{$updated_at}}</span>
                                        </div>
                                        <div class="inquire">
                                            <span class="package-detail">物流：天天快递</span>
                                            <span class="package-detail">快递单号: </span>
                                            <span class="package-number">{{$onum}}</span>
                                            查看
                                        </div>
                                    </div>
                                    <span class="am-icon-angle-right icon"></span>
                                <div class="clear"></div>
                            </div>
                        <div class="order-addresslist">
                                <div class="order-address">
                                    <div class="icon-add">
                                    </div>
                                    <p class="new-tit new-p-re">
                                        <span class="new-txt">{{ $address->consignee }}</span>
                                        <span class="new-txt-rd2">{{ $address->atel }}</span>
                                    </p>
                                    <div class="new-mu_l2a new-p-re">
                                        <p class="new-mu_l2cw">
                                            <span class="title">收货地址：</span>
                                            <span class="province">{{ $address->address }}{{ $address->detailed }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="order-infomain">

                            <div class="order-top">
                                <div class="th th-item">
                                    <td class="td-inner">商品</td>
                                </div>
                                <div class="th th-price">
                                    <td class="td-inner">单价</td>
                                </div>
                                <div class="th th-number">
                                    <td class="td-inner">数量</td>
                                </div>
                                <div class="th th-operation">
                                    <td class="td-inner">商品操作</td>
                                </div>
                                <div class="th th-amount">
                                    <td class="td-inner">合计</td>
                                </div>
                                <div class="th th-status">
                                    <td class="td-inner">交易状态</td>
                                </div>
                                <div class="th th-change">
                                    <td class="td-inner">交易操作</td>
                                </div>
                            </div>

                            <div class="order-main">

                                <div class="order-status3">
                                    <div class="order-title">
                                        <div class="dd-num">订单编号：<a href="javascript:;">{{$onum}}</a></div>
                                        <span>成交时间</span>
                                        <!--    <em>店铺：小桔灯</em>-->
                                    </div>
                                    <div class="order-content">
                                        <div class="order-left">
                                        @foreach($order as $k=>$v)
                                            @foreach($v->usergood as $kk=>$goods)
                                            <ul class="item-list">
                                                <li class="td td-item">
                                                    <div class="item-pic">
                                                        <a href="#" class="J_MakePoint">
                                                            <img src="/uploads/{{ $goods->showcase}}" width="100px" class="itempic J_ItemImg">
                                                        </a>
                                                    </div>
                                                    <div class="item-info">
                                                        <div class="item-basic-info">
                                                            <a href="#">
                                                                <p>{{$goods->title}}</p>
                                                                <p class="info-little">口味：{{ $v->flavor }}
                                                                    <br/>包装：袋装 </p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="td td-price">
                                                    <div class="item-price">
                                                        {{$goods->price}}
                                                    </div>
                                                </li>
                                                <li class="td td-number">
                                                    <div class="item-number">
                                                        <span>×</span>{{$v->number}}
                                                    </div>
                                                </li>
                                                <li class="td td-operation">
                                                    <div class="item-operation">
                                                        退款/退货
                                                    </div>
                                                </li>
                                            </ul>
                                            @endforeach
                                        @endforeach

                                        </div>
                                        <div class="order-right">
                                            <li class="td td-amount">
                                                <div class="item-amount">
                                                    合计：676.00
                                                    <p>含运费：<span>10.00</span></p>
                                                </div>
                                            </li>
                                            <div class="move-right">
                                                <li class="td td-status">
                                                    <div class="item-status">
                                                        <p class="Mystatus">卖家已发货</p>
                                                        <p class="order-info"><a href="logistics.html">查看物流</a></p>
                                                        <p class="order-info"><a href="#">延长收货</a></p>
                                                    </div>
                                                </li>
                                                <li class="td td-change">
                                                    @if($dtype != 3)
                                                    <div id="qdsh" class="am-btn am-btn-danger anniu" onclick="qdingshouhuo({{$id}})">确认收货</div>
                                                @else
                                                    <div id="qdsh" class="am-btn am-btn-danger anniu" disabled>确认收货</div>
                                                @endif
                                                </li>
                                            </div>
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
    <script>
        function qdingshouhuo(id){
            layer.msg('确保自己已经收到货了', {
              time: 0 //不自动关闭
              ,btn: ['好的', '取消']
              ,yes: function(index){
                $("#step-3").addClass("step-2");
                $("#step-4").addClass("step-2");
                let url = '/confirmreceipt/'+id;
                $.get(url,function(res){
                    if (res == 1) {
                        layer.close(index);
                        $('#qdsh').attr('disabled','disabled');

                        layer.alert('感谢你本次的购物', {icon: 6});
                    };
                })
              }
            });


        }
    </script>
</html>