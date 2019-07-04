@extends('admin.index.index')

@section('center')
    <section class="rt_wrap content mCustomScrollbar">
    <div class="rt_content">
            <div class="page_title">
                <h2 class="fl">修改活动商品</h2>
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
            .ulColumn2 input{
                width:300px;
                height:32px;
            }
        </style>
        <form action="/admin/shakys/update" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
            <ul class="ulColumn2">
                <input type="hidden" name="id" value="{{$shaky->id}}">
                <input type="hidden" name="sid" value="{{$shaky->sid}}">
                 <li>
                    <span class="item_name" style="width:120px;">商品Id:</span>
                    <input type="text" name="gid" value="{{$shaky->gid}}" >
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                 <li>
                    <span class="item_name" style="width:120px;">活动商品剩余库存:</span>
                    <input type="text" name="stock1" value="{{$shaky->stock}}">
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;">活动新库存:</span>
                    <input type="text" name="stock" value="">
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;">原价:</span>
                    <input type="text" name="original" value="{{$shaky->original}}">
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                 <li>
                    <span class="item_name" style="width:120px;">优惠金额:</span>
                    <input type="text" name="preferential" value="{{$shaky->preferential}}">
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;"></span>
                    <input type="submit" class="link_btn" value="确认修改">
                </li>
            </ul>
        </form>
    </div>
</section>
@endsection