@extends('admin.index.index')

@section('center')
<section class="rt_wrap content mCustomScrollbar">
     <div class="rt_content">
        <form action="admin/cates" method="get">
          <section class="mtb">
             <select class="select">
                <option>商品类</option>
             
             </select>
             <input type="text" name="name" class="textbox textbox_225" placeholder="输入会员号/手机/电子邮件查询..."/>
             <input type="submit" value="查询" class="group_btn"/>
          </section>
          </form>
          <table class="table">
               <tr>
                    <th>Id</th>
                    <th>类名</th>
                    <th>父类id</th>
                    <th>类排序</th>
                    <th>状态</th>
                    <th>创建时间</th>
                    <th>操作</th>
               </tr>
               @forelse($cate as $k=>$v)
               <tr>
                 <td>{{$v->id}}</td>
                 <td>{{$v->title}}</td>
                 <td>{{$v->pid}}</td>
                 <td>{{$v->path}}</td>
                 <td>
                 @if($v->status==1)
                 <kbd style="background:green">正常</kbd>
                 @else
                 <kbd>禁用</kbd>
                 @endif
                </td>
                 <td>{{$v->add_time}}</td>
                 <td>
                    <a href="/admin/cates/show?id={{$v->id}}">查看子类</a>
                    <a href="/admin/cates/create?id={{$v->id}}">添加子类</a>
                 </td>
               </tr>
               @empty
               <tr>
                <td colspan="7" align="center">--------------------暂无多余信息----------------------</td>
                  
               </tr>
                      
               @endforelse
          </table>
          <aside class="paging">
            {{ $cate->links() }}
          </aside>
     </div>
</section>


@endsection