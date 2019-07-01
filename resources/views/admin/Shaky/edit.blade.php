@extends('admin.index.index')

@section('center')


    <section class="rt_wrap content mCustomScrollbar">
    <div class="rt_content">
            <div class="page_title">
                <h2 class="fl">修改活动类</h2>
                <a href="/admin/cates/index" class="fr top_rt_btn add_icon">返回活动首页</a>
                <a  onclick="javascript:history.back(-1)" class="fr top_rt_btn add_icon">返回上一级</a>
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
           <style>
            td{padding:10px;}

        </style>
        <form action="/admin/shaky/update" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
            <table style="margin-left:150px;">
                <tr>
                    <td>活动名称</td>
                    <td><input type="text" name="sname" class="textbox textbox_225" value="{{$shaky->sname}}" placeholder="请输入活动名称"/></td>
                </tr>
                <tr>
                    <td>活动图</td>
                    <td >
                        <input type="file" name="profile" class="textbox textbox_225"  style="background-color:#eee;height:40px;" value="" />
                        <img src="/uploads/{{$shaky->profile}}" style="margin-top:10px;">
                        <input type="hidden" name="profile" value="{{$shaky->profile}}" />
                    </td>
                </tr>
                <tr>
                    <td>开启时间</td>
                    <td><input type="text" name="ctime" class="textbox textbox_225" value="{{$shaky->ctime}}"></td>
                </tr>
                <tr>
                    <td>结束时间</td>
                    <td><input type="text" name="jtime" class="textbox textbox_225" value="{{$shaky->jtime}}"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" class="link_btn" value="确认修改"></td>
                </tr>
            </table>
        </form>
    </div>
</section>
@endsection