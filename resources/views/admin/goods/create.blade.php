@extends('admin.index.index')

@section('center')


    <section class="rt_wrap content mCustomScrollbar">
    <div class="rt_content">
            <div class="page_title">
                <h2 class="fl">商品添加</h2>
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
                    <span class="item_name" style="width:120px;">会员等级：</span>
                        <select name="cid" class="select">
                        @forelse($cates as $k=>$v)
                        @if($v->pid==0)
                            <option value="0" disabled>{{$v->title}}</option>
                        @else
                             <option value="{{$v->id}}">{{$v->title}}</option>
                        @endif
                        @empty
                        @endforelse
                        </select>
                </li>
                  <li>
                    <span class="item_name" style="width:120px;">商品名称</span>
                    <input type="text" name="title" class="textbox textbox_225" value="{{ old('number') }}" placeholder="请输入4~16位字母或者数字"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                  <li>
                    <span class="item_name" style="width:120px;">商品描述</span>
                    <input type="text" name="desc" class="textbox textbox_225" value="{{ old('number') }}" placeholder="请输入4~16位字母或者数字"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;">展示图</span>
                    <label class="uploadImg">
                        <input name="showcase" type="file" >
                        <!-- <span>上传头像</span> -->
                    </label>
                </li>
                <li>
                    <span class="item_name" style="width:120px;">口味&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    xx<input type="checkbox" name="flavorties"  value="{{ old('number') }}" />
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;">商品价格</span>
                    <input type="text" name="price" class="textbox textbox_225" value="{{ old('number') }}" placeholder="请输入4~16位字母或者数字"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                  <li>
                    <span class="item_name" style="width:120px;">商品库存</span>
                    <input type="text" name="price" class="textbox textbox_225" value="{{ old('number') }}" placeholder="请输入4~16位字母或者数字"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                 <li>
                    <span class="item_name" style="width:120px;">商品重量</span>
                    <input type="text" name="price" class="textbox textbox_225" value="{{ old('number') }}" placeholder="请输入4~16位字母或者数字"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;"></span>
                    <input type="submit" class="link_btn" value="添加商品">
                </li>
            </ul>
        </form>
    </div>
</section>
@endsection