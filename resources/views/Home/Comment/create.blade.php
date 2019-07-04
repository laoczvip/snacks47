
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

        <title>发表评论</title>

        <link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
        <link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

        <link href="/h/css/personal.css" rel="stylesheet" type="text/css">
        <link href="/h/css/appstyle.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="/h/js/jquery-1.7.2.min.js"></script>
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

                    <div class="user-comment">
                        <!--标题 -->
                        <div class="am-cf am-padding">
                            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">发表评论</strong> / <small>Make&nbsp;Comments</small></div>
                        </div>
                        <hr/>
                         <form action="/home/comment" method="post" enctype="multipart/form-data">
                         {{ csrf_field() }}
                        <div class="comment-main">
                        <span hidden>{{$a=0}}{{$b=0}}{{$c=0}}{{$d=0}}{{$e=0}}{{$f=0}}
                        {{$g=0}}{{$h=0}}{{$i=0}}{{$j=0}}{{$k=0}}{{$l=0}}</span>
                        <div id="count" hidden>{{count($comment)}}</div>
                        @forelse($comment as $v)

                            <div class="comment-list">
                                <div class="item-pic">
                                    <a href="" class="J_MakePoint">
                                        <img src="/uploads/{{$Goods_Profile[$v->gid]}}" class="itempic" style="height:100px">
                                    </a>
                                </div>

                                <div class="item-title">

                                    <div class="item-name">
                                        <a href="#">
                                            <p class="item-basic-info">{{$Goods_Name[$v->gid]}}</p>
                                        </a>
                                    </div>
                                    <div class="item-info">
                                        <div class="info-little">
                                            <span>口味：
                                            @forelse($Order_details[$v->gid] as $order_val)
                                                @if($v->oid == $order_val->oid)
                                                    @if($order_val->flavor == '0')
                                                    未选择口味
                                                    @else
                                                    {{$order_val->flavor}}
                                                    @endif
                                                @endif
                                            @empty
                                            @endforelse
                                            </span>

                                        </div>
                                        <div class="item-price">
                                            价格：<strong>{{$Goods_Price[$v->gid]}}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="item-comment">
                                    <textarea placeholder="请写下对宝贝的感受吧，对他人帮助很大哦！" name="content[]"></textarea>
                                </div>
                                <div class="item-opinion">
                                    <li><i class="op1 active" onclick="one({{$e++}},'vals{{$f++}}')"></i> 好评</li>
                                    <li><i class="op2" onclick="one1({{$g++}},'vals{{$h++}}')"></i>中评</li>
                                    <li><i class="op3" onclick="one2({{$i++}},'vals{{$j++}}')"></i>差评</li>
                                    <input type="hidden" name="gid[]" value="{{$v->gid}}">
                                    <input type="hidden" name="uid" value="{{session('home_user')->id}}">
                                    <input type="hidden" name="rank[]"  value="" id="vals{{$d++}}">
                                     <input type="hidden" name="oid"  value="{{$oid}}">
                                    @forelse($Order_details[$v->gid] as $order_val)
                                                @if($v->oid == $order_val->oid)
                                                    <input type="hidden" name="orderId" value="{{$order_val->onum}}">
                                                @endif
                                            @empty
                                            @endforelse
                                </div>
                            </div>
                            @empty
                            @endforelse
                            <script>
                                var count = $('#count').text();

                                for(var i=0;i<count;i++){
                                    $('#vals'+i+'').val(1);
                                }
                                function one(id,obj){
                                    var name = document.getElementById(obj)
                                    name.value = 1;

                                }
                                function one1(id,obj){

                                    var name = document.getElementById(obj)
                                    name.value = 2;
                                }
                                function one2(id,obj){

                                    var name = document.getElementById(obj)
                                    name.value = 3;
                                }
                            </script>
                                <div class="info-btn">
                                    <button class="am-btn am-btn-danger">发表评论</button>
                                </div>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $(".comment-list .item-opinion li").click(function() {
                                $(this).prevAll().children('i').removeClass("active");
                                $(this).nextAll().children('i').removeClass("active");
                                $(this).children('i').addClass("active");

                            });
                     })
                    </script>



                        </div>

                    </div>
                    </form>

                </div>
                <!--底部-->
            @include('home.public.footer')

            </div>

            @include('home.public.list')

        </div>

    </body>

</html>