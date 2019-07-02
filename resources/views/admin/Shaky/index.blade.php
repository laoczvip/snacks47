@extends('admin.index.index')

@section('center')

<section class="rt_wrap content mCustomScrollbar">
     <div class="rt_content">
        <div class="page_title">
         <h2 class="fl">活动类列表</h2>
        </div>
          <table class="table" style="text-align:center;">

               <tr style="text-align:center;">
                    <th style="text-align:center;">活动Id</th>
                    <th style="text-align:center;">活动类</th>
                    <th style="text-align:center;">活动展示图</th>
                    <th style="text-align:center;">活动开启时间</th>
                    <th style="text-align:center;">活动结束时间</th>
                    <th style="text-align:center;">操作</th>
               </tr>
                 @forelse($shaky as $k=>$v)
               <tr>
                 <td >{{$v->id}}</td>
                 <td>{{$v->sname}}</td>
                 <td><img src="/uploads/{{$v->profile}}" width="60"></td>
                 <td>{{$v->ctime}}</td>
                 <td>{{$v->jtime}}</td>
                 <td>
                   <a href="javascript:;" onclick="del({{$v->id}},this)" class="link_icon" title="删除">&#100;</a>
                   <a href="/admin/shaky/edit?id={{$v->id}}" class="link_icon" title="修改">&#101;</a>
                   <a href="/admin/shakys/index?id={{$v->id}}" class="link_icon" title="加入商品"><span style="font-size: 19px;" class="glyphicon glyphicon-plus" aria-hidden="true" ></span></a>
                   <a href="/admin/shakys/show?id={{$v->id}}"  title="查看活动商品" class="link_icon">&#118;</a>
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
  function del(id,obj){
     var a = confirm('您确认删除吗');
     if(a){
        $.get('/admin/shaky/del',{id:id},function(res){
            if(res=='ok'){
              $(obj).parent().parent().remove();
              alert('成功删除');
            } else if(res=='errr'){
              alert('该活动还含有子商品');
            } else{
              alert('删除失败');
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