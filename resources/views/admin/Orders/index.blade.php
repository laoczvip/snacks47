@extends('admin.index.index')

@section('center')
<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">订单列表</h2>
      </div>
        <form action="/admin/order" method="get">
            <section class="mtb">
                 <select class="select" name="type">
                      <option  value="1"
                        @if($type == 1)
                          selected
                        @endif
                      >全部订单</option>
                      <option value="2"
                        @if($type == 2)
                          selected
                        @endif
                      >待发货</option>
                      <option value="3"
                        @if($type == 3)
                          selected
                        @endif
                      >待收货</option>
                      <option value="4"
                        @if($type == 4)
                          selected
                        @endif
                      >待评价</option>
                 </select>
                 <input type="text" class="textbox textbox_225" value="{{$value}}" name="onum" placeholder="输入订单编号"/>
                 <input type="submit" value="查询" class="group_btn"/>
            </section>
        </form>
      <table class="table">
         <tr>
            <th class="center">订单编号</th>
            <th class="center">收件人</th>
            <th class="center">联系电话</th>
            <th class="center">收件人地址</th>
            <th class="center">订单金额</th>
            <th class="center">订单状态</th>
            <th class="center">操作</th>
         </tr>
       @forelse ($order as $k=>$v)
         <tr>
            <td class="center">{{ $v->onum }}</td>

            <td class="center">{{ $v->addresss->consignee }}</td>

            <td class="center">{{ $v->addresss->atel }}</td>
            <td class="center">
                <address >
                    <p class="center">{{ $v->addresss->address}}</p>
                    <p class="center">{{ $v->addresss->detailed  }}</p>
                </address>
            </td>
            <td class="center"><strong class="rmb_icon">{{ $v->money }}</strong></td>
            <td class="center" >
                @if($v->otype == 0)
                    <span class="label label-default" style="font-size: 16px;background:#797676;">买家已付款,等待店家发货</span>
                @elseif($v->otype == 1)
                    <span class="label label-default" style="font-size: 16px;background:#d4c2a5;">店家已发货,等待买家收货</span>
                @elseif($v->otype == 2)
                    <span class="label label-default" style="font-size: 16px;background:#19a97b;">买家已收货</span>
                @elseif($v->otype == 3)
                    <span class="label label-default" style="font-size: 16px;background:#19a97b;">交易已完成</span>

                @endif
            </strong></td>
            <td class="center">
             <a href="/admin/order/details/{{ $v->id }}/{{ $v->aid }}" title="查看订单" class="link_icon" >&#118;</a>
             <a href="#" title="删除" class="link_icon">&#100;</a>
            </td>
         </tr>
         @empty
         <tr>
            <td class="center" colspan="7">暂无订单</td>
         </tr>
        @endforelse
      </table>
      <aside class="paging">
           {{ $order->appends($params)->links() }}

      </aside>
 </div>
</section>


@endsection