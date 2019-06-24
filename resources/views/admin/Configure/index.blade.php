@extends('admin.index.index')

@section('center')
    <section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">网站信息</h2>
       <a href="/admin/configure/edit" class="fr top_rt_btn add_icon">修改网站信息</a>

      </div>
      <table id="tsadsd" class="table" style="width:500px;height:515px;">
           <tr>
                <th class="center" style="width:200px;">网站标题</th>
                <td >{{ $weds->name }}</td>
           </tr>
            <tr>
                <th class="center">网站Logo</th>
                <td><img src="/uploads/{{ $weds->logo }}" class="img-thumbnail"></td>
           </tr>
            <tr>
                <th class="center">网站图标</th>
                <td><img src="/uploads/{{$weds->icon}}" class="img-thumbnail"></td>
           </tr>
           <tr>
                <th class="center">联系方式</th>
                <td>{{ $weds->tel }}</td>
           </tr>
            <tr>
                <th class="center">网站描述</th>
                <td>{{ $weds->describe }}</td>
           </tr>
           <tr>
                <th class="center">网站备案号</th>
                <td name="filing">{{ $weds->filing }}</td>
           </tr>
           <tr>
                <th class="center"><br>网站是否开启</th>

                @if($weds->statu == 1)
                        <td ><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style="margin-top: 1;" onclick="off()" class="form-check-input" type="checkbox" checked id="inlineCheckbox1" value="option1"></td>
                @else
                        <td><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" style="margin-top: 1;" onclick="kaiqi()" type="checkbox" id="inlineCheckbox1" value="option1"></td>
                @endif
           </tr>
           <tr>
                <th class="center">网站地址</th>
                <td>{{ $weds->url }}</td>
           </tr>
            <tr>
                <th class="center">版权信息</th>
                <td>{{ $weds->cright }}</td>
           </tr>

      </table>
      <aside class="paging">
      </aside>
 </div>
</section>
<script>

    function off(){
        if(!window.confirm('你确定关闭网站吗?')){
            event.preventDefault();
            return false;
        };
        $.get('/admin/configure/off',function(res){
            console.log(res)
                if (res == 1) {
                    layer.msg('网站已关闭');

                    setTimeout(function(){
                        window.location.href = '/admin/configure/index';
                    },1000)
                };
            },'html');
    }

    function kaiqi(){
        if(!window.confirm('你确定开启网站吗?')){
            event.preventDefault();
            return false;
        };
        $.get('/admin/configure/kaiqi',function(res){
            console.log(res)
                if (res == 1) {
                    layer.msg('网站已开启');
                     setTimeout(function(){
                        window.location.href = '/admin/configure/index';
                    },1000)
                };
            },'html');
    }


</script>

<script src="/a/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="/a/js/jquery.switcher.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $.switcher();
</script>

@endsection