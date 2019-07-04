@extends('admin.index.index')

@section('center')
    <script type="text/javascript">
        var ue = UE.getEditor('content',{
          toolbars: [[
                'fontfamily', 'fontsize',
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
        <style>
            td{padding: 10px;}
        </style>
        <form action="/admin/goods" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                <table style="margin-left:150px;">
                    <tr>
                        <td>商品类</td>
                        <td><select name="cid" class="select">
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
                        </select></td>
                    </tr>
                    <tr>
                        <td>商品名称</td>
                        <td><input type="text" name="title" class="textbox textbox_225" value="{{ old('title') }}" placeholder="请输入4~16位字母或者数字"/></td>
                    </tr>
                    <tr>
                        <td>展示图</td>
                        <td>
                        <label class="uploadImg">
                            <input name="showcase" value="{{old('showcase')}}" type="file" >
                        </label>
                        </td>
                    </tr>
                    <tr>
                        <td>口味属性</td>
                        <td id="Checkbox"><input type="text" id="getInput" class="textbox textbox_225" style="width:60px;font-size:1px;" title="" >
                        &nbsp;&nbsp;&nbsp;<input type="button" value="添加" onclick="test()" class="link_btn" />
                        <span></span>
                        </td>
                        <td id="Checkbox" ><span></span></td>
                    </tr>
                    <tr>
                        <td>商品价格</td>
                        <td>
                            <input type="text" name="price" value="{{old('price')}}" class="textbox textbox_225"  placeholder="请输入4~16位字母或者数字"/>
                        </td>
                    </tr>
                    <tr>
                        <td>商品库存</td>
                        <td><input type="text" name="stock" class="textbox textbox_225" value="{{ old('stock') }}" placeholder="请输入4~16位字母或者数字"/></td>
                    </tr>
                    <tr>
                        <td>商品状态</td>
                        <td><select name="status">
                        <option value="1">----下架----</option>
                        <option value="0">----上架----</option>
                        <option value="-1">----已删除----</option>
                    </select></td>
                    </tr>
                    <tr>
                        <td>商品参数</td>
                        <td>
                            <div style="width:800px;
                                    display: -webkit-box;
                                    -webkit-box-orient: vertical;
                                    -webkit-line-clamp: 3;
                                    overflow: hidden;">
                            <script id="content" name="parameter" type="text/plain" style="height:150px;">{!!old('parameter') !!}</script>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>商品描述</td>
                        <td>
                            <div style="width:800px;
                                     display: -webkit-box;
                                    -webkit-box-orient: vertical;
                                    -webkit-line-clamp: 3;
                                    overflow: hidden;">
                        <script id="content1" name="desc"  type="text/plain" style="height:200px;">{!!old('desc')!!}</script>
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" class="link_btn" value="添加商品"></td>
                    </tr>
                </table>

<script>

function test() {
    var getInput = document.getElementById('getInput');
    var a = $(getInput).val();

    if(a){
        $('#Checkbox').append(a+"<input type='checkbox' name='fname[]' value='"+a+"' checked/ style='margin-left:10px;'>");
    }

}
</script>

        </form>
    </div>
</section>
@endsection