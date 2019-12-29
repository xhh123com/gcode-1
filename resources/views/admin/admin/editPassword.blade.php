@extends('admin.layouts.app')

@section('content')

    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-header">修改密码</div>
                    <div class="layui-card-body" pad15>

                        <div action="" method="post" class="layui-form" lay-filter="">
                            <div class="layui-form-item">
                                <label class="layui-form-label">当前密码</label>
                                <div class="layui-input-inline">
                                    <input type="password" id="LAY_old_password" name="old_password"
                                           lay-verify="required" lay-verType="tips"
                                           class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">新密码</label>
                                <div class="layui-input-inline">
                                    <input type="password" name="password" lay-verify="pass" lay-verType="tips"
                                           autocomplete="off" id="LAY_password" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">6到16个字符</div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">确认新密码</label>
                                <div class="layui-input-inline">
                                    <input type="password" name="repassword" lay-verify="repass" lay-verType="tips"
                                           id="LAY_repassword"
                                           autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button class="layui-btn" lay-submit lay-filter="LAY-form-edit">确认修改</button>
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

        var layer = null;
        var form = null;

        layui.use(['index', 'set', 'layer'], function () {
            layer = layui.layer;        //初始化layer
            form = layui.form;

            form.render();

            //表单提交
            form.on('submit(LAY-form-edit)', function (data) {
                var param = data.field;
                consoledebug.log("param:" + JSON.stringify(param));

                //密码进行md5加密
                var old_password = $("#LAY_old_password").val();
                var md5_old_password = hex_md5(old_password)

                var password = $("#LAY_password").val();
                var md5_password = hex_md5(password);

                var repassword = $("#LAY_repassword").val();
                var md5_repassword = hex_md5(repassword)

                //param的password更改为md5加密后的password
                param.old_password = md5_old_password;
                param.password = md5_password;
                param.repassword = md5_repassword;

                var loadding_index = layer.load(1, {time: 10 * 1000});   //加载
                //进行请求
                ajaxRequest('{{URL::asset('/admin/admin/editPassword')}}', param, "POST", function (ret) {
                    if (ret.result) {
                        layer.msg('修改密码成功');
                    } else {
                        layer.msg(ret.message);
                    }
                    layer.close(loadding_index);
                });
            });

        });


    </script>
@endsection