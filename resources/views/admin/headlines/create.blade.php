@extends('admin.index.index')

@section('center')


    <section class="rt_wrap content mCustomScrollbar">
    <div class="rt_content" style="margin-bottom: 10px;">
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
     
        <form action="/admin/headlines" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
            <ul class="ulColumn2">

            	<li>
                    <span class="item_name" style="width:120px;">头条标题:</span>
                    <input type="text" name="htitle" class="textbox textbox_225" value="{{ old('htitle') }}" placeholder="请输入头条的标题"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
               
                <li>
                    <span class="item_name" style="width:120px;">头条作者:</span>
                    <input type="text" name="auth" class="textbox textbox_225" value="{{ old('auth') }}" placeholder="请输入头条的作者"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
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
           
            <div style="margin-left:60px;margin-bottom:10px";>
                    <input  type="submit" class="link_btn" value="添加头条">
                    </div>
        </form>
       
    </div>
    <!-- 配置文件 -->
	 <script type="text/javascript" src="/utf8-php/ueditor.config.js"></script>
	<!-- 编辑器源码文件 -->
	<script type="text/javascript" src="/utf8-php/ueditor.all.js"></script> 


	<!-- 实例化编辑器 -->
	<script type="text/javascript">
						        var ue = UE.getEditor('container',{toolbars: [
    	['fullscreen', 'source', 'undo', 'redo', 'bold', 'emotion','simpleupload']
	]});
	</script>
	<div class="main-page" style="display:none;">
				
	<div class="row calender widget-shadow">
		<h4 class="title">Calender</h4>
		<div class="cal1">
						
		</div>
	</div>
	<div class="clearfix"> </div>
	</div>
					
				
</section>
@endsection