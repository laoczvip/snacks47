@extends('admin.index.index')

@section('center')
    <section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">会员列表</h2>
       <a href="/admin/users/create" class="fr top_rt_btn add_icon">添加新会员</a>
      </div>
      <form action="admin/index" method="get">
      <section class="mtb">
         <select class="select">
            <option>会员等级</option>
            <option>普通会员</option>
            <option>高级会员</option>
         </select>
         <input type="text" name="name" class="textbox textbox_225" placeholder="输入会员号/手机/电子邮件查询..."/>
         <input type="submit" value="查询" class="group_btn"/>
      </section>
      </form>
      <table class="table">
           <tr>
                <th>Id</th>
                <th>会员头像</th>
                <th>会员账号</th>
                <th>会员名称</th>
                <th>手机号码</th>
                <th>电子邮件</th>
                <th>创建时间</th>
                <th>操作</th>
           </tr>
           @foreach($users as $k=>$v)
        <tr>
            <td class="center">{{$v->id}}</td>
            <td class="center"><img src="/uploads/{{$v->userinfo->ufile}}" width="50" height="50"/></td>
            <td>{{$v->name}}</td>
            <td class="center">{{$v->number}}</td>
            <td class="center">{{$v->userinfo->tel}}</td>
            <td class="center">{{$v->userinfo->email}}</td>
            <td class="center">{{$v->created_at}}</td>
            <td class="center">
                 <a href="user_detail.html" title="编辑" class="link_icon">&#101;</a>
                 <a href="#" title="删除" class="link_icon">&#100;</a>
            </td>
        </tr>
        @endforeach
      </table>
      <aside class="paging">
           {{ $users->links() }}
      </aside>
 </div>
</section>

@endsection