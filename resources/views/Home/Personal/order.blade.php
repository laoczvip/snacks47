<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
        <title>订单管理</title>
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

                    <div class="user-order">

                        <!--标题 -->
                        <div class="am-cf am-padding">
                            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单管理</strong> / <small>Order</small></div>
                        </div>
                        <hr/>

                        <div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

                            <ul class="am-avg-sm-5 am-tabs-nav am-nav am-nav-tabs">
                                <li class="am-active"><a href="#tab1">所有订单</a></li>
                                <li><a href="#tab3">待发货</a></li>
                                <li><a href="#tab4">待收货</a></li>
                                <li><a href="#tab5">待评价</a></li>
                            </ul>

                            <div class="am-tabs-bd">
                                <div class="am-tab-panel am-fade am-in am-active" id="tab1">
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
                                        <div class="order-list">
                                            @forelse($order as $k => $v)
                                            <!--交易成功-->
                                            <div class="order-status5">
                                                <div class="order-title">
                                                    <div class="dd-num">订单编号：<a href="javascript:;">{{$v->onum}}</a></div>
                                                    <span>成交时间：{{$v->created_at}}</span>
                                                    <!--    <em>店铺：小桔灯</em>-->
                                                </div>
                                                <div class="order-content">
                                                    <div class="order-left">
                                                    @foreach($v->orderdetails as $key => $value)

                                                        @foreach ($value->usergood as $key => $good)
                                                        <ul class="item-list">
                                                            <li class="td td-item">
                                                                <div class="item-pic">
                                                                    <a href="#" class="J_MakePoint">
                                                                        <img src="/uploads/{{ $good->showcase }}" class="itempic J_ItemImg">
                                                                    </a>
                                                                </div>
                                                                <div class="item-info">
                                                                    <div class="item-basic-info">
                                                                        <a href="#">
                                                                            <p>{{ $good->title }}</p>
                                                                            <p class="info-little">口味：{{$value->flavor}}
                                                                                <br/>包装：裸装 </p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="td td-price">
                                                                <div class="item-price">
                                                                    {{$good->price}}
                                                                </div>
                                                            </li>
                                                            <li class="td td-number">
                                                                <div class="item-number">
                                                                    <span>×</span>{{$value->number}}
                                                                </div>
                                                            </li>
                                                              <li class="td td-operation">
                                                                    <div class="item-operation">
                                                                        <a href="/commoditydetails/{{ $v->id }}/{{ $v->aid }}">查看详情</a>
                                                                    </div>
                                                                </li>
                                                        </ul>
                                                        @endforeach
                                                    @endforeach
                                                    </div>
                                                    <div class="order-right">
                                                        <li class="td td-amount">
                                                            <div class="item-amount">
                                                                合计：{{$v->money}}
                                                                <p>含运费：<span>10.00</span></p>
                                                            </div>
                                                        </li>
                                                       @if($v->otype == 3)
                                                        <div class="move-right">
                                                            <li class="td td-status">
                                                                <div class="item-status">
                                                                    <p class="Mystatus">交易成功</p>
                                                                    <p class="order-info"><a href="/commoditydetails/{{ $v->id }}">订单详情</a></p>
                                                                    <p class="order-info"><a href="logistics.html">查看物流</a></p>
                                                                </div>
                                                            </li>
                                                            <li class="td td-change">
                                                                <div class="am-btn am-btn-danger anniu" onclick="del({{$v->id}},this)">删除订单</div>
                                                            </li>
                                                        </div>
                                                        @elseif($v->otype == 0)
                                                        <div class="move-right">
                                                            <li class="td td-status">
                                                                <div class="item-status">
                                                                    <p class="Mystatus">买家已付款</p>
                                                                    <p class="order-info"><a href="/commoditydetails/{{ $v->id }}">订单详情</a></p>
                                                                </div>
                                                            </li>
                                                            <li class="td td-change">
                                                                <div class="am-btn am-btn-danger anniu" onclick="remind()">提醒发货</div>
                                                            </li>
                                                        </div>
                                                        @elseif($v->otype == 3)
                                                          <div class="move-right">
                                                            <li class="td td-status">
                                                                <div class="item-status">
                                                                    <p class="Mystatus">卖家已发货</p>
                                                                    <p class="order-info"><a href="/commoditydetails/{{ $v->id }}">订单详情</a></p>
                                                                    <p class="order-info"><a href="logistics.html">查看物流</a></p>
                                                                    <p class="order-info"><a href="#">延长收货</a></p>
                                                                </div>
                                                            </li>
                                                            <li class="td td-change">
                                                                <div class="am-btn am-btn-danger anniu" disabled>已完成交易</div>
                                                            </li>
                                                        </div>
                                                        @elseif($v->otype == 1)
                                                        <div class="move-right">
                                                            <li class="td td-status">
                                                                <div class="item-status">
                                                                    <p class="Mystatus">卖家已发货</p>
                                                                    <p class="order-info"><a href="/commoditydetails/{{ $v->id }}">订单详情</a></p>
                                                                    <p class="order-info"><a href="logistics.html">查看物流</a></p>
                                                                    <p class="order-info"><a href="#">延长收货</a></p>
                                                                </div>
                                                            </li>
                                                            <li class="td td-change">
                                                                <div class="am-btn am-btn-danger anniu" onclick="qdingshouhuo({{$v->id}})" id="qdsh">确认收货</div>
                                                            </li>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @empty
                                            <img src="/h/images/kkry.jpg">
                                        @endforelse





                                        </div>

                                    </div>

                                </div>
                                <div class="am-tab-panel am-fade" id="tab2">

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


                                </div>
                                <div class="am-tab-panel am-fade" id="tab3">
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
                                        <div class="order-list">
                                        @forelse($order as $k=>$v)
                                            @if($v->otype == 0)
                                            <div class="order-status2">
                                                <div class="order-title">
                                                    <div class="dd-num">订单编号：<a href="javascript:;">{{$v->onum}}</a></div>
                                                    <span>成交时间：{{$v->created_at}}</span>
                                                    <!--    <em>店铺：小桔灯</em>-->
                                                </div>
                                                <div class="order-content">
                                                    <div class="order-left">
                                                    @foreach($v->orderdetails as $key => $value)
                                                         @foreach ($value->usergood as $key => $good)
                                                        <ul class="item-list">
                                                            <li class="td td-item">
                                                                <div class="item-pic">
                                                                    <a href="#" class="J_MakePoint">
                                                                        <img src="/uploads/{{ $good->showcase }}" class="itempic J_ItemImg">
                                                                    </a>
                                                                </div>
                                                                <div class="item-info">
                                                                    <div class="item-basic-info">
                                                                        <a href="#">
                                                                            <p>{{$good->title}}</p>
                                                                            <p class="info-little">口味：{{$value->flavor}}
                                                                                <br/>包装：裸装 </p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="td td-price">
                                                                <div class="item-price">
                                                                    {{$good->price}}
                                                                </div>
                                                            </li>
                                                            <li class="td td-number">
                                                                <div class="item-number">
                                                                    <span>×</span>{{$value->number}}
                                                                </div>
                                                            </li>
                                                              <li class="td td-operation">
                                                                    <div class="item-operation">
                                                                        <a href="/commoditydetails/{{ $v->id }}/{{ $v->aid }}">查看详情</a>
                                                                    </div>
                                                                </li>
                                                        </ul>
                                                            @endforeach
                                                        @endforeach

                                                    </div>
                                                    <div class="order-right">
                                                        <li class="td td-amount">
                                                            <div class="item-amount">
                                                                合计：{{$v->money}}
                                                                <p>含运费：<span>10.00</span></p>
                                                            </div>
                                                        </li>
                                                        <div class="move-right">
                                                            <li class="td td-status">
                                                                <div class="item-status">
                                                                    <p class="Mystatus">买家已付款</p>
                                                                    <p class="order-info"><a href="/commoditydetails/{{ $v->id }}">订单详情</a></p>
                                                                </div>
                                                            </li>
                                                            <li class="td td-change">
                                                                <div class="am-btn am-btn-danger anniu" onclick="remind()">提醒发货</div>
                                                            </li>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @empty
                                            <img src="/h/images/kkry.jpg">
                                        @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="am-tab-panel am-fade" id="tab4">
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
                                        <div class="order-list">
                                           @forelse($order as $k=>$v)
                                            @if($v->otype == 1)
                                            <div class="order-status2">
                                                <div class="order-title">
                                                    <div class="dd-num">订单编号：<a href="javascript:;">{{$v->onum}}</a></div>
                                                    <span>成交时间：{{$v->created_at}}</span>
                                                    <!--    <em>店铺：小桔灯</em>-->
                                                </div>
                                                <div class="order-content">
                                                    <div class="order-left">
                                                    @foreach($v->orderdetails as $key => $value)
                                                         @foreach ($value->usergood as $key => $good)
                                                        <ul class="item-list">
                                                            <li class="td td-item">
                                                                <div class="item-pic">
                                                                    <a href="#" class="J_MakePoint">
                                                                        <img src="/uploads/{{ $good->showcase }}" class="itempic J_ItemImg">
                                                                    </a>
                                                                </div>
                                                                <div class="item-info">
                                                                    <div class="item-basic-info">
                                                                        <a href="#">
                                                                            <p>{{$good->title}}</p>
                                                                            <p class="info-little">口味：{{$value->flavor}}
                                                                                <br/>包装：裸装 </p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="td td-price">
                                                                <div class="item-price">
                                                                    {{$good->price}}
                                                                </div>
                                                            </li>
                                                            <li class="td td-number">
                                                                <div class="item-number">
                                                                    <span>×</span>{{$value->number}}
                                                                </div>
                                                            </li>
                                                              <li class="td td-operation">
                                                                    <div class="item-operation">
                                                                        <a href="/commoditydetails/{{ $v->id }}/{{ $v->aid }}">查看详情</a>
                                                                    </div>
                                                                </li>
                                                        </ul>
                                                            @endforeach
                                                        @endforeach

                                                    </div>
                                                    <div class="order-right">
                                                        <li class="td td-amount">
                                                            <div class="item-amount">
                                                                合计：{{$v->money}}
                                                                <p>含运费：<span>10.00</span></p>
                                                            </div>
                                                        </li>
                                                       <div class="move-right">
                                                            <li class="td td-status">
                                                                <div class="item-status">
                                                                    <p class="Mystatus">卖家已发货</p>
                                                                    <p class="order-info"><a href="/commoditydetails/{{ $v->id }}">订单详情</a></p>
                                                                    <p class="order-info"><a href="logistics.html">查看物流</a></p>
                                                                    <p class="order-info"><a href="#">延长收货</a></p>
                                                                </div>
                                                            </li>
                                                            <li class="td td-change">
                                                                <div class="am-btn am-btn-danger anniu" id="qdsh" onclick="qdingshouhuo({{ $v->id }})" >确认收货</div>
                                                            </li>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                             @empty
                                            <img src="/h/images/kkry.jpg">
                                        @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="am-tab-panel am-fade" id="tab5">
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
                                        <div class="order-list">
                                            <!--不同状态的订单 -->
                                         @forelse($order as $k=>$v)
                                            @if($v->otype == 3)
                                            <div class="order-status2">
                                                <div class="order-title">
                                                    <div class="dd-num">订单编号：<a href="javascript:;">{{$v->onum}}</a></div>
                                                    <span>成交时间：{{$v->created_at}}</span>
                                                    <!--    <em>店铺：小桔灯</em>-->
                                                </div>
                                                <div class="order-content">
                                                    <div class="order-left">
                                                    @foreach($v->orderdetails as $key => $value)
                                                         @foreach ($value->usergood as $key => $good)
                                                        <ul class="item-list">
                                                            <li class="td td-item">
                                                                <div class="item-pic">
                                                                    <a href="#" class="J_MakePoint">
                                                                        <img src="/uploads/{{ $good->showcase }}" class="itempic J_ItemImg">
                                                                    </a>
                                                                </div>
                                                                <div class="item-info">
                                                                    <div class="item-basic-info">
                                                                        <a href="#">
                                                                            <p>{{$good->title}}</p>
                                                                            <p class="info-little">口味：{{$value->flavor}}
                                                                                <br/>包装：裸装 </p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="td td-price">
                                                                <div class="item-price">
                                                                    {{$good->price}}
                                                                </div>
                                                            </li>
                                                            <li class="td td-number">
                                                                <div class="item-number">
                                                                    <span>×</span>{{$value->number}}
                                                                </div>
                                                            </li>
                                                              <li class="td td-operation">
                                                                    <div class="item-operation">
                                                                        <a href="/commoditydetails/{{ $v->id }}/{{ $v->aid }}">查看详情</a>
                                                                    </div>
                                                                </li>
                                                        </ul>
                                                            @endforeach
                                                        @endforeach

                                                    </div>
                                                    @forelse($orders as $val)
                                                    <div class="order-right">
                                                        <li class="td td-amount">
                                                            <div class="item-amount">
                                                                合计：{{$v->money}}
                                                                <p>含运费：<span>10.00</span></p>
                                                            </div>
                                                        </li>
                                                      <div class="move-right">
                                                            <li class="td td-status">
                                                                <div class="item-status">
                                                                    <p class="Mystatus">交易成功</p>
                                                                    <p class="order-info"><a href="logistics.html">查看物流</a></p>
                                                                </div>
                                                            </li>


                                                            <li class="td td-change">
                                                             @if(!isset($list[$v->onum]))
                                                                <div class="am-btn am-btn-danger anniu" onclick="del({{$v->id}},this)">删除订单</div>
                                                                <a href="/home/comment/create?oid={{$v->id}}"><div class="am-btn am-btn-danger anniu" >评价商品</div></a>
                                                                @else
                                                                <a href="javascript:;"><div class="am-btn am-btn-success " >已评论</div></a>
                                                            @endif
                                                            </li>

                                                        </div>
                                                    </div>
                                                     @empty
                                                    @endforelse
                                                </div>
                                            </div>

                                            @endif
                                            @empty
                                              <img src="/h/images/kkry.jpg">
                                        @endforelse
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
        <script>
             function qdingshouhuo(id){
            layer.msg('确保自己已经收到货了', {
              time: 0 //不自动关闭
              ,btn: ['好的', '取消']
              ,yes: function(index){
                        layer.close(index);
                let url = '/confirmreceipt/'+id;
                $.get(url,function(res){
                    if (res == 1) {
                        $('#qdsh').attr('disabled','disabled');
                        layer.alert('感谢你本次的购物', {icon: 6});
                    }else{
                        layer.alert('操作失败,请稍后重试!!', {icon: 5});
                    }
                },'html')
              }
            });
        }

        function del(id,obj){
            layer.msg('确保自己已经收到货了', {
              time: 0 //不自动关闭
              ,btn: ['好的', '取消']
              ,yes: function(index){
                    layer.close(index);
                    let url = '/del/'+id
                    $.get(url,function(res){
                        if (res == 1) {
                            $(obj).parent().parent().parent().parent().parent().remove();
                            layer.msg('删除成功', {icon: 1});
                        };
                    })
              }
            });
        }

        function remind(){
            layer.msg('我们会尽快发货的', {icon: 6});
        }
        </script>

    </body>

</html>