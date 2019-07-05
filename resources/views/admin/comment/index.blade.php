@extends('admin.index.index')

@section('center')
<style type="text/css">
    .center{
      overflow:hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }
</style>
    <section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">评论列表</h2>
      </div>
      <form action="" method="get">
      <section class="mtb">
         <input type="text" name="find" class="textbox textbox_225" placeholder="请输入要查找的评论内容..." autocomplete="Off"/>
         <input type="submit" value="查询" class="group_btn"/>
      </section>
      </form>
      <table class="table">

           <tr>
                <th class="center">Id</th>
                <th class="center">评论商品</th>
                <th class="center">评论用户</th>
                <th class="center">评论内容</th>
                <th class="center">评论等级</th>
                <th class="center">添加时间</th>
           </tr>

           @foreach($comment as $k=>$v)
           <tr>
                <td class="center">{{ $v->id }}</td>
                <td class="center">{{ $goods_sku[$v->gid] }}</td>
                <td class="center">{{ $list[$v->uid] }}</td>
                <td class="center">{!! $v->content !!}</td>
                <td class="center">
                  @if( $v->rank == 1 )
                    <kbd style="background:red;">好评</kbd>
                  @elseif($v->rank == 2)
                    <kbd style="background:green;">中评</kbd>
                  @else
                    <kbd style="background:#ccc">差评</kbd>
                  @endif
                </td>
                <th class="center">{{ $v->created_at }}</th>
           </tr>
           @endforeach

      </table>


      <aside class="paging">
            <!-- 分页 -->
           {{ $comment->appends($params)->links() }}
      </aside>
 </div>

</section>

@endsection