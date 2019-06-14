<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>后台管理系统</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="/a/css/style.css">
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
<script src="/a/js/jquery.js"></script>
<script src="/a/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>

    (function($){
        $(window).load(function(){

            $("a[rel='load-content']").click(function(e){
                e.preventDefault();
                var url=$(this).attr("href");
                $.get(url,function(data){
                    $(".content .mCSB_container").append(data); //load new content inside .mCSB_container
                    //scroll-to appended content
                    $(".content").mCustomScrollbar("scrollTo","h2:last");
                });
            });

            $(".content").delegate("a[href='top']","click",function(e){
                e.preventDefault();
                $(".content").mCustomScrollbar("scrollTo",$(this).attr("href"));
            });

        });
    })(jQuery);
</script>
</head>
<body>
<!--header-->
<header>
     <h1><img src="/a/images/admin_logo.png"/></h1>
     <ul class="rt_nav">
      <li><a href="http://www.mycodes.net" target="_blank" class="website_icon">站点首页</a></li>
      <li><a href="#" class="set_icon">账号设置</a></li>
      <li><a href="login.html" class="quit_icon">安全退出</a></li>
     </ul>
</header>
<aside class="lt_aside_nav content mCustomScrollbar">
     <h2><a href="/admin">首页</a></h2>
     <ul>
        <li>
            <dl>
                <dt>用户管理</dt>
                <!--当前链接则添加class:active-->
                <dd><a href="/admin/index">用户列表</a></dd>
                <dd><a href="/admin/create" class="active">添加用户</a></dd>
                <dd><a href="recycle_bin.html">已删除的用户</a></dd>
            </dl>
        </li>
        <p class="btm_infor">© DeathGhost.cn 版权所有</p>
     </ul>
</aside>

@section('center')
<section class="rt_wrap content mCustomScrollbar">
    <div class="rt_content">
<!--统计图-->
        <section style="overflow:hidden">

            <!--柱状图-->
            <div class="dataStatistic fl">
             <div id="cylindrical">
             </div>
            </div>
            <!--线性图-->
            <div class="dataStatistic fl">
             <div id="line">
             </div>
            </div>
        </section>
     </div>
</section>
@show
<script src="/a/js/amcharts.js" type="text/javascript"></script>
<script src="/a/js/serial.js" type="text/javascript"></script>
<script src="/a/js/pie.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function (e) {
        GetSerialChart();
        MakeChart(json);
    });
    var json = [
  { "name": "数据1", "value": "100" },
  { "name": "数据2", "value": "0" },
  { "name": "数据3", "value": "0" },
  { "name": "数据4", "value": "0" },
  { "name": "数据5", "value": "0" },
  { "name": "数据6", "value": "0" },
  { "name": "数据7", "value": "0" },
  { "name": "数据8", "value": "0" }
  ]
    //柱状图
    function GetSerialChart() {

        chart = new AmCharts.AmSerialChart();
        chart.dataProvider = json;
        //json数据的key
        chart.categoryField = "name";
        //不选择
        chart.rotate = false;
        //值越大柱状图面积越大
        chart.depth3D = 20;
        //柱子旋转角度角度
        chart.angle = 30;
        var mCtCategoryAxis = chart.categoryAxis;
        mCtCategoryAxis.axisColor = "#efefef";
        //背景颜色透明度
        mCtCategoryAxis.fillAlpha = 0.5;
        //背景边框线透明度
        mCtCategoryAxis.gridAlpha = 0;
        mCtCategoryAxis.fillColor = "#efefef";
        var valueAxis = new AmCharts.ValueAxis();
        //左边刻度线颜色
        valueAxis.axisColor = "#ccc";
        //标题
        valueAxis.title = "网站总访问量";
        //刻度线透明度
        valueAxis.gridAlpha = 0.2;
        chart.addValueAxis(valueAxis);
        var graph = new AmCharts.AmGraph();
        graph.title = "value";
        graph.valueField = "value";
        graph.type = "column";
        //鼠标移入提示信息
        graph.balloonText = "总访问量[[category]] [[value]]";
        //边框透明度
        graph.lineAlpha = 0.3;
        //填充颜色
        graph.fillColors = "#b9121b";
        graph.fillAlphas = 1;

        chart.addGraph(graph);

        // CURSOR
        var chartCursor = new AmCharts.ChartCursor();
        chartCursor.cursorAlpha = 0;
        chartCursor.zoomable = false;
        chartCursor.categoryBalloonEnabled = false;
        chart.addChartCursor(chartCursor);

        chart.creditsPosition = "top-right";

        //显示在Main div中
        chart.write("cylindrical");
    }
    //折线图
    AmCharts.ready(function () {
        var chart = new AmCharts.AmSerialChart();
        chart.dataProvider = json;
        chart.categoryField = "name";
        chart.angle = 30;
        chart.depth3D = 20;
        //标题
        //chart.addTitle("3D折线图Demo", 15);
        var graph = new AmCharts.AmGraph();
        chart.addGraph(graph);
        graph.valueField = "value";
        //背景颜色透明度
        graph.fillAlphas = 0.3;
        //类型
        graph.type = "line";
        //圆角
        graph.bullet = "round";
        //线颜色
        graph.lineColor = "#8e3e1f";
        //提示信息
        graph.balloonText = "[[name]]: [[value]]";
        var categoryAxis = chart.categoryAxis;
        categoryAxis.autoGridCount = false;
        categoryAxis.gridCount = json.length;
        categoryAxis.gridPosition = "start";
        chart.write("line");
    });
    //饼图
    //根据json数据生成饼状图，并将饼状图显示到div中
    function MakeChart(value) {
        chartData = eval(value);
        //饼状图
        chart = new AmCharts.AmPieChart();
        chart.dataProvider = chartData;
        //标题数据
        chart.titleField = "name";
        //值数据
        chart.valueField = "value";
        //边框线颜色
        chart.outlineColor = "#fff";
        //边框线的透明度
        chart.outlineAlpha = .8;
        //边框线的狂宽度
        chart.outlineThickness = 1;
        chart.depth3D = 20;
        chart.angle = 30;
        chart.write("pie");
    }
</script>
</body>
</html>