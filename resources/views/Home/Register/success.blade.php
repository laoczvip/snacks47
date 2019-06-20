<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Document</title>
</head>
<body>

</body>
<script src="/layui/layui.js"></script>
<script>
//一般直接写在一个js文件中
    layui.use(['layer', 'form'], function(){
      var layer = layui.layer
      ,form = layui.form;

    layer.msg('激活成功,跳转到登陆页面', {
        icon: 1,
        time: 0 //不自动关闭
        ,btn: ['好的']
        ,yes: function(index){
            window.location.href = '/login';
        }
    });


        });
</script>
<script>
</script>
</html>