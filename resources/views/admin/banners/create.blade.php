@extends('admin.index.index')

@section('center')


    <section class="rt_wrap content mCustomScrollbar">
    <div class="rt_content">
            <div class="page_title">
                <h2 class="fl">添加轮播图</h2>
            </div>
        
        
        </div>
     
        <form action="/admin/banners" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
            <ul class="ulColumn2">
                <li>
                    <span class="item_name" style="width:120px;">上传轮播图：</span>
                    <label class="uploadImg">
                        <input name="url" type="file" >
                        <!-- <span>上传轮播图</span> -->
                    </label>
                </li>
                <li>
                    <span class="item_name" style="width:120px;">轮播图标题:</span>
                    <input type="text" name="title" class="textbox textbox_225" value="{{ old('title') }}" placeholder="请输入轮播图的标题"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;">轮播图描述:</span>
                    <input type="text" name="desc" class="textbox textbox_225" value="{{ old('desc') }}" placeholder="请输入轮播图的描述"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                 <div class="form-group" style="padding-left:46px;"> 
                    <label for="desc">轮播图状态:</label> 
                   
                    &nbsp;&nbsp;&nbsp;未开启:<input type="radio" name="status" value="0" checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    开启:<input type="radio" name="status" value="1">
                 </div> 
                  
                </li>

                
                <li>
                    <span class="item_name" style="width:120px;"></span>
                    <input type="submit" class="link_btn" value="添加轮播图">
                </li>
            </ul>
        </form>
    </div>
</section>
@endsection