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
                    <th class="center">Id</th>
                    <th class="center">类名</th>
                    <th class="center">父类id</th>
                    <th >类排序</th>
                    <th class="center">状态</th>
                    <th class="center" style="width:250px;">创建时间</th>
                    <th class="center">操作</th>
               </tr>
               @forelse($cate as $k=>$v)
               <tr>
                 <td class="center">{{$v->id}}</td>
                 <td class="center">{{$v->title}}</td>
                 <td class="center">{{$v->pid}}</td>
                 <td class="center">{{$v->path}}</td>
                 <td class="center">
                 @if($v->status==1)
                 <kbd style="background:green">正常</kbd>
                 @else
                 <kbd>禁用</kbd>
                 @endif
                   <a href="/admin/cates/store?id={{$v->id}}&status={{$v->status}}" title="切换"><span class="glyphicon glyphicon-refresh" aria-hidden="true" ></span></a>
                </td>
                 <td class="center">{{$v->add_time}}</td>
                 <td class="center">
                 <a href="/admin/cates/delete?id={{$v->id}}" class="link_icon" title="删除">&#100;</a>
                    <a href="/admin/cates/edit?cid={{$v->id}}" class="link_icon" title="修改">&#101;</a>
                    <a href="/admin/cates/create?id={{$v->id}}" class="link_icon"><span style="font-size: 19px;" class="glyphicon glyphicon-plus" aria-hidden="true" title="加入子类"></span></a>
                    <a href="/admin/cates/show?id={{$v->id}}" class ="link_icon"  title="查看子类">&#118;</a>

                    <a  onclick="javascript:history.back(-1)" ><span style="font-size: 19px;color:#19a97b;" class="glyphicon glyphicon-share-alt" aria-hidden="true" title="返回"></span></a>
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
            {{ $cate->appends(['id'=>$cid])->links() }}
          </aside>
     </div>
</section>


@endsection