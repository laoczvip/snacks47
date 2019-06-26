<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0 ,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>结算页面</title>
        <link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
        <link href="/h/basic/css/demo.css" rel="stylesheet" type="text/css" />
        <link href="/h/css/cartstyle.css" rel="stylesheet" type="text/css" />
        <link href="/h/css/jsstyle.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/h/js/address.js"></script>
        <style type="text/css">
            .btn {
                display: inline-block;
                padding: 6px 12px;
                margin-bottom: 0px;
                font-size: 14px;
                font-weight: 400;
                line-height: 1.4285;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                -ms-touch-action: manipulation;
                touch-action: manipulation;
                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                background-image: none;
                border: 1px solid transparent;
                border-radius: 4px;
            }
            .btn-danger {
                color: #fff;
                background-color: #d9534f;
                border-color: #d43f3a;
            }
        </style>
    </head>

    <body>

        <!--顶部导航条 -->
    @include('home.public.hmtop')


            <div class="clear"></div>
            <div class="concent">
                <!--地址 -->
                <div class="paycont">
                    <div class="address">
                        <h3>确认收货地址 </h3>
                        <div class="control">
                            <div class="tc-btn createAddr theme-login am-btn am-btn-danger">使用新地址</div>
                        </div>
                        <div class="clear"></div>
                        <ul>
                            <div class="per-border"></div>
                            @foreach($address as $k=>$v)
                                <li onclick="asjh( {{$v['id']}},this)" class="user-addresslist
                                    @if($v['default']  == 1)
                                        defaultAddr
                                    @endif" >
                                        <div class="address-left">
                                            <div class="user DefaultAddr">
                                                    <span class="buy-user" id="name">{{ $v['consignee'] }}</span>
                                                    <span class="buy-phone" id="tel">{{ $v['atel'] }}</span>
                                            </div>
                                            <div class="default-address DefaultAddr">
                                                    <span class="buy-line-title buy-line-title-type">收货地址：</span>
                                                    <span class="province" id="address">{{ $v['address'] }}{{ $v['detailed'] }}</span>
                                            </div>
                                             @if($v['default']  == 1)
                                            <ins class="deftip">默认地址</ins>
                                        @endif
                                        </div>
                                        <div class="address-right">
                                            <span class="am-icon-angle-right am-icon-lg"></span>
                                        </div>
                                        <div class="clear"></div>

                                        <div class="new-addr-btn">
                                            <a href="#">设为默认</a>
                                            <span class="new-addr-bar">|</span>
                                            <a href="#">编辑</a>
                                            <span class="new-addr-bar">|</span>
                                            <a href="javascript:void(0);"  onclick="delClick(this);">删除</a>
                                        </div>
                                </li>
                            @endforeach
                        </ul>

                        <div class="clear"></div>
                    </div>
                    <!--物流 -->
                    <div class="logistics">
                        <h3>选择物流方式</h3>
                        <ul class="op_express_delivery_hot">
                            <li data-value="yuantong" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -468px"></i>圆通<span></span></li>
                            <li data-value="shentong" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -1008px"></i>申通<span></span></li>
                            <li data-value="yunda" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -576px"></i>韵达<span></span></li>
                            <li data-value="zhongtong" class="OP_LOG_BTN op_express_delivery_hot_last "><i class="c-gap-right" style="background-position:0px -324px"></i>中通<span></span></li>
                            <li data-value="shunfeng" class="OP_LOG_BTN  op_express_delivery_hot_bottom"><i class="c-gap-right" style="background-position:0px -180px"></i>顺丰<span></span></li>
                        </ul>
                    </div>
                    <div class="clear"></div>

                    <!--支付方式-->
                    <div class="logistics">
                        <h3>选择支付方式</h3>
                        <ul class="pay-list">
                            <li class="pay card"><img src="/h/images/wangyin.jpg" />银联<span></span></li>
                            <li class="pay qq"><img src="/h/images/weizhifu.jpg" />微信<span></span></li>
                            <li class="pay taobao"><img src="/h/images/zhifubao.jpg" />支付宝<span></span></li>
                        </ul>
                    </div>
                    <div class="clear"></div>

                    <!--订单 -->
                    <div class="concent">
                        <div id="payTable">
                            <h3>确认订单信息</h3>
                            <div class="cart-table-th">
                                <div class="wp">

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
                                    <div class="th th-oplist">
                                        <div class="td-inner">配送方式</div>
                                    </div>

                                </div>
                            </div>
                            <div class="clear"></div>
                        <form action="/add" method="post" accept-charset="utf-8">
                            <tr class="item-list">
                                    <div class="bundle  bundle-last">
                                     {{ csrf_field() }}
                                        <div class="bundle-main">
                                            <ul class="item-content clearfix">
                                                <div class="pay-phone">
                                                    <li class="td td-item">
                                                        <div class="item-pic">
                                                            <a href="#" class="J_MakePoint">
                                                                <img src="/uploads/{{ $goods_sku->showcase }}" class="itempic J_ItemImg" width="100"></a>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="item-basic-info">
                                                                <a href="#" class="item-title J_MakePoint" data-point="tbcart.8.11">{{  $goods_sku->title}}</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="td td-info">

                                                        <div class="item-props">
                                                            <span class="sku-line">口味：{{ $flavor}}</span>
                                                            <span class="sku-line">包装：袋装</span>
                                                        </div>
                                                    </li>
                                                    <li class="td td-price">
                                                        <div class="item-price price-promo-promo">
                                                            <div class="price-content">
                                                                <em class="J_Price price-now" >{{$goods_sku->price }}</em>
                                                              <input type="hidden" value="{{$goods_sku->price }}" id="price" />

                                                            </div>
                                                        </div>
                                                    </li>
                                                </div>
                                                <li class="td td-amount">
                                                    <div class="amount-wrapper ">
                                                        <div class="item-amount ">
                                                            <span class="phone-title">购买数量</span>
                                                            <div class="sl">
                                                                <input type="button" onclick="numDec()" value="-">
                                                                <input type="text" id="quantity" value="1" readonly style="width:40px; ">
                                                                <input type="button" onclick="numAdd()" value="+">
                                                                <input type="hidden" name="num" id="number" value="">
                                                                <input type="hidden" name="price" id="pprice" value="">
                                                                <input type="hidden" name="address" id="addresss" value="">
                                                                <input type="hidden" name="flavor"  value="{{ $flavor}}">
                                                                <input type="hidden" name="gid" value="{{ $goods_sku->id }}">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="td td-sum">
                                                    <div class="td-inner">
                                                        <em tabindex="0" class="J_ItemSum number" id="totalPrice">{{$goods_sku->price}}</em>
                                                    <input type="hidden" id="stock" value="{{$goods_sku->stock}}">
                                                    </div>
                                                </li>
                                                <li class="td td-oplist">
                                                    <div class="td-inner">
                                                        <span class="phone-title">配送方式</span>
                                                        <div class="pay-logis">
                                                            快递<b class="sys_item_freprice">10</b>元
                                                        </div>
                                                    </div>
                                                </li>

                                            </ul>
                                            <div class="clear"></div>
                                        </div>
                                </tr>
                            <div class="clear"></div>
                            </div>

                            </div>
                            <div class="clear"></div>
                            <div class="pay-total">
                        <!--留言-->
                            <div class="order-extra">
                                <div class="order-user-info">
                                    <div id="holyshit257" class="memo">
                                        <label>买家留言：</label>
                                        <input type="text" name="lam" title="选填,对本次交易的说明（建议填写已经和卖家达成一致的说明）" placeholder="选填,建议填写和卖家达成一致的说明" class="memo-input J_MakePoint c2c-text-default memo-close">
                                        <div class="msg hidden J-msg">
                                            <p class="error">最多输入500个字符</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="clear"></div>
                            </div>
                            <!--含运费小计 -->
                            <div class="buy-point-discharge ">
                                <p class="price g_price ">
                                    合计（含运费） <span>¥</span><em class="pay-sum" id="pprasdsaice">{{$goods_sku->price + 10 }}.00</em>
                                </p>
                            </div>
                            <div id="holyshit269" class="submitOrder">
                                <div class="go-btn-wrap">
                                    <button style="float:right"   type="submit" class="btn btn-danger" >提交订单</button>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>

                    </div>
                </div>

                <div class="clear"></div>
            </div>
        </div>
 </form>
            <!-- 网页尾部 -->
            @include('home.public.footer')
            <div class="theme-popover-mask"></div>
            <div class="theme-popover">

            <!-- 新增地址 弹框 开始 -->
                <!--标题 -->
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add address</small></div>
                </div>
                    <hr/>

                    <div class="am-u-md-12">
                        <form class="am-form am-form-horizontal">

                            <div class="am-form-group">
                                <label for="user-name" class="am-form-label">收货人</label>
                                <div class="am-form-content">
                                    <input type="text" id="user-name" placeholder="收货人">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-phone" class="am-form-label">手机号码</label>
                                <div class="am-form-content">
                                    <input id="user-phone" placeholder="手机号必填" type="email">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-phone" class="am-form-label">所在地</label>
                                <div class="am-form-content address">
                                    <select data-am-selected>
                                        <option value="a">浙江省</option>
                                        <option value="b">湖北省</option>
                                    </select>
                                    <select data-am-selected>
                                        <option value="a">温州市</option>
                                        <option value="b">武汉市</option>
                                    </select>
                                    <select data-am-selected>
                                        <option value="a">瑞安区</option>
                                        <option value="b">洪山区</option>
                                    </select>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-intro" class="am-form-label">详细地址</label>
                                <div class="am-form-content">
                                    <textarea class="" rows="3" id="user-intro" placeholder="输入详细地址"></textarea>
                                    <small>100字以内写出你的详细地址...</small>
                                </div>
                            </div>

                            <div class="am-form-group theme-poptit">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <div class="am-btn am-btn-danger">保存</div>
                                    <div class="am-btn am-btn-danger close">取消</div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="clear"></div>
            <!-- 新增地址 弹框 结束 -->

    </body>


</html>
<script>
    let price = $('#price').text();
    $('#pprice').val(price);

    function asjh(id){
         $('#addresss').val(id);
    }

    function jia(){
        let price = $('#danjia').text();

        let num = $('#num').val()
        let a = (price * num++ )
        $('#number').val(num);
        $('#pprice').val(a);
        $('#price').text(a);
        $('#danjia').text(a);
        console.log(a,num)
    }




    function keyup(){

    var quantity = document.getElementById("quantity").value;

    if(isNaN(quantity) ||  parseInt(quantity)!=quantity || parseInt(quantity)<1){

        quantity = 1;

        return;

    }

    if(quantity>=10){

        document.getElementById("quantity").value=quantity.substring(0,quantity.length-1);

        alert("商品数量不能大于10");

    }

}



    /*商品数量+1*/

    function numAdd(){

        var quantity = document.getElementById("quantity").value;
        console.log(quantity)
        var num_add = parseInt(quantity)+1;

        var price=document.getElementById("price").value;

        if(quantity==""){

            num_add = 1;

        }
        let stock = $('#stock').val();
        if(num_add>=stock){

            document.getElementById("quantity").value=num_add-1;

            layer.msg('库存不足', function(){});
            return false;

        }else{

            document.getElementById("quantity").value=num_add;

            var Num=price*num_add;

            let a =  document.getElementById("totalPrice").innerHTML=Num.toFixed(2);
            $('#pprice').val(a);
            $('#pprasdsaice').text(a);
            $('#number').val(quantity);

        }

    }

    /*商品数量-1*/

    function numDec(){

        var quantity = document.getElementById("quantity").value;

        var price=document.getElementById("price").value;

        var num_dec = parseInt(quantity)-1;

        if(num_dec>0){

        document.getElementById("quantity").value=num_dec;

        var Num=price*num_dec;

        let a = document.getElementById("totalPrice").innerHTML=Num.toFixed(2);
            $('#pprice').val(a);
            $('#pprasdsaice').text(a);
            $('#number').val(quantity);
    }

}
</script>