<div class="wrap-container welcome-container" style="margin-left:215px;">
        <div class="row">
            <div class="welcome-left-container col-lg-9">
                <div class="data-show">
                    <ul class="clearfix">
                        <li class="col-sm-12 col-md-4 col-xs-12">
                            <a href="javascript:;" class="clearfix">
                                <div class="icon-bg bg-org f-l">
                                    <span class="iconfont">&#xe606;</span>
                                </div>
                                <div class="right-text-con">
                                    <p class="name">会员数</p>
                                    <p><span class="color-org">
                                    @if(Request::path() == 'admin')
                                        {{$num}}
                                    @else
                                    2
                                    @endif
                                    </span>数据<span class="iconfont">&#xe628;</span></p>
                                </div>
                            </a>
                        </li>
                        <li class="col-sm-12 col-md-4 col-xs-12">
                            <a href="javascript:;" class="clearfix">
                                <div class="icon-bg bg-blue f-l">
                                    <span class="iconfont">&#xe602;</span>
                                </div>
                                <div class="right-text-con">
                                    <p class="name">文章数</p>
                                    <p><span class="color-blue">189</span>数据<span class="iconfont">&#xe628;</span></p>
                                </div>
                            </a>
                        </li>
                        <li class="col-sm-12 col-md-4 col-xs-12">
                            <a href="javascript:;" class="clearfix">
                                <div class="icon-bg bg-green f-l">
                                    <span class="iconfont">&#xe605;</span>
                                </div>
                                <div class="right-text-con">
                                    <p class="name">评论数</p>
                                    <p><span class="color-green">221</span>数据<span class="iconfont">&#xe60f;</span></p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <!--图表-->
                <div class="chart-panel panel panel-default">
                    <div class="panel-body" id="chart" style="height: 376px;">
                    </div>
                </div>
                <!--服务器信息-->
                <div class="server-panel panel panel-default">
                    <div class="panel-header">服务器信息</div>
                    <div class="panel-body clearfix">
                        <div class="col-md-2">
                            <p class="title">服务器环境</p>
                            <span class="info">Apache/2.4.4 (Win32) PHP/5.4.16</span>
                        </div>
                        <div class="col-md-2">
                            <p class="title">服务器IP地址</p>
                            <span class="info">127.0.0.1   </span>
                        </div>
                        <div class="col-md-2">
                            <p class="title">服务器域名</p>
                            <span class="info">localhost </span>
                        </div>
                        <div class="col-md-2">
                            <p class="title"> PHP版本</p>
                            <span class="info">5.4.16</span>
                        </div>
                        <div class="col-md-2">
                            <p class="title">数据库信息</p>
                            <span class="info">5.6.12-log </span>
                        </div>
                        <div class="col-md-2">
                            <p class="title">服务器当前时间</p>
                            <span class="info">2016-06-22 11:37:35</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>