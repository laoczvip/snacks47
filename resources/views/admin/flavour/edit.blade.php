@extends('admin.index.index')

@section('center')


    <section class="rt_wrap content mCustomScrollbar">
    <div class="rt_content">
            <div class="page_title">
                <h2 class="fl">修改商品属性</h2>
                <a href="/admin/flavour/index" class="fr top_rt_btn add_icon">返回</a>
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
        <form action="/admin/flavour/update" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
            <ul class="ulColumn2">
                <input type="hidden" name="id" value="{{$data->id}}">
                <li>
                    <span class="item_name" style="width:120px;">属性值</span>
                    <input type="text" name="fname" class="textbox textbox_225" value="{{$data->fname}}" placeholder="请输入类名"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;"></span>
                    <input type="submit" class="link_btn" value="修改属性">
                </li>
            </ul>
        </form>
    </div>
</section>
@endsection