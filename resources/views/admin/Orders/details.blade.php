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
                        <td>联系电话：{{ $address->consignee }}</td>
                        <td>收件地址：{{ $address->address.$address->detailed }}</td>
                        <td>付款时间：{{ $time }}</td>
                    </tr>
                    <tr>
                        <td>下单时间：{{ $time }}</td>
                        <td>付款时间：{{ $time }}</td>
                        <td>确认时间：{{ $time }}</td>
                        <td>评价时间时间：{{ $time }}</td>
                    </tr>
                    <tr>
                        <td>订单状态：<a style="text-decoration:none">
                        @if( $dtype == 0)
                            <a id="asjhd" style="margin-left:45px;text-decoration:none" id="asjhd">已付款，待发货</a>
                        @elseif( $dtype == 1)
                            已发货

                        @elseif( $dtype == 2)
                            买家已收货
                        @elseif( $dtype == 3)
                            交易已完成
                        @endif
                        </a></td>
                        <td colspan="3">订单备注：<mark>{{$lam or '暂无留言' }}</mark></td>
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
                @foreach($order as $k=>$v)
                    @foreach($v->usergood as $k=>$good)
                   <tr>
                        <td class="center"><img src="/uploads/{{$good->showcase}}" width="50" height="50"/></td>
                        <td class="center">{{$good->title}}</td>
                        <td class="center"><strong class="rmb_icon">{{$good->price}}</strong></td>
                        <td class="center">
                         <p class="center">口味：{{ $v->flavor }}</p>
                        </td>
                        <td class="center"><strong>{{ $v->number }}</strong></td>
                        <td class="center"><strong class="rmb_icon">{{ $v->price }}</td>
                        <td class="center">包</td>
                   </tr>
                   @endforeach
                   @endforeach
              </table>
              <aside class="mtb" style="text-align:right;">
                   <label>管理员操作：</label>
                        @if( $dtype == 0)
                       <input type="button" id="qdsh" value="发货" id="asjhd"  class="group_btn"  onclick="Delivergoods({{$v->oid}}) "/>
                        @elseif( $dtype == 1)
                       <input type="button" value="已发货" style="border: 1px #bcc1c0 solid;
                             background: #c1c5c4;"  class="group_btn"   "/>
                        @elseif( $dtype == 3)
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