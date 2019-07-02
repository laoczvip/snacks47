@extends('admin.index.index')

@section('center')


    <section class="rt_wrap content mCustomScrollbar">
    <div class="rt_content">
            <div class="page_title">
                <h2 class="fl">修改轮播图</h2>
                <a href="/admin/banners" style="text-decoration:none" class="fr top_rt_btn add_icon">返回上一级</a>
            </div>


        </div>
        <div style="margin-top: -70px";>
        <form action="/admin/banners/{{ $data->id }}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      {{method_field('PUT')}}

            <ul class="ulColumn2">

                <li>
                    <div >
                        <img src="/uploads/{{ $data->url }}" class="img-thumbnail" style="height:225px;width:225px;margin-left:123px;margin-bottom:20px";>
                    </div>
                    <span class="item_name" style="width:120px;">轮播图：</span>
                        <label class="uploadImg" style="width:225px";>
                        <input name="url" type="file" >
                        <input type="hidden" name="url_path" value="{{ $data->url }}">
                        <!-- <span>上传轮播图</span> -->
                         </label>

                    <!-- <div class="form-group">
                            <label for="exampleInputFile">轮播图</label>
                            <input type="file" name="url" id="exampleInputFile" />
                            <input type="hidden" name="url_path" value="{{ $data->url }}">

                    </div> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;">轮播图标题:</span>
                    <input type="text" name="title" class="textbox textbox_225" value="{{ $data->title }}" placeholder="请输入轮播图的标题"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;">轮播图描述:</span>
                    <input type="text" name="desc" class="textbox textbox_225" value="{{ $data->desc }}" placeholder="请输入轮播图的描述"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                 <li>
                    <span class="item_name" style="width:120px;">轮播图跳转的地址:</span>
                    <input type="text" name="jump" class="textbox textbox_225" value="{{ $data->jump }}" placeholder="请输入轮播图跳转的地址"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>



                <li>
                    <span class="item_name" style="width:120px;"></span>
                    <input type="submit" class="link_btn" value="提交">
                </li>
            </ul>
        </form>
    </div>
    </div>
</section>
@endsection