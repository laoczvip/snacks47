@extends('admin.index.index')

@section('center')

<section class="rt_wrap content mCustomScrollbar">
     <div class="rt_content">
        <form action="/admin/goods/index" method="get">
         
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
          <table class="table" style="text-align:center;">
          
               <tr >
                    <th style="width:100px;">商品Id</th>
                    <th style="width:100px;">商品类</th>
                    <th style="width:100px; ">商品名称</th>
                    <th style="width:100px;">展示图</th>
                    <th style="width:100px;">商品属性</th>
                    <th style="width:60px;">商品价格</th>
                    <th style="width:60px;">商品库存</th>
                    <th style="width:60px;">商品重量</th>
                    <th style="width:60px;">商品销量</th>
                    <th style="width:100px;">商品状态</th>
                    <th>创建时间</th>
                    <th>操作</th>
               </tr>
                 
               <tr>

                 <td>

                 </td>
               </tr>
            
          </table>         
          <aside class="paging">
         
        
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
    function del(id,obj){
        var sub = confirm('您确认要删除此商品吗？');
        if(sub){
           $.get('/admin/goods/del',{id},function(res){
            if(res=='ok'){
                alert('删除成功');
                $(obj).parent().parent().remove();
            }else if(res=='err') {
          alert('删除失败');
        }
        },'json')
        } 
       
    }
</script>

@endsection