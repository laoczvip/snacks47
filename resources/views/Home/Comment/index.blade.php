<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

        <title>评价管理</title>
       

        <script type="text/javascript" src="/bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
       <link href="/bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
        <link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

        <link href="/h/css/personal.css" rel="stylesheet" type="text/css">
        <link href="/h/css/cmstyle.css" rel="stylesheet" type="text/css">

        <script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
        <script src="/h/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
       

    </head>

    <body>
        <!--头 -->
        @include('home.public.hmtop')
        <div class="nav-table">
            <div class="long-title"><span class="all-goods">全部分类</span></div>
            <div class="nav-cont">
                <ul>
                    <li class="index"><a href="#">首页</a></li>
                    <li class="qc"><a href="#">闪购</a></li>
                    <li class="qc"><a href="#">限时抢</a></li>
                    <li class="qc"><a href="#">团购</a></li>
                    <li class="qc last"><a href="#">大包装</a></li>
                </ul>
                <div class="nav-extra">
                    <i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
                    <i class="am-icon-angle-right" style="padding-left: 10px;"></i>
                </div>
            </div>
        </div>
        <b class="line"></b>
        <div class="center">
            <div class="col-main">
                <div class="main-wrap">

                    <div class="user-comment">
                        <!--标题 -->
                        <div class="am-cf am-padding">
                            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">评价管理</strong> / <small>Manage&nbsp;Comment</small></div>
                        </div>
                        <hr/>

                        <div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

                            <ul class="am-avg-sm-2 am-tabs-nav am-nav am-nav-tabs">
                                <li class="am-active"><a href="#tab1">所有评价</a></li>
                              
                            </ul>
                            <style>
                               .comment-list table{
                                    width:100%;
                                    text-align:center;
                                }
                                .comment-list table th{
                                    text-align:center;
                                }
                                .comment-list table tr{
                                    border-bottom:1px dashed #ccc;
                                     
                                }
                                .comment-list table td{
                                    height:100px;
                                    line-height:100px;
                                }
                                table i{
                                    padding:5px;
                                    color:#fff;
                                }
                            </style>
                            <div class="am-tabs-bd">
                                <div class="am-tab-panel am-fade am-in am-active" id="tab1">

                                    <div class="comment-main">
                                        <div class="comment-list">
                                      
                                            <table>
                                            <tr>
                                                <th>商品图片</th>
                                                <th>商品名</th>
                                                <th>评价等级</th>
                                                <th>评价内容</th>
                                                <th>评价时间</th>
                                                <th>操作</th>
                                            </tr>
                                              @forelse($comments as $v)
                                            <tr>
                                                <td><img width="150" style="text-align:center;vertical-align:middle;" class="img-thumbnail"  src="/uploads/{{$Goods_Profile[$v->gid]}}"></td>
                                                <td>{{$Goods_Name[$v->gid]}}</td>
                                                <td>
                                                
                                                    @if($v->rank==1)
                                                    <i style="background-color:red;">好评</i>
                                                    @elseif($v->rank==2)
                                                    <i style="background-color:green;">中评</i>
                                                    @else
                                                    <i style="background-color:#ccc;">差评</i>
                                                    @endif
                                                
                                                </td>
                                                <td style="overflow:hidden">{!!$v->content!!}</td>
                                                <td>{{$v->created_at}}</td>
                                                <td><a href="javascript:;" onclick="del({{ $v->id }},this)"><span class="glyphicon glyphicon-trash" aria-hidden="true" title="删除"></a></td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td>暂无评论</td>
                                            </tr>
                                            @endforelse
                                           </table>
         <script src="/layui/layui.js">
               layui.use('layer',
                    function(){
                        var layer = layui.layer;
                });
         </script>                                   
            <script type="text/javascript">
              // 删除
              function del(id,obj){
                    var a = confirm('你确定要删除吗?');

                if(a){
                   $.get('/home/comment/destroys',{id:id},function(res){
                  // console.log(id);
                  if(res == '删除成功'){
                     layer.msg(res, {icon: 1});
                    // 删除tr节点
                    $(obj).parent().parent().remove();
                  }else{
                     layer.msg(res, {icon: 5});
                  }
                },'json');
                
                }

               

              }
            </script>

                                        </div>
                                    </div>

                                </div>
                          
                            </div>
                        </div>

                    </div>

                </div>
                <!--底部-->
                @include('home.public.footer')
            </div>
            @include('home.public.list')
        </div>

    </body>

</html>