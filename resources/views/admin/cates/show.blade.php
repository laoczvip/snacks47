@extends('admin.index.index')

@section('center')
<section class="rt_wrap content mCustomScrollbar">
     <div class="rt_content">
       <div class="page_title">
       <h2 class="fl">子分类列表</h2>
       <a href="/admin/cates/index" class="fr top_rt_btn add_icon">返回类首页</a>
      </div>
        <form action="/admin/cates/show" method="get">
          <section class="mtb">
             <select class="select" name="cid" id="test" onchange="tt(this.id)">
              <option value="0">---请选择---</option>
                  @forelse($cate as $k=>$v)
                  
                  <option value="{{$v->id}}">{{$v->title}}</option>
                
                  @empty
                  @endforelse
                  <option value="0">--手动输入--</option>
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
                if(value == 0) {
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
                    <th style="width:200px;">类排序</th>
                    <th style="width:100px;">状态</th>
                    <th style="width:150px;">创建时间</th>
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
                   <a href="/admin/cates/store?id={{$v->id}}&status={{$v->status}}">修改</a>
                </td>
                 <td>{{$v->add_time}}</td>
                 <td>
                    <a href="/admin/cates/show?id={{$v->id}}">查看子类</a>
                    <a href="/admin/cates/create?id={{$v->id}}">添加子类</a>
                    <a href="/admin/cates/delete?id={{$v->id}}" title="删除" class="link_icon">&#100;</a>
                    <a href="/admin/cates/edit?cid={{$v->id}}" title="修改" class="link_icon">&#101;</a>
                    <a  onclick="javascript:history.back(-1)">返回上一级</a>
                 </td>
               </tr>
               @empty
               <tr>
                <td colspan="7" align="center">--------------------暂无多余信息----------------------<br><a  onclick="javascript:history.back(-1)">返回上一级</a></td>
                  <a  onclick="javascript:history.back(-1)">返回上一级</a>
               </tr>
                      
               @endforelse
          </table>
          <aside class="paging">
            {{ $cate->links() }}
          </aside>
     </div>
</section>


@endsection