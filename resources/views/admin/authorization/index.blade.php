@extends('admin.layouts.app')

@section('content')

    <style>

    </style>

    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-header">授权说明</div>
                    <div class="layui-card-body">
                        <div class="layui-collapse" lay-filter="component-panel">
                            <div class="layui-colla-item">
                                <h2 class="layui-colla-title">什么是软件授权？<i
                                            class="layui-icon layui-colla-icon"></i></h2>
                                <div class="layui-colla-content layui-show">
                                    <p>
                                        软件授权是软件保护概念的延伸和发展。软件授权的目标是让软件用户按照购买许可来使用软件，涉及软件的安装份数，使用时间，应用范围以及功能模块等内容。
                                        在本项目的实施工作中，所使用的技术框架、三方sdk、SaaS、IaaS、PaaS级能力平台均已得到授权，我公司已经向相关的服务提供商付费，该项目有权使用相关服务，请您放心使用本系统。
                                    </p>
                                </div>
                            </div>
                            <div class="layui-colla-item">
                                <h2 class="layui-colla-title">为什么系统需要持续的维护和升级？<i
                                            class="layui-icon layui-colla-icon"></i></h2>
                                <div class="layui-colla-content layui-show">
                                    <p>
                                        软件服务是长期、持续的业务服务，应用系统应根据业务的发展持续迭代，我们在长期的项目工作中，总结出“永远的Beta”版原则，即适应互联网的快速发展特性，通过敏捷开发的方式，提升体验和能力。
                                        最终目标是服务业务、创造价值、提升业绩。我们秉承“专业人干专业事”的原则，向客户不仅仅输出业务系统，更包含了运营经验、管理经验和落地工作的方法论，协助客户搭建运营体系，希望本系统可以为贵公司创造价值，降低成本、提升效率、创新模式，让贵公司的业务更上一层楼。
                                    </p>
                                </div>
                            </div>
                            <div class="layui-colla-item">
                                <h2 class="layui-colla-title">我们的系统安全性和稳定性？<i
                                            class="layui-icon layui-colla-icon"></i></h2>
                                <div class="layui-colla-content layui-show">
                                    <p>
                                        公司选用业界最优的基础架构解决方案，包括阿里云、腾讯云、七牛云、秒滴云、环信、融云等，均可以保证99.999%（全年宕机不超过2小时）的稳定性服务，公司的相关业务统一部署在规定的基础架构下，统一提供系统巡检、性能监控、业务拨测、数据备份等服务，在维护期内不做另外收费。
                                        但由于多个业务混合部署，在其他应用部署时，可能需要业务重启，会导致1分钟左右的中断，公司规定每晚业务闲时（22:00后）进行业务部署，如果您的业务需要较高的稳定性，不希望与其他业务混合部署，可以另外签署服务协议，公司将安排人员提供更优质的基础架构服务。
                                    </p>
                                </div>
                            </div>
                            <div class="layui-colla-item">
                                <h2 class="layui-colla-title">为了确保软件，我们都做了什么？<i
                                            class="layui-icon layui-colla-icon"></i></h2>
                                <div class="layui-colla-content layui-show">
                                    <p>
                                        我们重视口碑和服务，这也是我们立足之本。为了确保软件服务，我们使用三套环境，分别是开发环境、测试环境、生产环境，开发环境用于业务系统的调试和开发；测试环境用线上流程穿越和体验测试；生产环境部署后，定期进行系统基线检查和日志巡检，确保稳定性和质量。
                                        在代码开发过程中，团队梳理了可控、可回溯的项目执行过程监控规范，确保项目的进度和质量；代码实现时，依赖于多年累积的经验和顶层设计思想，基于规范进行实施，定期进行代码review，确保业务的扩展性。
                                        希望贵公司业务能够蓬勃发展，创造更广阔的合作空间。
                                    </p>
                                </div>
                            </div>
                        </div>
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

                ajaxRequest('{{URL::asset('/admin/ad/setStatus')}}/' + id, param, "GET", function (ret) {
                    if (ret.result) {
                        layer.msg('已经启用');
                        $("#search_form").submit();
                    } else {
                        layer.msg(ret.message, {icon: 5, time: 1000});
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

                ajaxRequest('{{URL::asset('/admin/ad/setStatus')}}/' + id, param, "GET", function (ret) {
                    if (ret.result) {
                        layer.msg('已经停用');
                        $("#search_form").submit();
                    } else {
                        layer.msg(ret.message, {icon: 5, time: 1000});
                    }
                    layer.close(loadding_index);
                });
            });
        }


        /*
         * 展示详细信息
         *
         * By TerryQi
         *
         * 2018-07-07
         *
         */
        function info(title, url) {
            //方式1：全屏打开
            // var index = layer.open({
            //     type: 2,
            //     title: title,
            //     content: url
            // });
            // layer.full(index);

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
            parent.layui.index.openTabsPage(url, title);
        }

        /*
         * 页面刷新
         * 
         * By TerryQi
         *
         */
        function refresh() {
            reloadPage();
        }

    </script>
@endsection