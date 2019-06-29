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
	        @include('home.public.hmtop')
			<div class="clear"></div>
			<b class="line"></b>
           <div class="search">
			<div class="search-list">
			<div class="nav-table">
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="/h/#">首页</a></li>
                                <li class="qc"><a href="/h/#">闪购</a></li>
                                <li class="qc"><a href="/h/#">限时抢</a></li>
                                <li class="qc"><a href="/h/#">团购</a></li>
                                <li class="qc last"><a href="/h/#">大包装</a></li>
							</ul>
						    <div class="nav-extra">
						    	<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
						    	<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
						    </div>
						</div>
			</div>


					<div class="am-g am-g-fixed">
						<div class="am-u-sm-12 am-u-md-12">
	                  	<div class="theme-popover">
							<div class="searchAbout">
								<span class="font-pale">相关搜索：</span>
								<a title="坚果" href="/h/#">坚果</a>
								<a title="瓜子" href="/h/#">瓜子</a>
								<a title="鸡腿" href="/h/#">豆干</a>

							</div>
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
								<li class="select-list">
									<dl id="select1">
										<dt class="am-badge am-round">品牌</dt>

										 <div class="dd-conent">
											<dd class="select-all selected"><a href="/h/#">全部</a></dd>
											<dd><a href="/h/#">百草味</a></dd>
											<dd><a href="/h/#">良品铺子</a></dd>
											<dd><a href="/h/#">新农哥</a></dd>
											<dd><a href="/h/#">楼兰蜜语</a></dd>
											<dd><a href="/h/#">口水娃</a></dd>
											<dd><a href="/h/#">考拉兄弟</a></dd>
										 </div>

									</dl>
								</li>
								<li class="select-list">
									<dl id="select2">
										<dt class="am-badge am-round">种类</dt>
										<div class="dd-conent">
											<dd class="select-all selected"><a href="/h/#">全部</a></dd>
											<dd><a href="/h/#">东北松子</a></dd>
											<dd><a href="/h/#">巴西松子</a></dd>
											<dd><a href="/h/#">夏威夷果</a></dd>
											<dd><a href="/h/#">松子</a></dd>
										</div>
									</dl>
								</li>
								<li class="select-list">
									<dl id="select3">
										<dt class="am-badge am-round">选购热点</dt>
										<div class="dd-conent">
											<dd class="select-all selected"><a href="/h/#">全部</a></dd>
											<dd><a href="/h/#">手剥松子</a></dd>
											<dd><a href="/h/#">薄壳松子</a></dd>
											<dd><a href="/h/#">进口零食</a></dd>
											<dd><a href="/h/#">有机零食</a></dd>
										</div>
									</dl>
								</li>

							</ul>
							<div class="clear"></div>
                        </div>
							<div class="search-content">
								<div class="sort">
									<li class="first"><a title="综合">综合排序</a></li>
									<li><a title="销量">销量排序</a></li>
									<li><a title="价格">价格优先</a></li>
									<li class="big"><a title="评价" href="/h/#">评价为主</a></li>
								</div>
								<div class="clear"></div>

								<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
								@forelse($goods_all as $good_child)
									<li>
										<div class="i-pic limit">
											<a href="/home/personal/introduction?id={{$good_child->gid}}&cid={{$good_child->cid}}"><img src="/uploads/{{$good_child->showcase}}" /></a>
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
								@endforelse
								</ul>

							</div>

							<div class="search-side">

								<div class="side-title">
									经典搭配
								</div>

								<li>
									<div class="i-pic check">
										<img src="/h/images/cp.jpg" />
										<p class="check-title">萨拉米 1+1小鸡腿</p>
										<p class="price fl">
											<b>¥</b>
											<strong>29.90</strong>
										</p>
										<p class="number fl">
											销量<span>1110</span>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic check">
										<img src="/h/images/cp2.jpg" />
										<p class="check-title">ZEK 原味海苔</p>
										<p class="price fl">
											<b>¥</b>
											<strong>8.90</strong>
										</p>
										<p class="number fl">
											销量<span>1110</span>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic check">
										<img src="/h/images/cp.jpg" />
										<p class="check-title">萨拉米 1+1小鸡腿</p>
										<p class="price fl">
											<b>¥</b>
											<strong>29.90</strong>
										</p>
										<p class="number fl">
											销量<span>1110</span>
										</p>
									</div>
								</li>


							</div>
<nav aria-label="Page navigation">
							<!--分页 -->

								{{$goods_all->appends(['id'=>$id])->links()}}
							</aside>
</nav>
						</div>
					</div>
        @include('home.public.footer')

				</div>

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