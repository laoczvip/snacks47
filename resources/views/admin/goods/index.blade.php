@extends('admin.index.index')

@section('center')

<section class="rt_wrap content mCustomScrollbar">
     <div class="rt_content">
        <form action="admin/cates" method="get">
          <section class="mtb">
             <select class="select" name="cid">
                  @forelse($cates as $k=>$v)
                        @if($v->pid==0)
                            <option value="0" disabled>{{$v->title}}</option>
                        @else
                             <option value="0">{{$v->title}}</option>
                        @endif
                        @empty
                        @endforelse
             
             </select>
             <input type="text" name="name" class="textbox textbox_225" placeholder="输入会员号/手机/电子邮件查询..."/>
             <input type="submit" value="查询" class="group_btn"/>
          </section>
          </form>
          <table class="table">
               <tr>
                    <th style="width:100px;">Id</th>
                    <th style="width:150px;">类名</th>
                    <th style="width:100px;">父类id</th>
                    <th>类排序</th>
                    <th style="width:100px;">状态</th>
                    <th>创建时间</th>
                    <th>操作</th>
               </tr>
        
            
          </table>
          <aside class="paging">
           
          </aside>
     </div>
</section>


@endsection