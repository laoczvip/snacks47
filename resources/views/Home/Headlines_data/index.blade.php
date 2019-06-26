<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
        <title>头条详情</title>
        <link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
        <link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
        <link href="/h/css/personal.css" rel="stylesheet" type="text/css">
        <link href="/h/css/infstyle.css" rel="stylesheet" type="text/css">
        <script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="/h/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>
    <link rel="icon" href="/uploads/{{ $weds->icon }}"/>
    </head>
    <body>
        <!--头 -->
        @include('home.public.hmtop')

            <div class="clear"></div>
          </div>
        </div>
      </article>
    </header>
            <div class="nav-table">
             <div class="long-title"><span class="all-goods">全部分类</span></div>
             <div class="nav-cont">
              <ul>
                <li class="index"><a href="#">首页</a></li>
                                <li class="qc"><a href="#">闪购</a></li>
                                <li class="qc"><a href="#">限时抢</a></li>
                                <li class="qc"><a href="#">团购</a></li>
                                <li class="qc last"><a href="#">大包装</a></li>
              </ul>
                <div class="nav-extra">
                  <i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
                  <i class="am-icon-angle-right" style="padding-left: 10px;"></i>
                </div>
            </div>
      </div>
      
      <b class="line"></b> 
      <div style="margin-left:70px"> 
      <ol class="am-breadcrumb am-breadcrumb-slash">
          <li><a href="#">首页>> 分类>> {{ $headlines_data->htitle }}</a></li>
          <!-- <li><a href="#">分类>></a></li>
          <li><a href="#">{{ $headlines_data->htitle }}</li> -->
      </ol>
      </div>
<!--文章 -->
<div class="am-g am-g-fixed blog-g-fixed bloglist">
  <div class="am-u-md-9">
    <article class="blog-main">
      <h3 class="am-article-title blog-title">
        <a href="#" style="font-size: 35px">{{ $headlines_data->htitle}}</a>
      </h3>
      <h4 class="am-article-meta blog-meta">作者:&nbsp;{{ $headlines_data->auth}}&nbsp;&nbsp;&nbsp;{{ $headlines_data->created_at}}</h4>

      <div class="am-g blog-content">
        <div class="am-u-sm-12">
          <p>{!! $headlines_data->hcontent !!}！</p>
          
          

        </div>
  
      </div>

    </article>


    <hr class="am-article-divider blog-hr">
    <ul class="am-pagination blog-pagination">
      @if($article_prev)
      <li class="am-pagination-prev"><a href="/home/headlines_data/index?id={{ $article_prev->id }}">&laquo; 上一篇</a></li>
      @endif
      
      @if($article_next)
      <li class="am-pagination-next"><a href="/home/headlines_data/index?id={{ $article_next->id }}">下一篇 &raquo;</a></li>
      @endif
    </ul>
  </div>

  <div class="am-u-md-3 blog-sidebar">
    <div class="am-panel-group">

      <section class="am-panel am-panel-default">
        <div class="am-panel-hd">热门话题</div> 
        <ul class="am-list blog-list">
        @foreach($datas as $k=>$v)
          <li><a href="/home/headlines_data/index?id={{ $v->id }}"><p>[公告]{{ $v->htitle}}</p></a></li>  
        @endforeach     
        </ul>
      </section>

    </div>
  </div>

</div>

@include('home.public.footer')


<script src="AmazeUI-2.4.2/assets/js/jquery.min.js"></script>

<script src="AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>

</body>
</html>
