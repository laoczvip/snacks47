@extends('admin.index.index')

@section('center')
    <section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">会员列表</h2>
       <a href="user_detail.html" class="fr top_rt_btn add_icon">添加新会员</a>
      </div>
      <section class="mtb">
       <select class="select">
        <option>会员等级</option>
        <option>普通会员</option>
        <option>高级会员</option>
       </select>
       <input type="text" class="textbox textbox_225" placeholder="输入会员号/手机/电子邮件查询..."/>
       <input type="button" value="查询" class="group_btn"/>
      </section>
      <table class="table">
           <tr>
                <th class="center">Id</th>
                <th class="center">会员账号</th>
                <th class="center">会员头像</th>
                <th class="center">手机号码</th>
                <th class="center">电子邮件</th>
                <th class="center">验证</th>
                <th class="center">会员等级</th>
                <th class="center">删除时间</th>
                <th class="center">操作</th>
           </tr>
       @forelse ($del_users as $key => $value)
        <tr>
            <td class="center">{{$value->id}}</td>
            <td>{{$value->name}}</td>
            @foreach ($del_usersinfo as $keyy => $valuee)
                @if ($value->id == $valuee->uid)
                <td class="center"><img src="/uploads/{{$valuee->ufile}}" width="50" height="50"/></td>
                <td class="center">{{$valuee->tel}}</td>
                <td class="center">{{$valuee->email}}</td>
                <td class="center">{{$valuee->deleted_at}}</td>
                @endif
            @endforeach
            <td class="center">{{$value->number}}</td>
            <td class="center">{{$value->created_at}}</td>
            <td class="center">
                    <button onclick="huifu({{ $value->id }},this)" type="button" class="btn btn-warning">恢复用户</button>
                    <button onclick="permanent({{ $value->id }},this)" type="button" class="btn btn-danger">永久删除</button>
            </td>

        </tr>
        @empty
        <tr>
          <th class="center" colspan="9">暂无数据</th>
        </tr>
        @endforelse
      </table>
      <aside class="paging">
      </aside>

 </div>
</section>

<script>
    function huifu(id,obj){
        var url = '/admin/user/huifu/'+id;

        $.get(url,function(res){
                  console.log(res);
                if (res == 1) {
                    $(obj).parent().parent().remove();
                    layer.msg('用户已恢复');
                };
            },'html');
    }

    function permanent(id,obj){
        var url = '/admin/user/permanent/'+id;

        layer.confirm('永久删除之后不能恢复,你确定要删除吗', {
          btn: ['确定','再考虑'] //按钮
        }, function(){
            $.get(url,function(res){
                if (res == 1) {
                    $(obj).parent().parent().remove();
                    layer.msg('删除成功');
                };
            },'html');

        }, function(){
          btn: ['确定','再考虑'] //按钮
        });

    }


</script>


@endsection