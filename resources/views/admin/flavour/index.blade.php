@extends('admin.index.index')

@section('center')

<section class="rt_wrap content mCustomScrollbar">
     <div class="rt_content">
        <form action="/admin/flavour/index" method="get">
          <section class="mtb">
             <select class="select" name="touch" id="test" onchange="tt(this.id)">
              <option value="">---请选择---</option>
                  @forelse($list as $k=>$v)
                  
                  <option value="{{$v}}">{{$v}}</option>
                 
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
          <table class="table" style="text-align:center">
               <tr>
                    <th  style="text-align:center">Id</th>
                    <th  style="text-align:center">属性名</th>

                    <th  style="text-align:center">操作</th>
               </tr>
               @forelse($data as $k=>$v)
               <tr>
                 <td>{{$v->touch}}</td>
                 <td>{{$v->fname}}</td>
                 <td>
                    <a href="javascript:;" onclick="del({{$v->id}},this)" class="link_icon"><span class="glyphicon glyphicon-trash" aria-hidden="true" title="删除"></span></a>
                    <a href="/admin/flavour/edit?id={{$v->id}}" class="link_icon"><span class="glyphicon glyphicon-cog" aria-hidden="true" title="修改"></span></a>
                 </td>
               </tr>
               @empty
               @endforelse
          </table>
          <aside class="paging">
            @if($touch!='')
            {{$data->appends(['touch'=>$touch])->links()}}
            @else
            {{$data->links()}}
            @endif
          </aside>
     </div>
</section>
<script src="/layui/layui.js">
               layui.use('layer',
                    function(){
                        var layer = layui.layer;
                });
                </script>
<script>
  function del(id,obj)
  {
     var a = confirm('您确定要删除吗');
     if(a){
       $.get('/admin/flavour/destroy',{id:id},function(res){
        if(res == '删除成功'){
            layer.msg(res, {icon: 1});
            $(obj).parent().parent().remove();          
        } else {
            layer.msg(res, {icon: 5});
        }
     },'json');
     }
    
  }
</script>

@endsection