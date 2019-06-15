@extends('admin.index.index')

@section('center')


    <section class="rt_wrap content mCustomScrollbar">
    <div class="rt_content">
            <div class="page_title">
                <h2 class="fl">添加用户</h2>
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
        <form action="/admin/users" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
            <ul class="ulColumn2">
                <li>
                    <span class="item_name" style="width:120px;">上传头像：</span>
                    <label class="uploadImg">
                        <input name="ufile" type="file" >
                        <!-- <span>上传头像</span> -->
                    </label>
                </li>
                <li>
                    <span class="item_name" style="width:120px;">会员账号</span>
                    <input type="text" name="number" class="textbox textbox_225" value="{{ old('number') }}" placeholder="请输入4~16位字母或者数字"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;">登陆密码：</span>
                    <input type="password" class="textbox textbox_225" value="" name="pass"  placeholder="请输入6~12位字母数字或下划线"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>

                <li>
                    <span class="item_name" style="width:120px;">确认密码密码：</span>
                    <input type="password" class="textbox textbox_225" value="" name="upass" placeholder="确认密码..."/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>

                <li>
                    <span class="item_name" style="width:120px;">会员等级：</span>
                        <select name="type" class="select">
                            <option value="0">普通用户</option>
                            <option value="1">普通会员</option>
                            <option value="2">高级管理员</option>
                        </select>
                </li>
                <li>
                    <span class="item_name" style="width:120px;">电子邮箱：</span>
                    <input type="email" name="email" class="textbox textbox_225" value="{{ old('email') }}" placeholder="电子邮件地址..."/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;">手机号码：</span>
                    <input type="tel" name="tel" class="textbox textbox_225" value="{{ old('tel') }}" placeholder="手机号码..."/>
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