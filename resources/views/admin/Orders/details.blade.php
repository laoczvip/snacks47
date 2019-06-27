@extends('admin.index.index')
@section('center')
<section class="rt_wrap content mCustomScrollbar">
     <div class="rt_content">
               <div class="page_title">
                 <h2 class="fl">订单详情</h2>
               </div>
               <table class="table">
                    <tr>
                        <td>收件人：{{ $address->consignee }}</td>
                        <td>联系电话：{{ $address->atel }}</td>
                        <td>收件地址：{{ $address->address.$address->detailed }}</td>
                        <td>付款时间：2016-02-01 13:56</td>
                    </tr>
                    <tr>
                        <td>下单时间：{{ $order->created_at }}</td>
                        <td>付款时间：{{ $order->created_at }}</td>
                        <td>确认时间：{{ $order->created_at }}</td>
                        <td>评价时间时间：---</td>
                    </tr>
                    <tr>
                        <td>订单状态：<a style="text-decoration:none">
                         @if( $order->dtype == 0)
                            <a id="asjhd" style="margin-left:45px;">已付款，待发货</a>

                        @elseif( $order->dtype == 1)
                            已发货

                        @elseif( $order->dtype == 2)
                            买家已收货
                        @elseif( $order->dtype == 3)
                            交易已完成
                        @endif
                        </a></td>
                        <td colspan="3">订单备注：<mark>{{$order->lam or '暂无留言' }}</mark></td>
                    </tr>
                  </table>
                <table class="table">
                <tr>
                    <th class="center">商品图</th>
                    <th class="center">商品名称</th>
                    <th class="center">商品单价</th>
                    <th class="center">商品参数</th>
                    <th class="center">购买数量</th>
                    <th class="center">收取金额</th>
                    <th class="center">包装方式</th>
                </tr>
                   <tr>
                        <td class="center"><img src="/uploads/{{$goods->showcase}}" width="50" height="50"/></td>
                        <td class="center">{{$goods->title}}</td>
                        <td class="center"><strong class="rmb_icon">{{ $goods->price }}</strong></td>
                        <td class="center">
                         <p class="center">口味：{{ $order->flavor }}</p>
                        </td>
                        <td class="center"><strong>{{$order->number}}</strong></td>
                        <td class="center"><strong class="rmb_icon">{{ $order->price }}</strong></td>
                        <td class="center">包</td>
                   </tr>
              </table>
              <aside class="mtb" style="text-align:right;">
                   <label>管理员操作：</label>
                    @if( $order->dtype == 0)
                       <input type="button" value="发货" id="asjhd" class="group_btn"  onclick="Delivergoods({{$order->id}}) "/>
                        @elseif( $order->dtype == 1)
                       <input type="button" value="已发货" style="border: 1px #bcc1c0 solid;
                             background: #c1c5c4;" id="asjhd" class="group_btn"   "/>
                        @elseif( $order->dtype == 3)
                             <input type="button" value="交易已完成"   class="group_btn"   "/>
                        @endif
              </aside>
         </div>
</section>
<script>
     function Delivergoods(id){
        let url = '/admin/order/dlivergoods/'+id
        $.get(url,function(res){
            if (res == 1) {
                $('#qdsh').attr('disabled','disabled');
                $('#asjhd').text('已发货');
                layer.alert('已发货,等待买家收货', {icon: 6});
            };
        })
     }
     </script>
@endsection