@extends('admin.index.index')

@section('center')
    <section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">网站信息</h2>
      </div>
      @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    <br>
                @endforeach
            </ul>
        </div>
        @endif
      <form action="/admin/configure/update" method="post" accept-charset="utf-8"  enctype="multipart/form-data">
      <ul class="ulColumn2">
            {{ csrf_field() }}
                <li>
                    <span class="item_name" style="width:120px;">网站Logo：</span>
                    <label class="uploadImg">
                        <input name="logo" type="file" >
                        <br>
                        <img src="/uploads/{{ $weds->logo }}" width="200px">
                      <input type="hidden" name="ulogo" value="{{ $weds->logo }}">
                    </label>
                </li>

                 <li>
                    <span class="item_name" style="width:120px;">网站图标：</span>
                    <label class="uploadImg">
                        <input name="icon" type="file" >
                        <br>
                        <img src="/uploads/{{ $weds->icon }}" >
                      <input type="hidden" name="uicon" value="{{ $weds->icon }}">
                    </label>
                </li>

                <li>
                    <span class="item_name" style="width:120px;">网站标题：</span>
                    <input type="text" name="name" class="textbox textbox_225" value="{{ $weds->name }}" >
                </li>



                <li>
                    <span class="item_name" style="width:120px;">联系方式：</span>
                    <input type="text" name="tel" class="textbox textbox_225" value="{{ $weds->tel }}" >
                </li>

                <li>
                    <span class="item_name" style="width:120px;">网站描述：</span>
                    <input type="text" name="describe" value="{{ $weds->describe }}" >

                </li>
                <li>
                    <span class="item_name" style="width:120px;">网站备案号：</span>
                    <input type="tel" name="filing" class="textbox textbox_225" value="{{ $weds->filing }}" >
                </li>
                <li>
                    <span class="item_name" style="width:120px;">版权信息：</span>
                    <input type="tel" name="cright" class="textbox textbox_225" value="{{ $weds->cright }}" >
                </li>
                <li>
                    <span class="item_name" style="width:120px;">网站地址：</span>
                    <input type="tel" name="url" class="textbox textbox_225" value="{{ $weds->url }}" >
                </li>
                <li>
                    <span class="item_name" style="width:120px;"></span>
                    <input type="submit" class="link_btn" value="提交修改">
                </li>
            </ul>
            </form>
 </div>
</section>
<script>


</script>

<script src="/a/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="/a/js/jquery.switcher.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $.switcher();
</script>

@endsection