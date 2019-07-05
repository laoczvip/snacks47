<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>后台管理系统</title>
        <meta name="author" content="DeathGhost" />
        <link rel="stylesheet" type="text/css" href="/a/css/style.css">
        <script src="/a/js/jquery.js"></script>
        <script src="/a/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <style type="text/css">a{text-decoration:none}</style>
        <script type="text/javascript" src="/a/js/jquery-1.7.2.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <script type="text/javascript" src="/a/js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="/bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="/a/css/switcher.css">
        <!-- 首页统计 -->
        <link rel="stylesheet" type="text/css" href="/aa/css/admin.css"/>
        <script src="/layui/layui.js" type="text/javascript" charset="utf-8"></script>
        <script src="/aa/echarts/echarts.js"></script>
        <script type="text/javascript" src="/utf8-php/ueditor.config.js"></script>
        <link rel="icon" href="/a/images/ico.png"/>

        <!-- 编辑器源码文件 -->
        <script type="text/javascript" src="/utf8-php/ueditor.all.js"></script>
    </head>
<body style="line-height: 1;">
<!--header-->
<header>
     <h1><img src="/a/images/admin_logo.png"/></h1>
     <ul class="rt_nav">
      <li><a href="/" target="_blank" class="website_icon">站点首页</a></li>
      <li><a href="/admin/login" class="quit_icon">安全退出</a></li>
     </ul>
</header>
<aside class="lt_aside_nav content mCustomScrollbar">
     <h2><a href="/admin">首页</a></h2>
         <ul>
            <li>
                <dl id="asgd">
                    <div class="sidebar-nav ">
                        <div class="sidebar-title">
                            <dt>用户管理</dt>
                        </div>
                        <ul class="sidebar-trans">
                            <!--当前链接则添加class:active-->
                            <dd><a href="/admin/users">用户列表</a></dd>
                            <!-- <dd><a href="/admin/create" class="active">添加用户</a></dd> -->
                            <dd><a href="/admin/users/create" >添加用户</a></dd>
                            <dd><a href="/admin/softdeletion">已删除的用户</a></dd>
                        </ul>
                    </div>
                </dl>
            </li>

            <li>
                <dl id="asgd">
                    <div class="sidebar-nav ">
                        <div class="sidebar-title">
                            <dt>商品分类</dt>
                        </div>
                        <ul class="sidebar-trans">
                            <dd><a href="/admin/cates">分类列表</a></dd>
                            <dd><a href="/admin/cates/create" >添加分类</a></dd>
                        </ul>
                    </div>
                </dl>
                </dl>
            </li>


            <li>
                <dl id="asgd">
                    <div class="sidebar-nav ">
                        <div class="sidebar-title">
                            <dt>商品属性管理</dt>
                        </div>
                        <ul class="sidebar-trans">
                             <dd><a href="/admin/flavour/index">属性列表</a></dd>
                        </ul>
                    </div>
                </dl>
                </dl>
            </li>



            <li>
                <dl id="asgd">
                    <div class="sidebar-nav ">
                        <div class="sidebar-title">
                            <dt>商品管理</dt>
                        </div>
                        <ul class="sidebar-trans">
                            <dd><a href="/admin/goods">商品列表</a></dd>
                            <dd><a href="/admin/goods/create" >添加商品</a></dd>
                        </ul>
                    </div>
                </dl>
                </dl>
            </li>

            <li>
                <dl id="asgd">
                    <div class="sidebar-nav ">
                            <div class="sidebar-title">
                                <dt>订单管理</dt>
                            </div>
                            <ul class="sidebar-trans">
                                <dd><a href="/admin/order">订单列表</a></dd>
                            </ul>
                    </div>
                </dl>
            </li>


            <li>
                <dl id="asgd">
                <div class="sidebar-nav ">
                        <div class="sidebar-title">
                            <dt>头条管理</dt>
                        </div>
                        <ul class="sidebar-trans">
                            <dd><a href="/admin/headlines">头条列表</a></dd>
                            <dd><a href="/admin/headlines/create" >添加头条</a></dd>
                            <dd><a href="/admin/headlines/soft" >已删除的头条</a></dd>
                        </ul>
                </div>
                </dl>
            </li>

            <li>
                <dl id="asgd">
                    <div class="sidebar-nav ">
                            <div class="sidebar-title">
                                <dt>活动管理</dt>
                            </div>
                            <ul class="sidebar-trans">
                                <dd><a href="/admin/shaky/index">活动列表</a></dd>
                                <dd><a href="/admin/shaky/create" >添加活动</a></dd>
                                <dd><a href="/admin/shaky/create" >已删除的活动</a></dd>
                            </ul>
                    </div>
                </dl>
            </li>

            </dl>
        </li>





            <li>
                <dl id="asgd">
                    <div class="sidebar-nav ">
                            <div class="sidebar-title">
                                <dt>友情链接管理</dt>
                            </div>
                            <ul class="sidebar-trans">
                                <dd><a href="/admin/friendly">友情链接列表</a></dd>
                                <dd><a href="/admin/friendly/create" >添加友情链接</a></dd>
                            </ul>
                    </div>
                </dl>
            </li>
            <li>
                <dl id="asgd">
                    <div class="sidebar-nav ">
                            <div class="sidebar-title">
                                <dt>评论管理</dt>
                            </div>
                            <ul class="sidebar-trans">
                                <dd><a href="/admin/comment">评论列表</a></dd>
                            </ul>
                    </div>
                </dl>
            </li>

            <li>
                <dl id="asgd">
                    <div class="sidebar-nav ">
                        <div class="sidebar-title">
                            <dt>轮播图管理</dt>
                        </div>
                        <ul class="sidebar-trans">
                            <dd><a href="/admin/banners">轮播图列表</a></dd>
                            <dd><a href="/admin/banners/create" >添加轮播图</a></dd>
                            <dd><a href="/admin/banners/soft" >已删除的轮播图</a></dd>
                        </ul>
                    </div>
                </dl>
            </li>


            <li>
                <dl id="asgd">
                    <div class="sidebar-nav ">
                        <div class="sidebar-title">
                            <dt>网站信息</dt>
                        </div>
                        <ul class="sidebar-trans">
                            <dd><a href="/admin/configure/index">查看配置</a></dd>
                            <dd><a href="/admin/users/create" >修改配置</a></dd>
                        </ul>
                    </div>
                </dl>
            </li>
        </ul>
    <!-- 左边栏折叠 -->
 <script>
       $(".sidebar-title").live('click', function() {
            if ($(this).parent(".sidebar-nav").hasClass("sidebar-nav-fold")) {
                $(this).next().slideDown(200);
                $(this).parent(".sidebar-nav").removeClass("sidebar-nav-fold");
            } else {
                $(this).next().slideUp(200);
                $(this).parent(".sidebar-nav").addClass("sidebar-nav-fold");
            }
        });
</script>





        <p class="btm_infor">© DeathGhost.cn 版权所有</p>
     </ul>
</aside>
    <!-- 错误提示 -->
    @if(session('error'))
    <div class="alert  alert-danger alert-dismissible" role="alert" style="width: 92em;margin-left: 378px;">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>{{session('error')}}</strong>
    </div>
    @endif

    @if(session('success'))
    <div class="alert  alert-info alert-dismissible" role="alert" style="width: 92em;margin-left: 378px;">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>{{session('success')}}</strong>
    </div>
    @endif




@section('center')
<div class="wrap-container welcome-container" style="margin-left:215px;">
        <div class="row">
            <div class="welcome-left-container col-lg-9">
                <div class="data-show">
                    <ul class="clearfix">
                        <li class="col-sm-12 col-md-4 col-xs-12">
                            <a style="text-decoration:none" href="javascript:;" class="clearfix">
                                <div class="icon-bg bg-org f-l">
                                    <span class="iconfont">&#xe606;</span>
                                </div>
                                <div class="right-text-con">
                                    <p class="name">用户数</p>
                                    <p><span class="color-org">
                                    @if(Request::path() == 'admin')
                                        {{$num}}
                                    @endif
                                    </span>数据<span class="iconfont">&#xe628;</span></p>
                                </div>
                            </a>
                        </li>
                        <li class="col-sm-12 col-md-4 col-xs-12">
                            <a style="text-decoration:none" href="javascript:;" class="clearfix">
                                <div class="icon-bg bg-blue f-l">
                                    <span class="iconfont">&#xe502;</span>
                                </div>
                                <div class="right-text-con">
                                    <p class="name">商品数量</p>
                                    <p><span class="color-blue">
                                    @if(Request::path() == 'admin')
                                        {{$goods_num}}
                                    @endif</span>数据<span class="iconfont">&#xe628;</span></p>
                                </div>
                            </a>
                        </li>
                        <li class="col-sm-12 col-md-4 col-xs-12">
                            <a style="text-decoration:none" href="javascript:;" class="clearfix">
                                <div class="icon-bg bg-green f-l">
                                    <span class="iconfont">&#xe600;</span>
                                </div>
                                <div class="right-text-con">
                                    <p class="name">总营业额</p>
                                    <p><span class="color-green">
                                     @if(Request::path() == 'admin')
                                        {{$menuy}}
                                    @endif</span>数据<span class="iconfont">&#xe60f;</span></p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <!--图表-->
                <div class="chart-panel panel panel-default">
                    <div class="panel-body" id="chart" style="height: 376px;">
                    </div>
                </div>
                <!--服务器信息-->
                <div class="server-panel panel panel-default">
                    <div class="panel-header">服务器信息</div>
                    <div class="panel-body clearfix">
                        <div class="col-md-2">
                            <p class="title">服务器环境</p>
                            <span class="info">{{ $_SERVER['SERVER_SOFTWARE'] }}</span>
                        </div>
                        <div class="col-md-2" style="width: 132px;">
                            <p class="title">服务器IP地址</p>
                            <span class="info">{{ $_SERVER['SERVER_ADDR'] }}</span>
                        </div>
                        <div class="col-md-2">
                            <p class="title">服务器域名</p>
                            <span class="info">{{ $_SERVER['SERVER_NAME'] }}</span>
                        </div>
                        <div class="col-md-2" style="width:267px;">
                            <p class="title"> 网站根目录</p>
                            <span class="info">{{ $_SERVER['DOCUMENT_ROOT'] }}</span>
                        </div>
                        <div class="col-md-2">
                            <p class="title">数据库信息</p>
                            <span class="info">5.6.12-log </span>
                        </div>
                        <div class="col-md-2">
                            <p class="title">服务器当前时间</p>
                            <span class="info">{{  date("Y-m-d H:i:s",time()) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
            layui.use(['layer','jquery'], function(){
                var layer = layui.layer;
                var $=layui.jquery;
                //图表
                var myChart;
                require.config({
                    paths: {
                        echarts: '/aa/lib/echarts'
                    }
                });
                require(
                    [
                        'echarts',
                        'echarts/chart/bar',
                        'echarts/chart/line',
                        'echarts/chart/map'
                    ],
                    function (ec) {
                        //--- 折柱 ---
                        myChart = ec.init(document.getElementById('chart'));
                        myChart.setOption(
                            {
                             title: {
                                text: "数据统计",
                                textStyle: {
                                    color: "rgb(85, 85, 85)",
                                    fontSize: 18,
                                    fontStyle: "normal",
                                    fontWeight: "normal"
                                }
                            },
                            tooltip: {
                                trigger: "axis"
                            },
                            legend: {
                                data: ["用户", "总商品", "总金额"],
                                selectedMode: false,
                            },
                            toolbox: {
                                show: true,
                                feature: {
                                    dataView: {
                                        show: false,
                                        readOnly: true
                                    },
                                    magicType: {
                                        show: false,
                                        type: ["line", "bar", "stack", "tiled"]
                                    },
                                    restore: {
                                        show: true
                                    },
                                    saveAsImage: {
                                        show: true
                                    },
                                    mark: {
                                        show: false
                                    }
                                }
                            },
                            calculable: false,
                            xAxis: [
                                {
                                    type: "category",
                                    boundaryGap: false,
                                    data: ["周一", "周二", "周三", "周四", "周五", "周六", "周日"]
                                }
                            ],
                            yAxis: [
                                {
                                    type: "value"
                                }
                            ],
                             grid: {
                                x2: 30,
                                x: 50
                            },
                            series: [
                                {
                                    name: "用户",
                                    type: "line",
                                    smooth: true,
                                    itemStyle: {
                                        normal: {
                                            areaStyle: {
                                                type: "default"
                                            }
                                        }
                                    },
                                    data: [10, 12, 21, 54, 260, 830, 710]
                                },
                                {
                                    name: "总商品",
                                    type: "line",
                                    smooth: true,
                                    itemStyle: {
                                        normal: {
                                            areaStyle: {
                                                type: "default"
                                            }
                                        }
                                    },
                                    data: [30, 182, 434, 791, 390, 30, 10]
                                },
                                {
                                    name: "总金额",
                                    type: "line",
                                    smooth: true,
                                    itemStyle: {
                                        normal: {
                                            areaStyle: {
                                                type: "default"
                                            },
                                            color: "rgb(110, 211, 199)"
                                        }
                                    },
                                    data: [1320, 1132, 601, 234, 120, 90, 20]
                                }
                            ]
                        }
                        );
                    }
                );
                $(window).resize(function(){
                    myChart.resize();
                })
            });
</script>
@show



<script>
    //一般直接写在一个js文件中
    layui.use(['layer', 'form'], function(){
      var layer = layui.layer
      ,form = layui.form;
    });
</script>

</body>
</html>
