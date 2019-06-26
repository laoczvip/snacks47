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
    <div class="rt_content">
            <div class="page_title">
                <h2 class="fl">修改头条</h2>
            </div>
        
        
        </div>
        <div style="margin-top: -70px";>
        <form action="/admin/headlines/{{ $data->id }}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      {{method_field('PUT')}}
            
            <ul class="ulColumn2">
                
                
                <li>
                    <span class="item_name" style="width:120px;">头条标题:</span>
                    <input type="text" name="htitle" class="textbox textbox_225" value="{{ $data->htitle }}" placeholder="请输入头条的标题"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;">头条作者:</span>
                    <input type="text" name="auth" class="textbox textbox_225" value="{{ $data->auth }}" placeholder="请输入头条的描述"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                   
                    
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                     <div class="form-group" style="position:relative;"> 
                     	<div>
						<span class="item_name" style="width:120px;margin-left: 60px;">头条内容:</span>
						<!-- 加载编辑器的容器 -->
						</div>
						
						<div style="margin-left: 60px;margin-top: 10px;width: 70%">
						<script style="height:150px;width:800px"; id="container" name="hcontent" type="text/plain">{!! $data->hcontent !!}			        
						</script>
						</div>								   
	                   <div style="position:fixed;bottom:15px;left:80%;float: bottom;">
                            <input  type="submit" class="link_btn" value="提交">
                       </div>
                
            </ul>
                    
                    
                    
        </form>
    


    </div>
    </div>
</section>
@endsection