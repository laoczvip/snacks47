@extends('admin.index.index')

@section('center')

<section class="rt_wrap content mCustomScrollbar">
     <div class="rt_content">
        <form action="/admin/cates/index" method="get">
          <section class="mtb">
             <select class="select" name="cid" id="test" onchange="tt(this.id)">
              <option value="">---请选择---</option>
                  @forelse($data as $k=>$v)
                  @if($v->id==0)
                  <option value="{{$v->id}}">{{$v->fname}}</option>
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
          <table class="table" style="text-align:center">
               <tr>
                    <th  style="text-align:center">Id</th>
                    <th  style="text-align:center">属性名</th>

                    <th  style="text-align:center">操作</th>
               </tr>
               @forelse($data as $k=>$v)
               <tr>
                 <td>{{$v->id}}</td>
                 <td>{{$v->fname}}</td>
                 <td>
                    <a href="javascript:;" onclick="del({{$v->id}},this)">删除属性</a>
                    <a href="/admin/flavour/edit?id={{$v->id}}">修改类名</a>
                 </td>
               </tr>
               @empty
               @endforelse
          </table>
          <aside class="paging">
         
          </aside>
     </div>
</section>
<script>
  function del(id,obj)
  {
     var a = confirm('您确定要删除吗');
     if(a){
       $.get('/admin/flavour/destroy',{id:id},function(res){
        if(res == 'ok'){
            alert('成功删除');
            $(obj).parent().parent().remove();          
        }else if('errr'){
            alert('删除失败---该属性在商品中--');
        } else {
            alert('删除失败');
        }
     },'json');
     }
    
  }
</script>

@endsection