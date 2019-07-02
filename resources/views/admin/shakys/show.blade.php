@extends('admin.index.index')

@section('center')

<section class="rt_wrap content mCustomScrollbar">
     <div class="rt_content">
        <div class="page_title">
         <h2 class="fl">秒杀活动商品列表</h2>     
        </div>
          <table class="table" style="text-align:center;">
          
               <tr style="text-align:center;">
                    <th style="text-align:center;">排序</th>
                    <th style="text-align:center;">所属活动</th>
                    <th style="text-align:center;">商品库存</th>                     
                    <th style="text-align:center;">活动状态</th>
                    <th style="text-align:center;">操作</th>
               </tr>
                 @forelse($shaky as $k=>$v)
               <tr>
                 <td >{{$v->id}}</td>
                 <td>{{$v->sid}}</td>
                 <td>{{$v->stock}}</td>               
                 <td>
                  @if($v->status==0)
                  <kbd>未开启</kbd>
                  @else
                  <kbd style="background:green">已开启...</kbd>
                  @endif
                  </td>
                 <td>
                   <a href="javascript:;" onclick="dels({{$v->id}},this)" class="link_icon">&#100;</a>
                   <a href="/admin/shakys/edit?id={{$v->id}}" class="link_icon">&#101;</a>
                 </td>
               </tr>
                 @empty
                 @endforelse
          </table>         
          <aside class="paging">
         {{$shaky->links()}}
        
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
  function dels(id,obj){
     var a = confirm('您确认删除吗');
     if(a){
        $.get('/admin/shakys/del',{id:id},function(res){
            if(res=='删除成功'){
              layer.msg(res, {icon: 1});
              $(obj).parent().parent().remove();
            }  else{
              layer.msg(res, {icon: 5});
            }
        },'json');
     }
  }
</script>
<script type="text/javascript">
    //绑定change事件，当下拉框内容发生变化时启动事件
      $("#wlms").bind("change",function(){
        //设置input输入框可用（初始化是不可用）
        $("#wlbh").attr("disabled",false);
        //bianhao是<option>标签中自定义的属性，是为了获取后台传过来的值
        var bianhao = $(this).find("option:selected").attr("bianhao");
        //向input输入框中赋值
        $("#wlbh").val(bianhao);

    });
</script>

@endsection