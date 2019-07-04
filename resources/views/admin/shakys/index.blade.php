@extends('admin.index.index')

@section('center')

<section class="rt_wrap content mCustomScrollbar">
     <div class="rt_content">
        <div class="page_title">
         <h2 class="fl">秒杀活动商品列表</h2>
       <a href="/admin/shaky/index" class="fr top_rt_btn add_icon">返回上一层</a>

        </div>
          <table class="table" style="text-align:center;">

               <tr style="text-align:center;">
                    <th style="text-align:center;">商品Id</th>
                    <th style="text-align:center;">商品名称</th>
                    <th style="text-align:center;">操作</th>
               </tr>
                 @forelse($shop as $k=>$v)
               <tr>
                 <td >{{$v->id}}</td>
                 <td>{{$v->title}}</td>
                 <td>
                   @if($v->sid!=0)
                  <a>已添加</a>
                  <a href="/admin/shakys/show?id={{$v->sid}}">查看</a>
                  @else
                  <a href="/admin/shakys/create?id={{$v->id}}&sid={{$ids}}">加入活动</a>
                  @endif
                 </td>
               </tr>
                 @empty
                 @endforelse
          </table>
          <aside class="paging">
         {{$shop->links()}}

          </aside>
     </div>
</section>

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