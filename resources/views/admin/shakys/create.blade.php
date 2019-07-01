@extends('admin.index.index')

@section('center')
    <section class="rt_wrap content mCustomScrollbar">
    <div class="rt_content">
            <div class="page_title">
                <h2 class="fl">加入秒杀活动</h2>
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
        <form action="/admin/shakys/shore" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
            <ul class="ulColumn2">
                <input type="hidden" name="sid" value="{{$sid}}">
                 <li>
                    <span class="item_name" style="width:120px;">商品Id:</span>
                    <input type="text" name="gid" value="{{$goods->id}}" >
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                  <li>
                    <span class="item_name" style="width:120px;">商品名称:</span>
                    {{$goods->title}}
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                 <li>
                    <span class="item_name" style="width:120px;">原商品库存:</span>
                    <input type="text" name="stock1" value="{{$goods_sku->stock}}">
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                 <li>
                    <span class="item_name" style="width:120px;">秒杀库存:</span>
                    <input type="text" name="stock" value="">
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                 <li>
                    <span class="item_name" style="width:120px;">原商品金额:</span>
                    <input type="text" name="original" value="{{$goods_sku->price}}">
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                 <li>
                    <span class="item_name" style="width:120px;">优惠金额:</span>
                    <input type="text" name="preferential" value="">
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;"></span>
                    <input type="submit" class="link_btn" value="确认加入">
                </li>
            </ul>
        </form>
    </div>
</section>
@endsection