@extends('admin.index.index')

@section('center')
<style type="text/css">
		.hides{
			overflow:hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
		}
</style>
    <section class="rt_wrap content mCustomScrollbar">
      <div class="rt_content">
        <div class="page_title">
          <h2 class="fl">头条列表</h2>
          <a href="/admin/headlines/create" class="fr top_rt_btn add_icon">添加头条</a>
        </div>
      <form action="/admin/headlines" method="get">
        <section class="mtb">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="search" value="{{ $search }}" style="height:38px;" class="textbox textbox_225" placeholder="头条标题查询..."/>
          <input type="submit" value="查询" class="group_btn"/>
        </section>
      </form>
      <table class="table" style="text-align:center;">
        <tr>
            <th style="text-align:center;">头条标题</th>
            <th style="text-align:center;">头条作者</th>
            <th style="text-align:center;">头条内容</th>
            <th style="text-align:center;">缩略图</th>
            <th style="text-align:center;">状态</th>
            <th style="text-align:center;">操作</th>
        </tr>
           @foreach($headlines as $k=>$v)
        <tr>
            <td>{{ $v->htitle }}</td>
            <td class="center">{{ $v->auth }}</td>
            <td>
              <!-- <td class="center">{{ $v->hcontent }}</td> -->
              <a href="javascript:;" style="color:white"; class="btn btn-primary" onclick="shows(this)">查看文章内容</a>
			      </td>
			      <td class="template" style="display:none;">
			      	<span>{{ $v->htitle }}</span>
			      	<div>{!! $v->hcontent !!}</div>
			      </td>
            <td class="center"><img src="/uploads/{{ $v->thumb }}" width="50" height="50"/></td>
            <td>
                  @if($v->status == 0)
                  <kbd>未激活</kbd>
                  @else
                  <kbd style="background: green";>激活</kbd>
                  @endif
                </td>
            <td class="center">
                <a href="/admin/headlines/{{$v->id}}/edit" title="编辑" class="link_icon">&#101;</a>
                <a href="javascript:;" title="删除" class="link_icon" onclick="del({{ $v->id }},this)">&#100;</a>
                 <!-- <a href="#" title="删除" class="link_icon">&#100;</a> -->
                 @if($v->status == 0)
                 <a href="javascript:;" class="btn btn-success" style="color: white" onclick="changeStatus({{ $v->id }},0)">激活</a>
                 @else
                  <a href="javascript:;" class="btn btn-primary" style="color: #fff"; onclick="changeStatus({{ $v->id }},1)">停止</a>
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

                $.get('/admin/headlines/delete',{id:id},function(res){
                  if(res == 'ok'){
                    // 删除tr节点
                    $(obj).parent().parent().remove();
                  }else{
                    alert('删除失败')
                  }
                },'html');
              }
            </script>

			<script type="text/javascript">
							function shows(obj){
								//  获取标题
								let htitle = $(obj).parent().next().find('span').first().html();
								let hcontent = $(obj).parent().next().find('div').first().html();

								// 赋值
								$('#myModals .modal-title').html(htitle);
								$('#myModals .modal-body').html(hcontent);

								// 显示模态框
								$('#myModals').modal('show')
							}
						</script>

            <script type="text/javascript">
            function changeStatus(id,sta)
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

				<!-- Modal -->
						<div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">文章状态</h4>
							      </div>
							      <div class="modal-body">
                    <form action="/admin/headlines/changeStatus" method="get">
                  <input type="hidden" name="id" value="">
                  <div class="form-group">
                  <br>
                        未开启:<input type="radio" name="status" value="0" checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        开启:<input type="radio" name="status" value="1">
                  </div>
                  <input type="submit" class="btn btn-success">
                </form>
							      </div>
							    </div>
							  </div>
						</div>

            <!-- Modal 查看文章-->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">文章状态</h4>
                    </div>
                    <div class="modal-body">
                    <form action="/admin/headlines/changeStatus" method="get">
                  <input type="hidden" name="id" value="">
                  <div class="form-group">
                  <br>
                        未开启:<input type="radio" name="status" value="0" checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        开启:<input type="radio" name="status" value="1">
                  </div>
                  <input type="submit" class="btn btn-success">
                </form>
                    </div>
                  </div>
                </div>
            </div>

            
      <!-- 显示页码 -->
      <aside class="paging">
        {{ $headlines->appends(['search'=>$search])->links() }}
      </aside>
    </div>
  </section>
@endsection