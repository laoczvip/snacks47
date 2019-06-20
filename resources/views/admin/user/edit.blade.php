@extends('admin.index.index')

@section('center')


    <section class="rt_wrap content mCustomScrollbar">
    <div class="rt_content">
            <div class="page_title">
                <h2 class="fl">用户修改</h2>
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
        <form action="/admin/users/{{ $user->id }}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
            <ul class="ulColumn2">
                <li>
                    <span class="item_name" style="width:120px;">上传头像：</span>
                    <label class="uploadImg">
                        <input name="ufile" type="file" >
                        <!-- <span>上传头像</span> -->
                        <br>
                        <img src="/uploads/{{$user->userinfo->ufile}}" width="200px">
                        <input type="hidden" name="file" value="{{$user->userinfo->ufile}}">
                    </label>
                </li>

                <li>
                    <span class="item_name" style="width:120px;">会员昵称</span>
                    <input type="text" name="name" class="textbox textbox_225" value="{{ $user->name }}" >
                </li>

                <li>
                    <span class="item_name" style="width:120px;">会员账号</span>
                    <input type="text" name="number" class="textbox textbox_225" value="{{ $user->number }}" placeholder="请输入4~16位字母或者数字"/>
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
                    <input type="email" name="email" class="textbox textbox_225" value="{{ $user->userinfo->email }}" placeholder="电子邮件地址..."/>
                </li>
                <li>
                    <span class="item_name" style="width:120px;">手机号码：</span>
                    <input type="tel" name="tel" class="textbox textbox_225" value="{{ $user->userinfo->tel }}" placeholder="手机号码..."/>
                </li>
                <li>
                    <span class="item_name" style="width:120px;"></span>
                    <input type="submit" class="link_btn" value="提交修改">
                </li>
            </ul>
        </form>
    </div>
</section>
@endsection