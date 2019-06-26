@extends('admin.index.index')

@section('center')
    <section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">友情链接列表</h2>
       <a href="/admin/friendly/create" class="fr top_rt_btn add_icon">添加新链接</a>
      </div>
      <form action="friendly" method="get">
      <section class="mtb">
         <input type="text" name="find" class="textbox textbox_225" placeholder="输入链接名称查询..." autocomplete="Off"/>
         <input type="submit" value="查询" class="group_btn"/>
      </section>
      </form>
      <table class="table">
      
           <tr>
                <th style="text-align:center;">Id</th>
                <th style="text-align:center;">展示图</th>
                <th style="text-align:center;">链接名称</th>
                <th style="text-align:center;">跳转地址</th>
                <th style="text-align:center;">添加时间</th>
                <th style="text-align:center;">状态</th>
                <th style="text-align:center;">操作</th>
           </tr>

           @foreach($friendly as $k=>$v)
            <tr>
                <th style="text-align:center;vertical-align:middle;font-size:15px;">{{ $v->id }}</th>
                <th style="text-align:center;vertical-align:middle;">
                  <img src="/uploads/{{ $v->limg }}" width="120" height="50">
                </th>
                <th style="text-align:center;vertical-align:middle;">{{ $v->lname }}</th>
                <th style="text-align:center;vertical-align:middle;">{{ $v->lurl }}</th>
                <th style="text-align:center;vertical-align:middle;">{{ $v->created_at }}</th>
                <th style="text-align:center;vertical-align:middle;">
                  @if( $v->lstatus == 0 )
                    <kbd style="background:red;">关闭</kbd>
                  @else
                    <kbd style="background:green;">激活</kbd>
                  @endif
                </th>
                <td style="text-align:center;vertical-align:middle;font-size:20px;">
                  <a href="/admin/friendly/{{ $v->id }}/edit" title="编辑" class="link_icon">&#101;</a>
                  <a href="javascript:;" title="删除" class="link_icon" onclick="del({{ $v->id }},this)">&#100;</a>

                  @if($v->lstatus == 0)
                    <a href="javascript:;" class="btn btn-success" style="color:white" onclick="ChangeStatus({{ $v->id }},0)">激活</a>
                  @else
                    <a href="javascript:;" class="btn btn-danger" style="color:white" onclick="ChangeStatus({{ $v->id }},1)">关闭</a>
                  @endif

                </td>
           </tr>
           @endforeach
           
      </table>

      <script type="text/javascript">
              // 删除
              function del(id,obj){
                
                if(!window.confirm('你确定要删除吗?')){
                  return false;
                }

                $.get('/admin/friendly/destroy',{id:id},function(res){
                  // console.log(id);
                  if(res == 'ok'){
                    // 删除tr节点
                    $(obj).parent().parent().remove();
                  }else{
                    alert('删除失败');
                  }
                },'html');

              }

              function ChangeStatus(id,sta)
              {
                if(sta == 1){
                  $('#myModal form input[type=radio]').eq(1).attr('checked',true);
                }else{
                  $('#myModal form input[type=radio]').eq(0).attr('checked',true);
                }
                // 赋值
                $('#myModal form input[type=hidden]').eq(0).val(id);
                $('#myModal').modal('show')
              }
            </script>

      <aside class="paging">
            <!-- 分页 -->
           {{ $friendly->appends($params)->links() }}
      </aside>
 </div>
 <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">轮播图状态</h4>
      </div>
      <div class="modal-body">
        <form action="/admin/friendly/ChangeStatus" method="get">
          <input type="hidden" name="id" value="">
        <div class="form-group"> 
          <br>
          关闭:<input type="radio" name="lstatus" value="0">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          激活:<input type="radio" name="lstatus" value="1">
        </div> 
        <input type="submit" class="btn btn-success">
        </form>
      </div>
     </div>
  </div>
</div>
</section>

@endsection