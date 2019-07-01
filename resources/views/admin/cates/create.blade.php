@extends('admin.index.index')

@section('center')


    <section class="rt_wrap content mCustomScrollbar">
    <div class="rt_content">
            <div class="page_title">
                <h2 class="fl">添加商品类</h2>
                <a href="/admin/cates/index" class="fr top_rt_btn add_icon">返回类首页</a>
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
        <form action="/admin/cates/insert" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
            <ul class="ulColumn2">
                <li>
                    <span class="item_name" style="width:120px;">父类</span>
                    <select name="pid" id="" >
                    
                        @if($cates['pid'] !==null)

                        <option value="{{$cates->id}}" >----{{$cates->title}}----</option>
                        @else
                        <option value="">----请选择----</option>
                        @endif
                    </select>
                   
                </li>
                <li>
                    <span class="item_name" style="width:120px;">类名</span>
                    <input type="text" name="title" class="textbox textbox_225" value="" placeholder="请输入类名"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;"></span>
                    <input type="submit" class="link_btn" value="添加分类">
                </li>
            </ul>
        </form>
    </div>
</section>
@endsection