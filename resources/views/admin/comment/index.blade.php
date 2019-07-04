@extends('admin.index.index')

@section('center')
    <section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">评论列表</h2>
      </div>
      <form action="friendly" method="get">
      <section class="mtb">
         <input type="text" name="find" class="textbox textbox_225" placeholder="查询..." autocomplete="Off"/>
         <input type="submit" value="查询" class="group_btn"/>
      </section>
      </form>
      <table class="table">
      
           <tr>
                <th style="text-align:center;">Id</th>
                <th style="text-align:center;">评论商品</th>
                <th style="text-align:center;">评论用户</th>
                <th style="text-align:center;">评论内容</th>
                <th style="text-align:center;">评论等级</th>
                <th style="text-align:center;">添加时间</th>
           </tr>

           @foreach($comment as $k=>$v)
           <tr>
                <th style="text-align:center;vertical-align:middle;">{{ $v->id }}</th>
                <th style="text-align:center;vertical-align:middle;">{{ $goods_sku[$v->gid] }}</th>
                <th style="text-align:center;vertical-align:middle;">{{ $list[$v->uid] }}</th>
                <th style="text-align:center;vertical-align:middle;">{!! $v->content !!}</th>
                <th style="text-align:center;vertical-align:middle;">
                  @if( $v->rank == 1 )
                    <kbd style="background:red;">好评</kbd>
                  @elseif($v->rank == 2)
                    <kbd style="background:green;">中评</kbd>
                  @else
                    <kbd style="background:#ccc">差评</kbd>
                  @endif
                </th>
                <th style="text-align:center;vertical-align:middle;">{{ $v->created_at }}</th>
           </tr>
           @endforeach

      </table>

      
      <aside class="paging">
            <!-- 分页 -->
           {{$comment->links()}}
      </aside>
 </div>

</section>

@endsection