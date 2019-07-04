<!DOCTYPE html>
<html>
    <head>

    <style type="text/css">
    .hides {
      overflow:hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      height:250px;/*需要配合宽度来使用*/
    }
    </style>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
        <title>头条列表</title>
        <link href="/bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
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
     

<div class="am-g am-g-fixed blog-g-fixed bloglist">
  <div class="am-u-md-9" >
    <article class="blog-main">
    @foreach($data as $k=>$v)
    <div style="float:left; width:250px;height:200px;margin-left:-70px;">
      <a href="/home/headlines_data/index?id={{ $v->id }}"><img style="width:250px;height:200px;"
      src="/uploads/{{ $v->thumb}}"</a>
    </div>
    <div class="hides" style="float:left; width:560px;height:35px;margin-left:20px;">
      <a href="/home/headlines_data/index?id={{ $v->id }}" style="font-size:25px;color:black;">{{ $v->htitle }}</a>
    </div> 
    <div class="hides" style="float:left; width:560px;height:25px;margin-left:20px;">
      <a></a><a style="padding-left:340px;font-size:13px;color:#868686;"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;{{ $v->auth }}&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-time" aria-hidden="true"></span>&nbsp;{{ $v->created_at }}</a>
    </div>
   <div class="hides" style="font-size:15px;float:left; width:560px;height:118px;margin-left:20px;margin-top:8px;margin-bottom:50px;">
      <a href="/home/headlines_data/index?id={{ $v->id }}" class="hides" style="color:black;">{!! $v->hcontent !!}</a>
    </div>
    
    @endforeach
    
    <hr class="am-article-divider blog-hr">
    <div style="width:100px;height:35px;margin-top: 20px;margin-left: 450px">
      <nav aria-label="Page navigation">
        <aside>
            {{ $data->links() }}
        </aside>
      </nav>
    </div>
  </div>
  


  <div class="am-u-md-3 blog-sidebar">
    <div class="am-panel-group">

      <section class="am-panel am-panel-default">
        <div style="color: black" class="am-panel-hd">热门话题 <a style="font-size:15px;color: #868686;padding-left: 140px"; href="/home/headlines_data/list">更多...</a></div> 
        <ul class="am-list blog-list">
        @foreach($datas as $k=>$v) 
          <li><a href="/home/headlines_data/index?id={{ $v->id }}"><p>{{ $v->htitle }}</p></a></li> 

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
