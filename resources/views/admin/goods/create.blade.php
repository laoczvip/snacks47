@extends('admin.index.index')

@section('center')
    <script type="text/javascript">
        var ue = UE.getEditor('content',{
          toolbars: [
                        ['emotion','spechars','snapscreen', 
                        'fontfamily', 'fontsize', 
                        'simpleupload',  'insertimage',
                        ],
                    ]
        });
    </script>
<script type="text/javascript">
        var ue = UE.getEditor('content1',{
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
        <form action="/admin/goods" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
            <ul class="ulColumn2">
                 <li>
                    <span class="item_name" style="width:120px;">商品类:</span>
                        <select name="cid" class="select">
                        @forelse($cates as $k=>$v)
                        @if($v->pid==0)  
                            <option value="0" disabled>{{$v->title}}</option>                      
                        @elseif(substr_count($v->title,'|--')==2)
                            <option value="0" disabled>{{$v->title}}</option>
                        @else
                             <option value="{{$v->id}}">{{$v->title}}</option>  
                        @endif
                        @empty
                        @endforelse
                        </select>
                </li>
                  <li>
                    <span class="item_name" style="width:120px;">商品名称:</span>
                    <input type="text" name="title" class="textbox textbox_225" value="{{ old('number') }}" placeholder="请输入4~16位字母或者数字"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>

                <li>
                    <span class="item_name" style="width:120px;">展示图:</span>
                    <label class="uploadImg">
                        <input name="showcase" type="file" >
                        <!-- <span>上传头像</span> -->
                    </label>
                </li>                
                <li>
                    <span class="item_name" style="width:120px;">口味:</span>
                    <select name="flavorties">
                    @forelse($flavour as $k=>$v)
                        <option value="{{$v->id}}">{{$v->fname}}</option>
                    @empty
                    @endforelse
                    </select>
                </li>
                 <li>
                    <span class="item_name" style="width:120px;">商品原价:</span>
                    <input type="text" name="original" class="textbox textbox_225" value="{{ old('number') }}" placeholder="请输入4~16位字母或者数字"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                <li>
                    <span class="item_name" style="width:120px;">商品价格:</span>
                    <input type="text" name="price" class="textbox textbox_225" value="{{ old('number') }}" placeholder="请输入4~16位字母或者数字"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                  <li>
                    <span class="item_name" style="width:120px;">商品库存:</span>
                    <input type="text" name="stock" class="textbox textbox_225" value="{{ old('number') }}" placeholder="请输入4~16位字母或者数字"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                 <li>
                    <span class="item_name" style="width:120px;">商品重量:</span>
                    <input type="text" name="weight" class="textbox textbox_225" value="{{ old('number') }}" placeholder="请输入4~16位字母或者数字"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                  <li>
                    <span class="item_name" style="width:120px;">商品状态:</span>
                    <select name="status">
                        <option value="1">----下架----</option>
                        <option value="0">----上架----</option>
                        <option value="-1">----已删除----</option>
                    </select>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                   <li>
                    <span class="item_name" style="width:120px;">商品参数:</span>
                                   <!-- 实例化编辑器 -->
                         <div style="width:800px; 
                                     display: -webkit-box;
                                    -webkit-box-orient: vertical;             
                                    -webkit-line-clamp: 3;
                                    overflow: hidden;">
                        <script id="content" name="parameter" type="text/plain"></script>
                        </div>
                   
                </li>
                    <li>
                    <span class="item_name" style="width:120px;">商品描述:</span>
                                   <!-- 实例化编辑器 -->
                         <div style="width:800px; 
                                     display: -webkit-box;
                                    -webkit-box-orient: vertical;             
                                    -webkit-line-clamp: 3;
                                    overflow: hidden;">
                        <script id="content1" name="desc" type="text/plain"></script>
                        </div>
                   
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