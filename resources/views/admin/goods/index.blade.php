@extends('admin.index.index')

@section('center')

<section class="rt_wrap content mCustomScrollbar">
     <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">商品列表</h2>
      </div>
        <form action="/admin/goods/index" method="get">
          <section class="mtb">
             <select class="select" name="cid" id="test" onchange="tt(this.id)">
                  @forelse($cates as $k=>$v)
                  @if($v->pid==0)
                  <option value="0" disabled="disabled">{{$v->title}}</option>
                  @else

                  <option value="{{$v->id}}">{{$v->title}}</option>
                  @endif
                  @empty
                  @endforelse
                  <option value="0">----手动输入----</option>
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
          <table class="table" >

               <tr >
                    <th class="center">商品Id</th>
                    <th class="center">商品类</th>
                    <th class="center">商品名称</th>
                    <th class="center">展示图</th>
                    <th class="center">商品属性</th>
                    <th class="center">商品价格</th>
                    <th class="center">商品库存</th>
                   <!--  <th style="width:60px;">商品重量</th> -->
                    <th class="center">商品销量</th>
                    <th class="center">商品状态</th>
                    <th class="center">创建时间</th>
                    <th class="center">操作</th>
               </tr>
               @forelse($goods_sku as $k=>$v)
               <tr>
                 <td class="center">{{$v->id}}</td>
                 <td class="center">{{$cates_name[$v->cid]}}</td>
                 <td  class="center" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap; ">{{$v->title}}</td>
                 <td class="center"><img src="/uploads/{{$v->showcase}}" style="width:150px;" class="img-thumbnail"></td>

                 <td class="center">
                  @forelse($flavour_data[$v->touch] as $val)
                  <kbd style="background:green">{{$val}}</kbd>
                  </br>
                  @empty
                  @endforelse

                  </td>
                 <td class="center">{{$v->price}}</td>
                 <td class="center">{{$v->stock}}</td>

                 <td class="center">{{$v->buy}}</td>
                 <td class="center">
                 @if($v->status==0)
                    <kbd>上架中...</kbd>
                 @elseif($v->status==1)
                    <kbd>已下架</kbd>
                 @else
                    <kbd>已删除</kbd>
                 @endif
                 </td>
                 <td class="center">{{$v->created_at}}</td>
                  <td class="template" style="display:none;">
                  <span>{{ $v->title }}</span>
                  <div>{!! $v->desc !!}</div>
            </td >
                 <td >
                   <a href="/admin/goods/edit?id={{$v->cid}}" class="link_icon" title="修改">&#101;</a>
                   <a href="javascript:;"  onclick="del({{$v->id}},this)" class="link_icon" title="删除">&#100;</a>
                   <a href="javascript:;" onclick="shows(this)"  class="link_icon" title="查看详情">&#118;</a>
                 </td>
               </tr>
               @empty
               @endforelse
          </table>
          <aside class="paging">

              {{$goods_sku->appends(['cid'=>$cid,'name'=>$name])->links()}}

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
    <script type="text/javascript">
              function shows(obj){

                //  获取标题
                let title = $(obj).parents('tr').find('span').html();

                let desc = $(obj).parents('tr').find('div').html();
                // 赋值
                $('#myModal .modal-title').html(title);
                $('#myModal .modal-body').html(desc);

                // 显示模态框
                $('#myModal').modal('show')
              }
            </script>



        <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">文章状态</h4>
                    </div>
                    <div class="modal-body">

                    </div>
                  </div>
                </div>
            </div>
@endsection