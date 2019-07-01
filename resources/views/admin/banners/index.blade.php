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
        <h2 class="fl">轮播图列表</h2>
        <a href="/admin/banners" class="fr top_rt_btn add_icon">添加新轮播图</a>
      </div>
      <form action="/admin/banners" method="get">
        <section class="mtb">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="search" value="{{ $search }}" class="textbox textbox_225" placeholder="输入头条标题查询..."/>
          <input type="submit" value="查询" class="group_btn"/>
        </section>
      </form>
      <table class="table" style="text-align:center;">
           <tr>
              <th style="text-align:center;">轮播图</th>
              <th style="text-align:center;">轮播图标题</th>
              <th style="text-align:center;">轮播图描述</th>
              <th style="text-align:center;">轮播图跳转的地址</th>
              <th style="text-align:center;">创建时间</th>
              <th style="text-align:center;">状态</th>
              <th style="text-align:center;">操作</th>
           </tr>
           @foreach($banners as $k=>$v)
           <tr>
              <td class="center"><img src="/uploads/{{ $v->url }}" width="150" height="100" /></td>
              <td><p>{{$v->title}}</td>
              <td><p class="hides">{{$v->desc}}</p></td>
              <td><p class="hides" title="{{$v->jump}}">{{$v->jump}}</p></td>
              <td class="center">{{$v->created_at}}</td>
              <td>
                  @if($v->status == 0)
                  <kbd>未激活</kbd>
                  @else
                  <kbd style="background: green;">已激活</kbd>
                  @endif
                </td>
              <td class="center">
                  <a href="/admin/banners/{{$v->id}}/edit" title="编辑" class="link_icon">&#101;</a>
                  <a href="javascript:;" title="删除" class="link_icon" onclick="del({{ $v->id }},this)">&#100;</a>
                 @if($v->status == 0)
                 <a href="javascript:;" class="btn btn-success" style="color:white;" onclick="changeStatus({{ $v->id }},0)">激活</a>
                 @else
                  <a href="javascript:;" class="btn btn-primary" style="color:#fff;" onclick="changeStatus({{ $v->id }},1)">停止</a>
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

              $.get('/admin/banners/delete',{id:id},function(res){
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
        <aside class="paging">

        </aside>
      </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">轮播图状态</h4>
              </div>
              <div class="modal-body">
                <form action="/admin/banners/changeStatus" method="get">
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
         {{ $banners->appends(['search'=>$search])->links() }}
</section>

@endsection