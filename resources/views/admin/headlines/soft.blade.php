@extends('admin.index.index')

@section('center')
    <section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">会员列表</h2>
       <a href="/admin/banners" class="fr top_rt_btn add_icon">添加新会员</a>
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
                
               
                <th style="text-align:center;">头条标题</th>
                <th style="text-align:center;">头条作者</th>
                <th style="text-align:center;">头条内容</th>
                <th style="text-align:center;">操作</th>
           </tr>
           @foreach($del_headlines as $k=>$v)
        <tr>
            
            
            <td>{{$v->htitle}}</td>
            <td class="center">{{$v->auth}}</td>
            
           <td>
            <!-- <td class="center">{{ $v->hcontent }}</td> -->
            <a href="javascript:;" style="color:white"; class="btn btn-primary" onclick="shows(this)">查看文章内容</a>
           </td>
           <td class="template" style="display:none;">
             <span>{{ $v->htitle }}</span>
                    
             <div>{!! $v->hcontent !!}</div>
           </td>
            
            <td class="center">
                 <a href="/admin/headlines/huifu/{{ $v->id }}" style="color: black" class="btn btn-info">恢复</a>
                  <a href="/admin/headlines/delete_data/{{ $v->id }}" style="color: white";  class="btn btn-danger" >永久删除</a>
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
              function shows(obj){
                //  获取标题
                let htitle = $(obj).parent().next().find('span').first().html();
                let hcontent = $(obj).parent().next().find('div').first().html();

                // 赋值
                $('#myModal .modal-title').html(htitle);
                $('#myModal .modal-body').html(hcontent);

                // 显示模态框
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
                       
                     <input type="submit" class="btn btn-success">
                      </form>
                    </div>
                    
                    
                  </div>
                </div>
              </div>
</section>

@endsection