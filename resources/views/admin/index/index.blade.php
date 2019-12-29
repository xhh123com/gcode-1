@extends('admin.layouts.app')

@section('content')
    <div id="LAY_app">
        <div class="layui-layout layui-layout-admin">
            <div class="layui-header">
                <!-- 头部区域 -->
                <ul class="layui-nav layui-layout-left">
                    <li class="layui-nav-item layadmin-flexible" lay-unselect>
                        <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
                            <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
                        </a>
                    </li>
                    {{--<li class="layui-nav-item layui-hide-xs" lay-unselect>--}}
                    {{--<a href="http://www.layui.com/admin/" target="_blank" title="前台">--}}
                    {{--<i class="layui-icon layui-icon-website"></i>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    <li class="layui-nav-item" lay-unselect>
                        <a href="javascript:;" layadmin-event="refresh" title="刷新">
                            <i class="layui-icon layui-icon-refresh-3"></i>
                        </a>
                    </li>
                    {{--<li class="layui-nav-item layui-hide-xs" lay-unselect>--}}
                    {{--<input type="text" placeholder="搜索..." autocomplete="off" class="layui-input layui-input-search"--}}
                    {{--layadmin-event="serach" lay-action="template/search.html?keywords=">--}}
                    {{--</li>--}}
                </ul>
                <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">

                    {{--<li class="layui-nav-item" lay-unselect>--}}
                    {{--<a lay-href="app/message/index.html" layadmin-event="message" lay-text="消息中心">--}}
                    {{--<i class="layui-icon layui-icon-notice"></i>--}}

                    {{--<!-- 如果有新消息，则显示小圆点 -->--}}
                    {{--<span class="layui-badge-dot"></span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="layui-nav-item layui-hide-xs" lay-unselect>--}}
                    {{--<a href="javascript:;" layadmin-event="theme">--}}
                    {{--<i class="layui-icon layui-icon-theme"></i>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="layui-nav-item layui-hide-xs" lay-unselect>--}}
                    {{--<a href="javascript:;" layadmin-event="note">--}}
                    {{--<i class="layui-icon layui-icon-note"></i>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    <li class="layui-nav-item layui-hide-xs" lay-unselect>
                        <a href="javascript:;" layadmin-event="fullscreen">
                            <i class="layui-icon layui-icon-screen-full"></i>
                        </a>
                    </li>
                    <li class="layui-nav-item" lay-unselect>
                        <a href="javascript:;">
                            <cite>{{$self_admin->name}}</cite>
                        </a>
                        <dl class="layui-nav-child">
                            <dd><a lay-href="{{ URL::asset('/admin/admin/editMyself') }}">基本资料</a></dd>
                            <dd><a lay-href="{{ URL::asset('/admin/admin/editPassword') }}">修改密码</a></dd>
                            <hr>
                            <dd style="text-align: center;"><a
                                        href="{{ URL::asset('/admin/logout') }}">退出</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item layui-hide-xs" lay-unselect>
                        <a href="javascript:;"><i
                                    class="layui-icon layui-icon-more-vertical"></i></a>
                    </li>
                </ul>
            </div>

            <!-- 侧边菜单 -->
            <div class="layui-side layui-side-menu">
                <div class="layui-side-scroll">
                    <div class="layui-logo" lay-href="{{ URL::asset('/admin/admin/index') }}">
                        <span>{{env('APP_NAME', '')}} | 管理后台</span>
                    </div>

                    <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu"
                        lay-filter="layadmin-system-side-menu">

                        <li data-name="component" class="layui-nav-item">
                            <a href="javascript:;" lay-tips="角色管理" lay-direction="2">
                                <i class="layui-icon layui-icon-user"></i>
                                <cite>角色管理</cite>
                            </a>
                            <dl class="layui-nav-child">
                                <dd data-name="button">
                                    <a lay-href="{{ URL::asset('/admin/admin/index') }}">管理员信息</a>
                                </dd>
                            </dl>
                        </li>
                        <li data-name="get" class="layui-nav-item">
                            <a href="javascript:;" lay-href="{{URL::asset('/admin/authorization/index')}}"
                               lay-tips="授权信息"
                               lay-direction="2">
                                <i class="layui-icon layui-icon-auz"></i>
                                <cite>授权信息</cite>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- 页面标签 -->
            <div class="layadmin-pagetabs" id="LAY_app_tabs">
                <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
                <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
                <div class="layui-icon layadmin-tabs-control layui-icon-down">
                    <ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
                        <li class="layui-nav-item" lay-unselect>
                            <a href="javascript:;"></a>
                            <dl class="layui-nav-child layui-anim-fadein">
                                <dd layadmin-event="closeThisTabs"><a href="javascript:;">关闭当前标签页</a></dd>
                                <dd layadmin-event="closeOtherTabs"><a href="javascript:;">关闭其它标签页</a></dd>
                                <dd layadmin-event="closeAllTabs"><a href="javascript:;">关闭全部标签页</a></dd>
                            </dl>
                        </li>
                    </ul>
                </div>
                <div class="layui-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
                    <ul class="layui-tab-title" id="LAY_app_tabsheader">
                        <li lay-id="{{ URL::asset('/admin/admin/error') }}"
                            lay-attr="{{ URL::asset('/admin/admin/error') }}" class="layui-this"><i
                                    class="layui-icon layui-icon-home"></i></li>
                    </ul>
                </div>
            </div>


            <!-- 主体内容 -->
            <div class="layui-body" id="LAY_app_body">
                <div class="layadmin-tabsbody-item layui-show">
                    <iframe src="{{ URL::asset('/admin/authorization/index') }}" frameborder="0"
                            class="layadmin-iframe"></iframe>
                </div>
            </div>

            <!-- 辅助元素，一般用于移动设备下遮罩 -->
            <div class="layadmin-body-shade" layadmin-event="shade"></div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">


        layui.use(['index'], function () {

        });


    </script>
@endsection


