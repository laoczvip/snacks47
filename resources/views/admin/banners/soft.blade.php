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
       <h2 class="fl">会员列表</h2>
       <a href="/admin/banners" style="text-decoration:none" class="fr top_rt_btn add_icon">添加新会员</a>
      </div>
      <form action="admin/index" method="get">
      <section class="mtb">
         <select class="select">
            <option>会员等级</option>
            <option>普通会员</option>
            <option>高级会员</option>
         </select>
         <input type="text" name="name" class="textbox textbox_225" placeholder="输入会员号/手机/电子邮件查询..."/>
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
           @foreach($del_banners as $k=>$v)
        <tr>

            <td class="center" style="line-height:50px"><img src="/uploads/{{ $v->url }}" width="50" height="50"/></td>
            <td>{{$v->title}}</td>
            <td class="center" style="line-height:50px">{{$v->desc}}</td>
            <td class="hides" style="line-height:50px" title="{{$v->jump}}">{{$v->jump}}</td>
            <td class="center" style="line-height:50px">{{$v->created_at}}</td>
            <td style="line-height:50px">
                  @if($v->status == 0)
                  <kbd>未激活</kbd>
                  @else
                  <kbd style="background: green";>激活</kbd>
                  @endif
                </td>
            <td class="center" style="line-height:50px">
                 <a href="/admin/banners/huifu/{{ $v->id }}" style="color: black" class="btn btn-info">恢复</a>
                  <a href="/admin/banners/delete_data/{{ $v->id }}" style="color: white";  class="btn btn-danger" >永久删除</a>
                 <!-- <a href="#" title="删除" class="link_icon">&#100;</a> -->

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
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
</section>

@endsection