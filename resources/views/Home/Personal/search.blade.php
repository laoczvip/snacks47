<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link href="/bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>搜索页面</title>
		<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />
		<link href="/h/basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="/h/css/seastyle.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="/bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/h/basic/js/jquery-1.7.min.js"></script>
		<script type="text/javascript" src="/h/js/script.js"></script>
	</head>

	<body>

		<!--顶部导航条 -->
		@include('home.public.hmtop')

			<div class="clear"></div>
			<b class="line"></b>
           <div class="search">
			<div class="search-list">
			<div class="nav-table">
                <div class="long-title"><span class="all-goods">全部分类</span></div>
                 <div class="nav-cont">
                      <ul>
                            <li class="index"><a href="/index.php">首页</a></li>
                      </ul>
                </div>
            </div>


					<div class="am-g am-g-fixed">
						<div class="am-u-sm-12 am-u-md-12">
	                  	<div class="theme-popover">
	                  	<br>
	                  	<br>
							<ul class="select">
								<p class="title font-normal">
									<span class="fl">松子</span>
									<span class="total fl">搜索到<strong class="num">{{$num}}</strong>件相关商品</span>
								</p>
								<div class="clear"></div>
								<li class="select-result">
									<dl>
										<dt>已选</dt>
										<dd class="select-no"></dd>
										<p class="eliminateCriteria">清除</p>
									</dl>
								</li>
								<div class="clear"></div>

							</ul>
							<div class="clear"></div>
                        </div>
							<div class="search-content" style="width:100%">
								<div class="sort">
									<li class="first" ><a title="综合" href="/home/personal/search?title=">综合排序</a></li>
									<li><a title="销量" href="/home/personal/search?buy=1">销量排序</a></li>
									<li><a title="价格" href="/home/personal/search?price=1">价格优先</a></li>
									<li class="big"><a title="评价" href="/home/personal/search?assess=1">评价为主</a></li>
								</div>
								<div class="clear"></div>

								<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes" >
								@forelse($goods_all as $good_child)
									<li>
										<div class="i-pic limit">
											<a href="/home/personal/introduction?ids={{$good_child->gid}}"><img src="/uploads/{{$good_child->showcase}}" style="height:209px;"/></a>
											<p class="title fl">{{$good_child->title}}</p>
											<p class="price fl">
												<b>¥</b>
												<strong>{{$good_child->price}}</strong>
											</p>
											<p class="number fl">
												销量<span>{{$good_child->buy}}</span>
											</p>
										</div>
									</li>
								@empty
								<div style="text-align:center; margin:20px auto;">---暂无资源----</div>
								@endforelse
								</ul>

							</div>


							<!--分页 -->
						<nav aria-label="Page navigation">
							<aside>
								{{$goods_all->appends(['id'=>$id])->links()}}
							</aside>
						</nav>
						</div>
					</div>
				@include('home.public.footer')

			</div>

		<!--引导 -->
		<div class="navCir">
			<li><a href="/h/home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="/h/sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="/h/shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>
			<li><a href="/h/person/index.html"><i class="am-icon-user"></i>我的</a></li>
		</div>

		<!--菜单 -->
    @include('home.public.tip')

		<script>
			window.jQuery || document.write('<script src="/h/basic/js/jquery-1.9.min.js"><\/script>');
		</script>
		<script type="text/javascript" src="/h/basic/js/quick_links.js"></script>

<div class="theme-popover-mask"></div>

	</body>

</html>