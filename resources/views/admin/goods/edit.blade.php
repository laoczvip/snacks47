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
        <form action="/admin/goods/update" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
            <ul class="ulColumn2">
                 <li>
                    <span class="item_name" style="width:120px;">商品类:</span>
                        <select name="cid" class="select">
                        @forelse($cates as $k=>$v)
                        @if($v->pid==0)
                            <option value="0" disabled>{{$v->title}}</option>
                        @else
                      
                             <option value="{{$v->id}}" @if($goods_sku->cid==$v->id) selected @endif>{{$v->title}}</option>
                        
                      
                        @endif
                        @empty
                        @endforelse
                        </select>
                </li>
                  <li>
                    <span class="item_name" style="width:120px;">商品名称</span>
                    <input type="text" name="title" class="textbox textbox_225" value="{{ $goods_sku->title }}" placeholder="请输入4~16位字母或者数字"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                 <li>
                    <span class="item_name" style="width:120px;">原图</span>
                    <label class="uploadImg">
                        <img src="/uploads/{{$goods_sku->showcase}}" >
                        <!-- <span>上传头像</span> -->
                    </label>
                    <input type="hidden" name="showcase" value="{{$goods_sku->showcase}}">
                    <input type="hidden" name="id" value="{{$goods_sku->gid}}">
                </li>
                <li>
                    <span class="item_name" style="width:120px;">展示图</span>
                    <label class="uploadImg">
                        <input name="showcase" type="file" >
                        <!-- <span>上传头像</span> -->
                    </label>
                </li>
                <li>
                    <span class="item_name" style="width:120px;">口味</span>
                    <select name="flavorties">
                    @forelse($flavour as $k=>$v)
                        <option value="{{$v->id}}" @if($v->id==$goods_sku->flavorties) selected @endif>{{$v->fname}}</option>
                    @empty
                    @endforelse
                    </select>
                </li>
                <li>
                    <span class="item_name" style="width:120px;">商品价格</span>
                    <input type="text" name="price" class="textbox textbox_225" value="{{ $goods_sku->price }}" placeholder="请输入4~16位字母或者数字"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                  <li>
                    <span class="item_name" style="width:120px;">商品库存</span>
                    <input type="text" name="stock" class="textbox textbox_225" value="{{ $goods_sku->stock }}" placeholder="请输入4~16位字母或者数字"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                 <li>
                    <span class="item_name" style="width:120px;">商品重量</span>
                    <input type="text" name="weight" class="textbox textbox_225" value="{{ $goods_sku->weight }}" placeholder="请输入4~16位字母或者数字"/>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                  <li>
                    <span class="item_name" style="width:120px;">商品状态</span>
                    <select name="status">
                        
                        <option value="1" @if($goods_sku->status==1) selected @endif>----下架----</option>
                        <option value="0" @if($goods_sku->status==0) selected @endif>----上架----</option>
                        <option value="-1" @if($goods_sku->status==-1) selected @endif>----已删除----</option>
                    </select>
                    <!-- <span class="errorTips">错误提示信息...</span> -->
                </li>
                    <li>
                    <span class="item_name" style="width:120px;">商品描述</span>
                                   <!-- 实例化编辑器 -->
                        <div style="width:800px; 
                                    height:300px; display: -webkit-box;
                                    -webkit-box-orient: vertical;             
                                    -webkit-line-clamp: 3;
                                    overflow: hidden;">
            
                              <script id="content" name="desc" type="text/plain" >

                            {!!$goods_sku->desc!!}
                        </script>
                        </div>
                      
                    
                   
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