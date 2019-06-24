@extends('admin.index.index')

@section('center')

<section class="rt_wrap content mCustomScrollbar">
     <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">分类列表</h2>     
      </div>
               <form action="/admin/cates/index" method="get">
          <section class="mtb">
             <select class="select" name="cid" id="test" onchange="tt(this.id)">
              <option value="">---请选择---</option>
                  @forelse($cates_data as $k=>$v)
                  @if($v->pid==0)
                  <option value="{{$v->id}}">{{$v->title}}</option>
                  @endif
                  @empty
                  @endforelse                
             </select>
             <input  type="text" name="name" class="textbox textbox_225" style="height:38px;" disabled id="txt"/>
             <input type="submit" value="查询" class="group_btn"/>
          </section>
          </form>
          <script>
            // 选中搜索
             function tt(id) {
                var aa = document.getElementById(id);
                var i = aa.selectedIndex;
                var text = aa.options[i].text;
                var value = aa.options[i].value;
                if(value == 1) {
                    text = "输入商品名称";
                document.getElementById("txt").disabled=false;
                } else {
                document.getElementById("txt").disabled=true;
                }
                document.getElementById("txt").value = text;
               
            }

          </script>
          <table class="table">
               <tr>
                    <th style="width:100px;">Id</th>
                    <th style="width:100px;">类名</th>
                    <th style="width:100px;">父类id</th>
                    <th>类排序</th>
                    <th style="width:100px;">状态</th>
                    <th>创建时间</th>
                    <th>操作</th>
               </tr>
               @forelse($cates as $k=>$v)
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
                   <a href="/admin/cates/store?id={{$v->id}}&status={{$v->status}}">修改</a>
                </td>
                 <td>{{$v->add_time}}</td>
                 <td>
                    <a href="/admin/cates/show?id={{$v->id}}">查看子类</a>
                    <a href="/admin/cates/create?id={{$v->id}}">添加子类</a>
                    <a href="/admin/cates/delete?id={{$v->id}}" class="link_icon">&#100;</a>
                    <a href="/admin/cates/edit?cid={{$v->id}}" class="link_icon">&#101;</a>
                 </td>
               </tr>
               @empty
               @endforelse
          </table>
          <aside class="paging">
            {{ $cates->links() }}
          </aside>
     </div>
</section>


@endsection