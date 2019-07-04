<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>商品页面</title>
		<link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />
		<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/h/basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link type="text/css" href="/h/css/optstyle.css" rel="stylesheet" />
		<link type="text/css" href="/h/css/style.css" rel="stylesheet" />
		<script type="text/javascript" src="/h/basic/js/jquery-1.7.min.js"></script>
		<script type="text/javascript" src="/h/basic/js/quick_links.js"></script>
		<script type="text/javascript" src="/h/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
		<script type="text/javascript" src="/h/js/jquery.imagezoom.min.js"></script>
		<script type="text/javascript" src="/h/js/jquery.flexslider.js"></script>
		<style type="text/css">
			.des_share .d_care {
				background: url(/h/images/care.png) no-repeat left center;
				padding-left: 22px;
			}
		</style>
		<script type="text/javascript" src="/h/js/list.js"></script>
    	<link rel="icon" href="/uploads/{{ $weds->icon }}"/>
	</head>

	<body>
	@include('home.public.hmtop')


            <b class="line"></b>
			<div class="listMain">

	<body>
				<!--分类-->
			<div class="nav-table">
                <div class="long-title"><span class="all-goods">全部分类</span></div>
                 <div class="nav-cont">
                      <ul>
                            <li class="index"><a href="/index.php">首页</a></li>
                      </ul>
                </div>
            </div>
				<ol class="am-breadcrumb am-breadcrumb-slash">
					<li><a href="/h/#">首页</a></li>
					<li><a href="/h/#">分类</a></li>
					<li class="am-active">内容</li>
				</ol>
				<script type="text/javascript">
					$(function() {});
					$(window).load(function() {
						$('.flexslider').flexslider({
							animation: "slide",
							start: function(slider) {
								$('body').removeClass('loading');
							}
						});
					});
				</script>
				<div class="scoll">
					<section class="slider">
						<div class="flexslider">
							<ul class="slides">
								<li>
									<img src="/h/images/01.jpg" title="pic" />
								</li>
								<li>
									<img src="/h/images/02.jpg" />
								</li>
								<li>
									<img src="/h/images/03.jpg" />
								</li>
							</ul>
						</div>
					</section>
				</div>

				<!--放大镜-->

				<div class="item-inform">
					<div class="clearfixLeft" id="clearcontent">

						<div class="box">
							<script type="text/javascript">
								$(document).ready(function() {
									$(".jqzoom").imagezoom();
									$("#thumblist li a").click(function() {
										$(this).parents("li").addClass("tb-selected").siblings().removeClass("tb-selected");
										$(".jqzoom").attr('src', $(this).find("img").attr("mid"));
										$(".jqzoom").attr('rel', $(this).find("img").attr("big"));
									});
								});
							</script>

							<div class="tb-booth tb-pic tb-s310">
								<a href="/uploads/{{$goods_sku->showcase}}"><img src="/uploads/{{$goods_sku->showcase}}" alt="细节展示放大镜特效" rel="/uploads/{{$goods_sku->showcase}}" class="jqzoom" /></a>
							</div>

						</div>

						<div class="clear"></div>
					</div>

					<div class="clearfixRight">

						<!--规格属性-->
						<!--名称-->
						<div class="tb-detail-hd">
							<h1>
				{{$goods_sku->title}}

	          </h1>

						</div>
						<div class="tb-detail-list">
							<!--价格-->
							<div class="tb-detail-price">
							@if($shaky_sku)
								<li class="price iteminfo_price">
									<dt>促销价</dt>
									<dd><em>¥</em><b class="sys_item_price">{{$shaky_sku->original-$shaky_sku->preferential}}</b>  </dd>
								</li>
							@else
							<li class="price iteminfo_price">
									<dt>促销价</dt>
									<dd><em>¥</em><b class="sys_item_price">{{$goods_sku->price}}</b>  </dd>
								</li>
							@endif
								@if($shaky_sku)
								<li class="price iteminfo_mktprice">
									<dt>原价</dt>
									<dd><em>¥</em><b class="sys_item_mktprice">{{$shaky_sku->original}}</b></dd>
								</li>
								@endif
								<div class="clear"></div>
							</div>
							<br>
							<br>
							<div class="clear"></div>
							<!--销量-->
							<ul class="tm-ind-panel">
								<li class="tm-ind-item tm-ind-sellCount canClick">
									<div class="tm-indcon"><span class="tm-label">月销量</span><span class="tm-count">1015</span></div>
								</li>
								<li class="tm-ind-item tm-ind-sumCount canClick">
									<div class="tm-indcon"><span class="tm-label">累计销量</span><span class="tm-count">{{$goods_sku->buy}}</span></div>
								</li>
								<li class="tm-ind-item tm-ind-reviewCount canClick tm-line3">
									<div class="tm-indcon"><span class="tm-label">累计评价</span><span class="tm-count">640</span></div>
								</li>
								<li class="tm-ind-item tm-ind-reviewCount canClick tm-line3">
									<div class="des_share" style="width:82px;margin-left:35px;"
									 >
							        <div class="d_care" >

							        @if(in_array($goods_sku->gid,$collect))
							            	<p id="asdas" onclick="del({{$goods_sku->gid}})">取消收藏</p>
									@else
							            <a id="shouc" onclick="ShowDiv({{ $goods_sku->gid }})">收藏</a>
									@endif

							        </div>
							    </div>
								</li>
								<!-- 获取当前URL -->
								<input type="hidden" id="url" value="{{$_SERVER['REQUEST_URI']}}">
							</ul>
							<div class="clear"></div>

							<!--各种规格-->
							<dl class="iteminfo_parameter sys_item_specpara">
								<dt class="theme-login"><div class="cart-title">可选规格<span class="am-icon-angle-right"></span></div></dt>
								<dd>
									<!--操作页面-->

									<div class="theme-popover-mask"></div>

									<div class="theme-popover">
										<div class="theme-span"></div>
										<div class="theme-poptit">
											<a href="/h/javascript:;" title="关闭" class="close">×</a>
										</div>
										<div class="theme-popbod dform">
											<form class="theme-signin" name="loginform" action="" method="post">

												<div class="theme-signin-left">
													<div class="theme-options">
											              <div class="cart-title">口味</div>
												              <ul>


												              @forelse($list[$goods_sku->touch] as $val)
												               <li class="sku-line" onclick="kouwei(this)">{{$val}}<i></i></li>
												              @empty
												              @endforelse
											              </ul>
										             </div>
													<div class="theme-options">
														<div class="cart-title">包装</div>
														<ul>
															<li class="sku-line selected">手袋单人份<i></i></li>
															<li class="sku-line">礼盒双人份<i></i></li>
															<li class="sku-line">全家福礼包<i></i></li>
														</ul>
													</div>
													<div class="theme-options">
														<div class="cart-title number">数量</div>
														<dd>
															<input id="min" class="am-btn am-btn-default" name="" type="button" value="-" />
															<input id="text_box" name="" type="text" value="1" style="width:30px;" />
															<input id="add" class="am-btn am-btn-default" name="" type="button" value="+" />
															<span id="Stock" class="tb-hidden">库存<span class="stock">{{$goods_sku->stock}}</span>件</span>
														</dd>

													</div>
													<div class="clear"></div>

													<div class="btn-op">
														<div class="btn am-btn am-btn-warning">确认</div>
														<div class="btn close am-btn am-btn-warning">取消</div>
													</div>
												</div>
												<div class="theme-signin-right">
													<div class="img-info">
														<img src="/h/images/songzi.jpg" />
													</div>
													<div class="text-info">
														<span class="J_Price price-now">¥39.00</span>
														<span id="Stock" class="tb-hidden">库存<span class="stock">1000</span>件</span>
													</div>
												</div>

											</form>
										</div>
									</div>

								</dd>
							</dl>
							<div class="clear"></div>
							<!--活动	-->
							<div class="shopPromotion gold">
								<div class="hot">
									<dt class="tb-metatit">店铺优惠</dt>
									<div class="gold-list">
										<p>购物满2件打8折，满3件7折<span>点击领券<i class="am-icon-sort-down"></i></span></p>
									</div>
								</div>
								<div class="clear"></div>
								<div class="coupon">
									<dt class="tb-metatit">优惠券</dt>
									<div class="gold-list">
										<ul>
											<li>125减5</li>
											<li>198减10</li>
											<li>298减20</li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="pay">
							<div class="pay-opt">
							<a href="/h/home.html"><span class="am-icon-home am-icon-fw">首页</span></a>
							<a><span class="am-icon-heart am-icon-fw">收藏</span></a>

							</div>
							<li>
								<div class="clearfix tb-btn tb-btn-buy theme-login">

									<a id="LikBuy" title="点此按钮到下一步确认购买信息" href="/payment/{{$goods_sku->gid}}">立即购买</a>
								</div>
							</li>
							@if(!$shaky_sku)
							<li>
								<div class="clearfix tb-btn tb-btn-basket theme-login">
									<a id="LikBasket" title="加入购物车" onclick="add({{$goods_sku->id}})"><i></i>加入购物车</a>
								</div>
							</li>
							@endif


							<li>

							</li>
						</div>

					</div>

					<div class="clear"></div>

				</div>

				<!--优惠套装-->
				<div class="match">
					<div class="match-title">优惠套装</div>
					<div class="match-comment">
						<ul class="like_list">
							<li>
								<div class="s_picBox">
									<a class="s_pic" href="/h/#"><img src="/h/images/cp.jpg"></a>
								</div> <a class="txt" target="_blank" href="/h/#">萨拉米 1+1小鸡腿</a>
								<div class="info-box"> <span class="info-box-price">¥ 29.90</span> <span class="info-original-price">￥ 199.00</span> </div>
							</li>
							<li class="plus_icon"><i>+</i></li>
							<li>
								<div class="s_picBox">
									<a class="s_pic" href="/h/#"><img src="/h/images/cp2.jpg"></a>
								</div> <a class="txt" target="_blank" href="/h/#">ZEK 原味海苔</a>
								<div class="info-box"> <span class="info-box-price">¥ 8.90</span> <span class="info-original-price">￥ 299.00</span> </div>
							</li>
							<li class="plus_icon"><i>=</i></li>
							<li class="total_price">
								<p class="combo_price"><span class="c-title">套餐价:</span><span>￥35.00</span> </p>
								<p class="save_all">共省:<span>￥463.00</span></p> <a href="/h/#" class="buy_now">立即购买</a> </li>
							<li class="plus_icon"><i class="am-icon-angle-right"></i></li>
						</ul>
					</div>
				</div>
				<div class="clear"></div>


				<!-- introduce-->

				<div class="introduce">
					<div class="browse">
					    <div class="mc">
						     <ul>
						     	<div class="mt">
						            <h2>看了又看</h2>
					            </div>
						     	@forelse($goods_all as $good_child)
							      <li class="first">
							      	<div class="p-img">
							      		<a  href="/home/personal/introduction?id={{$good_child->gid}}&cid={{$good_child->cid}}"> <img class="" src="/uploads/{{$good_child->showcase}}"> </a>
							      	</div>
							      	<div class="p-name"><a href="/h/#">
							      		{{$good_child->title}}
							      	</a>
							      	</div>
							      	<div class="p-price"><strong>{{$good_child->price}}</strong></div>
							      </li>
							     @empty
							     @endforelse

						     </ul>
					    </div>
					</div>
					<div class="introduceMain">
						<div class="am-tabs" data-am-tabs>
							<ul class="am-avg-sm-3 am-tabs-nav am-nav am-nav-tabs">
								<li class="am-active">
									<a href="/h/#">
										<span class="index-needs-dt-txt">宝贝详情</span>
									</a>

								</li>

								<li>
									<a href="/h/#">
										<span class="index-needs-dt-txt">全部评价</span>
									</a>

								</li>
								
							</ul>

							<div class="am-tabs-bd">

								<div class="am-tab-panel am-fade am-in am-active">
									<div class="J_Brand">

										<div class="attr-list-hd tm-clear">
											<h4>产品参数：</h4></div>
										<div class="clear"></div>
										<span style="text-align: left">{!!$goods_sku->parameter!!}</span>
										<div class="clear"></div>
									</div>

									<div class="details">
										<div class="attr-list-hd after-market-hd">
											<h4>商品细节</h4>
										</div>
										<div class="twlistNews" style="
									background-size: cover;-webkit-background-size: cover;-o-background-size: cover;
									   ">
											{!!$goods_sku->desc!!}
										</div>
									</div>
									<div class="clear"></div>

								</div>

								<div class="am-tab-panel am-fade">

                                    <div class="actor-new">
                                    	<div class="rate">
                                    		<strong><span>{{$haopingdu}}%</span></strong><br> <span>好评度</span>
                                    	</div>
                                       
                                    </div>
                                    <div class="clear"></div>
									<div class="tb-r-filter-bar">
										<ul class=" tb-taglist am-avg-sm-4">
											<li class="tb-taglist-li tb-taglist-li-current">
												<div class="comment-info">
													<span>全部评价</span>
													<span class="tb-tbcr-num">({{$haoping+$zhongping+$chaping}})</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li-1">
												<div class="comment-info">
													<span>好评</span>
													<span class="tb-tbcr-num">({{$haoping}})</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li-0">
												<div class="comment-info">
													<span>中评</span>
													<span class="tb-tbcr-num">({{$zhongping}})</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li--1">
												<div class="comment-info">
													<span>差评</span>
													<span class="tb-tbcr-num">({{$chaping}})</span>
												</div>
											</li>
										</ul>
									</div>
									<div class="clear"></div>

									<ul class="am-comments-list am-comments-list-flip">
									@forelse($comment as $v)
										<li class="am-comment">
											<!-- 评论容器 -->
											<a href="/h/">
												<img class="am-comment-avatar" src="/uploads/{{$User_Ufile[$v->uid]}}"/>
												<!-- 评论者头像 -->
											</a>

											<div class="am-comment-main">
												<!-- 评论内容容器 -->
												<header class="am-comment-hd">
													<!--<h3 class="am-comment-title">评论标题</h3>-->
													<div class="am-comment-meta">
														<!-- 评论元数据 -->
														<a href="/h/#link-to-user" class="am-comment-author">{{$User_Name[$v->uid]}} </a>
														<!-- 评论者 -->
														评论于
														<time datetime="">{{$v->created_at}}</time>
													</div>
												</header>

												<div class="am-comment-bd">
													<div class="tb-rev-item " data-id="255776406962">
														<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
															{{$v->content}}
														</div>
														<div class="tb-r-act-bar">
															商品口味:{{$Order_details[$v->gid]}}
														</div>
													</div>

												</div>
												<!-- 评论内容 -->
											</div>
										</li>
										@empty
										---暂无评论---
										@endforelse
									</ul>

									<div class="clear"></div>

									<!--分页 -->
									
									<div class="clear"></div>

									<div class="tb-reviewsft">
										<div class="tb-rate-alert type-attention">购买前请查看该商品的 <a href="/h/#" target="_blank">购物保障</a>，明确您的售后保障权益。</div>
									</div>

							
							</div>

						</div>

						<div class="clear"></div>

						@include('home.public.footer')
					</div>

				</div>
			</div>
			<!--菜单 -->
    @include('home.public.tip')


	</body>

<script src="/layui/layui.js"></script>
<script>
    layui.use('layer', function(){
  var layer = layui.layer;

});
</script>
	<script>
		// 默认选择第一个口味
		var a = $(".sku-line:first").text();
		$.get('/center/index',{a},function(res){
		})

		// 口味选择
	    function kouwei(obj){
	    	let a = $(obj).text();
	    	$.get('/center/index',{a},function(res){})
	    }

	    // 添加购物车
	    function add(id){
	    	let url = '/shopcartadd/'+id
	    	$.get(url,function(res){
				layer.alert('已加入购物车', {icon: 6});
	    	})
	    }

	    // 用户收藏
	    function ShowDiv(id){

	    	let urll = $('#url').val();
	    	let url = '/collection/'+id
	    	$.get(url,function(res){
	    		if (res == 1) {
	    			layer.msg('收藏成功<font color="red">❤</font>');
			    	$('#shouc').text('已收藏')
			    	setTimeout(function(){
                        window.location.href = urll;
                    },1000)
	    		}else{
	    			layer.msg('收藏失败,请稍后重试', {icon: 5});
	    		}
	    	})
	    }

	    //用户取消收藏
	    function del(id){
	    	let urll = $('#url').val();
	    	let url = '/collection/del/'+id
	    	$.get(url,function(res){
	    		if (res == 1) {
	    			layer.msg('已取消');
			    	$('#asdas').text('收藏')
			    	setTimeout(function(){
                        window.location.href = urll;
                    },1000)
	    		}
	    	})
	    }



	</script>
</html>