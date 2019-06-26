@extends('admin.index.index')

@section('center')
    <style type="text/css">
    </style>
    <section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">订单详情</h2>
      </div>
      <table class="table">
           <tr>
                <th class="center">ID</th>
                <th class="center">商品名称</th>
                <th class="center">商品图片</th>
                <th class="center">商品口味</th>
                <th class="center">收取金额</th>
                <th class="center">数量</th>
                <th class="center">留言</th>
                <th class="center">收货地址</th>
                <th class="center">收货人</th>
                <th class="center">联系电话</th>
                <th class="center">操作</th>
           </tr>
        <tr>
            <td class="center">{{ $order->id }}</td>
            <td class="center">{{$goods->title}}</td>
            <td class="center"><img src="/uploads/{{$goods->showcase}}" width="50px"></td>
            <td class="center">{{ $order->flavor }}</td>
            <td class="center">¥{{ $order->price }}</td>


            <td class="center">X{{$order->number}}</td>
            <td class="center">{{$order->lam or '暂无留言' }}</td>
            <td class="center">{{ $address->address.$address->detailed }}</td>
            <td class="center">{{ $address->consignee }}</td>
            <td class="center">{{ $address->atel }}</td>
            <td class="center">
                @if( $order->dtype == 0)
                    <p id="asjhd" style="margin-left:45px;">待发货</p>
                    <button type="button" class="btn btn-success"  onclick="Delivergoods({{$order->id}}) " id="qdsh">已发货</button>
                @elseif( $order->dtype == 1)
                    已发货

                @elseif( $order->dtype == 2)
                    买家已收货
                @else
                    完成订单
                @endif
            </td>
        </tr>
      </table>
      <aside class="paging">
           {{-- $users->appends($params)->links() --}}
      </aside>
 </div>
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
</section>
@endsection