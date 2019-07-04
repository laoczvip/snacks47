<div class="footer">
    <div class="footer-hd">
        <p>
            <a href="https://www.jd.com/">京东商城</a>
            <b>|</b>
            <a href="/">商城首页</a>
            <b>|</b>
            <a href="https://www.alipay.com/">支付宝</a>
            <b>|</b>
            <a href="http://www.chawuliu.cn/">物流</a>
        </p>
    </div>

    <!-- 友情链接 开始 -->
    <div class="footer-bd" >
        @foreach($friendly as $k=>$v)

            <a href="{{ $v->lurl }}">
                <img src="/uploads/{{ $v->limg }}" style="width: 92px;height: 25px;
                -webkit-box-shadow:10px 10px 5px #888888;
                -moz-box-shadow: 10px 10px 5px #888888;
                box-shadow: 10px 10px 5px #888888;">
            </a>

        @endforeach
    </div>
    <br>
     <div class="footer-bd">
        <p>
            <a onclick="a()">关于恒望</a>
            <a onclick="a()">合作伙伴</a>
            <a onclick="a()">联系我们</a>
            <em>{{$weds->cright}}</em>
        </p>
    </div>
    <!-- 友情链接 结束 -->
</div>
<script src="/layui/layui.js"></script>
<script>
//一般直接写在一个js文件中
    layui.use(['layer', 'form'], function(){
      var layer = layui.layer
      ,form = layui.form;
    });

    function a(){
        layer.alert('正在开发中哦~', {icon: 6});
    }
</script>