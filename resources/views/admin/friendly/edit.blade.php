@extends('admin.index.index')

@section('center')

<section class="rt_wrap content mCustomScrollbar">
    <div class="rt_content">
            <div class="page_title">
                <h2 class="fl">修改友情链接</h2>
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

        <form action="/admin/friendly/{{ $friendly->id }}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
            <ul class="ulColumn2">

                <li>
                    <span class="item_name" style="width:120px;">链接名称</span>
                    <input id="lname" type="text" name="lname" class="textbox textbox_225" value="{{ $friendly->lname }}" placeholder="请输入链接名称" onblur="fname()" autocomplete="Off" />
                    <b id="geshi1"></b>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                
                <li>
                    <span class="item_name" style="width:120px;">跳转地址：</span>
                    <input id="lurl" type="text" name="lurl" class="textbox textbox_225" value="{{ $friendly->lurl }}" placeholder="请输入跳转地址" onblur="furl()" autocomplete="Off" />
                    <b id="geshi2"></b>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                
                <li>
                    <span class="item_name" style="width:120px;">链接原展示图：</span>
                    <label class="uploadImg">
                        <img src="/uploads/{{ $friendly->limg }}" style="width:80px;">
                    </label>
                </li>

                <input type="hidden" name="old_limg" value="{{ $friendly->limg }}">

                <li>
                    <span class="item_name" style="width:120px;">链接展示图：</span>
                    <label class="uploadImg">
                        <input name="limg" type="file" >
                        <!-- <span>链接展示图</span> -->
                    </label>
                </li>

                <li>
                    <span class="item_name" style="width:120px;">状态：</span>
                        激活<input type="radio" name="lstatus" value="1">
                        &nbsp;
                        关闭<input type="radio" name="lstatus" value="0" checked>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>

                <li>
                    <span class="item_name" style="width:120px;"></span>
                    <input type="submit" class="link_btn" value="修改">
                </li>

            </ul>
        </form>
    </div>
</section>

<script type="text/javascript">
    
    var fname = function()
    {
        //友情名称 添加 限制 条件
        let lname = /^\D{2,8}$/;
        //友情url 添加 限制条件
        
        if (lname.test($('#lname').val())) {
            $('#geshi1').html('.格式正确！');
            $('#geshi1').css('color','green');
        } else {
            $('#geshi1').html('.格式错误！');
            $('#geshi1').css('color','red');
        }
    }

    var furl = function ()
    {
        let lurl = /^\w{3}.\w{2,8}.\w{3}$/;
        if (lurl.test($('#lurl').val())) {
            $('#geshi2').html('.格式正确！');
            $('#geshi2').css('color','green');
        } else {
            $('#geshi2').html('.格式错误！');
            $('#geshi2').css('color','red');
        }
    }

</script>
@endsection