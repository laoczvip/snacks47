@extends('admin.index.index')

@section('center')
<!-- 实例化编辑器 -->
     <script type="text/javascript">
       var ue = UE.getEditor('container',{
          toolbars: [
                        ['emotion','spechars','snapscreen',
                        'fontfamily', 'fontsize',
                        'simpleupload',  'insertimage',
                        ],
                    ]
        });
    </script>


    <section class="rt_wrap content mCustomScrollbar">
    <div class="rt_content";>
            <div class="page_title">
                <h2 class="fl">添加头条</h2>
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

        </div>
        </div>

        <div style="margin-top: -65px">

        <form action="/admin/headlines" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
            <ul class="ulColumn2">
                <li>
                    <span class="item_name" style="width:120px;">上传缩略图:</span>
                    <label class="uploadImg">
                        <input name="thumb" type="file" >
                        <!-- <span>上传轮播图</span> -->
                    </label>
                </li>
                <li>
                    <span class="item_name" style="width:120px;">头条标题:</span>
                    <input type="text" name="htitle" class="textbox textbox_225" value="{{ old('htitle') }}" placeholder="请输入头条的标题"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>

                <li>
                    <span class="item_name" style="width:120px;">头条作者:</span>
                    <input type="text" name="auth" class="textbox textbox_225" value="{{ old('auth') }}" placeholder="请输入头条的作者"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                 <div class="form-group" style="padding-left:46px;"> 
                    <label for="desc">头条状态:</label> 
                   
                    &nbsp;&nbsp;&nbsp;未开启:<input type="radio" name="status" value="0" checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    开启:<input type="radio" name="status" value="1">
                 </div>       
                </li>

                <li>

                    <!-- <span class="errorTips">错误提示信息...</span> -->
                     <div class="form-group" >
                     	<div>
						<span class="item_name" style="width:120px;">头条内容:</span>
						<!-- 加载编辑器的容器 -->
						</div>

						<div style="margin-left: 60px;margin-top: 10px;">
						<script style="height:200px;width:1000px"; id="container" name="hcontent" type="text/plain">

						</script>
						</div>

					</div>
                </li>


            </ul>

            <div style="margin: -2px;margin-left: 59px;margin-top:-10px;margin-bottom:20px;" >
                    <input  type="submit" class="link_btn" value="添加头条">
                    </div>
        </form>

    </div>



</section>
@endsection