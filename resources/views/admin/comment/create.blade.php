@extends('admin.index.index')

@section('center')

<section class="rt_wrap content mCustomScrollbar">
    <div class="rt_content">
            <div class="page_title">
                <h2 class="fl">添加友情链接</h2>
            </div>

        <form action="/admin/friendly" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
            <ul class="ulColumn2">
                
                <li>
                    <span class="item_name" style="width:120px;">商品展示图:</span>
                    <label class="uploadImg">
                        <input name="limg" type="file" >
                        <!-- <span>链接展示图</span> -->
                    </label>
                </li>

                <li>
                    <span class="item_name" style="width:120px;">用户名:</span>
                    <input id="" type="text" name="name" class="textbox textbox_225" value="" placeholder="" autocomplete="Off" />
                    {{  session(home_user)}}
                    <b id="geshi1"></b>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>

                <li>
                    <span class="item_name" style="width:120px;">评价等级:</span>
                        好评<input type="radio" name="rank" value="1" checked>
                        &nbsp;
                        中评<input type="radio" name="rank" value="2">
                        差评<input type="radio" name="rank" value="3">
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>

                <li>
                    <span class="item_name" style="width:120px;">评论内容：</span>
                    <input id="" type="text" name="content" class="textbox textbox_225" value="" placeholder="请输入跳转地址" autocomplete="Off" />
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>

                <li>
                    <span class="item_name" style="width:120px;"></span>
                    <input type="submit" class="link_btn" value="添加友情链接">
                </li>

            </ul>
        </form>
    </div>
</section>
@endsection