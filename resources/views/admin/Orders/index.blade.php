@extends('admin.index.index')

@section('center')
    <section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">订单列表</h2>
      </div>
      <form action="/admin/users" method="get">
      <section class="mtb">
         <select  name="type" class="select">
            <option value="1">按类型查找</option>
            <option value="2">用户名</option>
            <option value="3">邮箱</option>
            <option value="4">电话</option>
         </select>
         <input type="text" name="value" class="textbox textbox_225" value="{{$params['value'] or ''}}" placeholder="输入会员号/手机/电子邮件查询..."/>
         <input type="submit" value="查询" class="group_btn"/>
      </section>
      </form>
      <table class="table">
           <tr>
                <th class="center">ID</th>
                <th class="center">订单号</th>
                <th class="center">创建时间</th>
                <th class="center">查看详情</th>
                <th class="center">操作</th>
           </tr>
       @forelse ($order as $k=>$v)
        <tr>
            <td class="center">{{ $v->id }}</td>
            <td class="center">{{ $v->onum }}</td>
            <td class="center">{{ $v->created_at }}</td>
            <td class="center"><a href="/admin/order/details/{{ $v->id }}">查看详情</a></td>
            <td class="center">
                 <a href="/admin/users//edit" title="编辑" class="link_icon">&#101;</a>
            </td>
        </tr>
        @empty
        暂无数据
        @endforelse
      </table>
      <aside class="paging">
           {{-- $users->appends($params)->links() --}}
      </aside>
 </div>
</section>

@endsection