@extends('admin.layouts.app')

@section('content')

    <style>

    </style>

    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-form layui-card-header layuiadmin-card-header-auto">
                <form id="search_form" class="layui-form" method="post"
                      action="{{URL::asset('admin/admin/index')}}?page={{$datas->currentPage()}}">
                    {{csrf_field()}}
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">角色</label>
                            <div class="layui-input-inline">
                                <select name="role">
                                    <option value="" {{$con_arr['role']==""?'selected':''}}>请选择</option>
                                    @foreach(\App\Components\Project::ADMIN_ROLE_VAL as $key=>$value)
                                        <option value="{{$key}}" {{$con_arr['role']==strval($key)?'selected':''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">关键字</label>
                            <div class="layui-input-block">
                                <input type="text" name="search_word" placeholder="请输入姓名、电话" autocomplete="off"
                                       value="{{$con_arr['search_word']}}"
                                       class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button class="layui-btn layuiadmin-btn-forum-list" type="submit" lay-submit=""
                                    lay-filter="LAY-app-forumlist-search">
                                <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                            </button>
                            <button class="layui-btn layuiadmin-btn-forum-list btn-fresh" type="button"
                                    onclick="refresh()">
                                <i class="layui-icon layui-icon-refresh layuiadmin-button-btn"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="layui-card-body">
                <div style="padding-bottom: 10px;">
                    <button class="layui-btn layuiadmin-btn-forum-list"
                            onclick="edit('添加管理员','{{URL::asset('admin/admin/edit')}}')">
                        添加管理员
                    </button>
                </div>
                <div>
                    <table class="layui-table text-c" style="width: 100%;">
                        <thead>
                        <th scope="col" colspan="100">
                            <span>共有<strong>{{$datas->total()}}</strong> 条数据</span>
                        </th>
                        <tr>
                            <th class="text-c" width="20">ID</th>
                            <th class="text-c" width="20">头像</th>
                            <th class="text-c" width="50">名称</th>
                            <th class="text-c" width="80">手机</th>
                            <th class="text-c" width="40">角色</th>
                            <th class="text-c" width="100">创建时间</th>
                            <th class="text-c" width="40">状态</th>
                            <th class="text-c" width="120">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>
                                    <img src="{{ $data->avatar ? $data->avatar.'?imageView2/1/w/200/h/200/interlace/1/q/75|imageslim' : Url::asset('/img/default_headicon.png')}}"
                                         class="img-rect-30 radius-5 img-pic">
                                </td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->phonenum}}</td>
                                <td>{{$data->role_str}}</td>
                                <td>{{$data->created_at}}</td>
                                <td>
                                    @if($data->status == \App\Components\Common\Utils::STATUS_VALUE_1)
                                        <span class="layui-badge layui-bg-blue">启用</span>
                                    @else
                                        <span class="layui-badge layui-bg-gray">停用</span>
                                    @endif

                                </td>
                                <td>
                                    <div>
                                        <button class="layui-btn layui-btn-sm" onclick="start(this,{{$data->id}})">
                                            启用
                                        </button>
                                        <button class="layui-btn layui-btn-sm" onclick="stop(this,{{$data->id}})">
                                            停用
                                        </button>
                                        <button class="layui-btn layui-btn-sm"
                                                onclick="edit('编辑管理员','{{URL::asset('admin/admin/edit')}}?id={{$data->id}})',{{$data->id}})">
                                            编辑
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="">
                    <div class="">
                        {{ $datas->appends($con_arr)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

        //初始化layer
        var layer = null;
        var form = null;

        // 入口函数
        $(function () {
            //点击图片进行展示
            $(".img-pic").on("click", function (e) {
                layer.photos({
                    photos: {"data": [{"src": e.target.src}]}
                });
            });
        });

        //初始化模块
        layui.use(['index', 'layer', 'form', 'set', 'laypage'], function () {
            layer = layui.layer;        //初始化layer
            form = layui.form;

        });

        /*编辑*/
        function edit(title, url, id) {
            console.log("edit url:" + url);

            //方式1：全屏打开
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);

            //方式2：固定窗口大小
            // var index = layer.open({
            //     type: 2,
            //     area: ['850px', '550px'],
            //     fixed: false,
            //     maxmin: true,
            //     title: title,
            //     content: url
            // });

            //方式3：新建tab页
            // parent.layui.index.openTabsPage(url, title);
        }

        /*启用*/
        function start(obj, id) {
            layer.confirm('确认要启用吗？', function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                var param = {
                    id: id,
                    status: 1,
                    _token: "{{ csrf_token() }}"
                }
                var loadding_index = layer.load(1, {time: 10 * 1000});   //加载

                ajaxRequest('{{URL::asset('/admin/admin/setStatus')}}/' + id, param, "GET", function (ret) {
                    if (ret.result) {
                        layer.msg('已经启用');
                        $("#search_form").submit();
                    } else {
                        layer.msg(ret.message);
                    }
                    layer.close(loadding_index);
                });
            });
        }

        /*停用*/
        function stop(obj, id) {
            layer.confirm('确认要停用吗？', function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                var param = {
                    id: id,
                    status: 0,
                    _token: "{{ csrf_token() }}"
                }
                var loadding_index = layer.load(1, {time: 10 * 1000});   //加载

                ajaxRequest('{{URL::asset('/admin/admin/setStatus')}}/' + id, param, "GET", function (ret) {
                    if (ret.result) {
                        layer.msg('已经停用');
                        $("#search_form").submit();
                    } else {
                        layer.msg(ret.message);
                    }
                    layer.close(loadding_index);
                });
            });
        }


        /*
         * 展示用户详细信息
         *
         * By TerryQi
         *
         * 2018-07-07
         *
         */
        function info(title, url) {
            creatIframe(url, title)
        }

        /*
         * 页面刷新
         * 
         * By TerryQi
         *
         */
        function refresh() {
            $('#search_form')[0].reset();
            location.replace('{{URL::asset('/admin/admin/index')}}');
        }

    </script>
@endsection