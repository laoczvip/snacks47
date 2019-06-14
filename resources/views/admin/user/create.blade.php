@extends('admin.index.index')

@section('center')
    <section class="rt_wrap content mCustomScrollbar">
    <div class="rt_content">
            <div class="page_title">
                <h2 class="fl">添加用户</h2>
            </div>
        <form action="/admin/store" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
            <ul class="ulColumn2">
                <li>
                    <span class="item_name" style="width:120px;">上传头像：</span>
                    <label class="uploadImg">
                        <input type="file" >
                        <span>上传头像</span>
                    </label>
                </li>
                <li>
                    <span class="item_name" style="width:120px;">会员名称：</span>
                    <input type="text" class="textbox textbox_225" value="" placeholder="会员账号..."/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;">登陆密码：</span>
                    <input type="password" class="textbox textbox_225" value="" placeholder="会员密码..."/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;">会员等级：</span>
                        <select name="" class="select">
                            <option>会员等级</option>
                            <option>普通会员</option>
                            <option>高级会员</option>
                        </select>
                </li>
                <li>
                    <span class="item_name" style="width:120px;">电子邮箱：</span>
                    <input type="email" class="textbox textbox_225" value="" placeholder="电子邮件地址..."/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;">手机号码：</span>
                    <input type="tel" class="textbox textbox_225" value="" placeholder="手机号码..."/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;"></span>
                    <input type="submit" class="link_btn" value="添加用户">
                </li>
            </ul>
        </form>
    </div>
</section>


@endsection