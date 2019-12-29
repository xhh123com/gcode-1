<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{env('APP_NAME', '')}} | 管理后台</title>
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="Bookmark" href="{{ URL::asset('img/favor.ico') }}">
    <link rel="Shortcut Icon" href="{{ URL::asset('img/favor.ico') }}"/>
    {{--layui--}}
    <link rel="stylesheet" href="{{ asset('lib/layuiAdmin.std-v1.2.1/dist/layuiadmin/layui/css/layui.css') }}"
          media="all">
    <link rel="stylesheet" href="{{ asset('lib/layuiAdmin.std-v1.2.1/dist/layuiadmin/style/admin.css') }}"
          media="all">
    <link rel="stylesheet" href="{{ asset('lib/layuiAdmin.std-v1.2.1/dist/layuiadmin/style/login.css') }}"

          media="all">
    {{--引入自定义的公共common.css--}}
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/common.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/login.css') }}"/>

</head>
<style>

    body {
        background: url("{{URL::asset('/img/web_login_bg.jpg')}}") no-repeat center;
        background-size: cover;
    }

</style>
<body>

<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">

    <div class="layadmin-user-login-main" style="background: white;border-radius: 1rem;">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2>{{env('APP_NAME','')}} | 管理后台</h2>
            <p>业务管理后台，如需登录平台请联系业务负责人</p>
        </div>
        <div action="" method="post" class="layadmin-user-login-box layadmin-user-login-body layui-form">
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-username"
                       for="LAY-user-login-username"></label>
                <input type="text" name="phonenum" id="LAY-user-login-username" lay-verify="required|phone"
                       placeholder="用户名"
                       class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-password"
                       for="LAY-user-login-password"></label>
                <input type="password" name="password" id="LAY-user-login-password" lay-verify="required"
                       placeholder="密码" class="layui-input">
            </div>
            <div class="layui-form-item">
                <div class="layui-row">
                    <div class="layui-col-xs7">
                        <label class="layadmin-user-login-icon layui-icon layui-icon-vercode"
                               for="LAY-user-login-vercode"></label>
                        <input type="text" name="captcha_code" id="LAY-user-login-vercode" lay-verify="required"
                               placeholder="图形验证码" class="layui-input">
                    </div>
                    <div class="layui-col-xs5">
                        <div style="margin-left: 10px;">
                            <img src="{{ URL::asset('captcha/code/1') }}" class="layadmin-user-login-codeimg"
                                 id="LAY-user-get-vercode" onclick="re_vercode()">
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-form-item" style="margin-bottom: 20px;">
                <input type="checkbox" name="remember" lay-skin="primary" title="记住密码" checked>
                <a href="#" class="layadmin-user-jump-change" style="margin-top: 7px;">忘记密码？</a>
            </div>
            <div class="layui-form-item">
                <button class="login layui-btn-fluid " lay-submit lay-filter="LAY-user-login-submit">登 入</button>
            </div>
        </div>
    </div>

    <div class="layui-trans layadmin-user-login-footer">

        <p>© 2019 - 2020 <a href="#" target="_blank">{{env('DEVEOPLER','')}}</a></p>
    </div>

</div>

<script src="{{ asset('lib/layuiAdmin.std-v1.2.1/dist/layuiadmin/layui/layui.js') }}"></script>
<!-- common -->
<script type="text/javascript" src="{{ URL::asset('lib/jquery/1.9.1/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/common.js') }}"></script>
<!-- md5 -->
<script src="{{ URL::asset('js/md5.js') }}"></script>

<script>

    var layer = null;
    var form = null;


    layui.config({
        base: '{{ asset('lib/layuiAdmin.std-v1.2.1/dist/layuiadmin/') }}/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    });

    $(function () {
        if (top.location != self.location) top.location = self.location;
    });


    layui.use(['index', 'form', 'layer'], function () {
        layer = layui.layer;        //初始化layer
        form = layui.form;

        form.render();

        //监听提交
        form.on('submit(LAY-user-login-submit)', function (data) {
            var param = data.field;
            consoledebug.log("param:" + JSON.stringify(param));
            //密码进行md5加密
            var password = $("#LAY-user-login-password").val();
            var md5_password = hex_md5(password);
            //param的password更改为md5加密后的password
            param.password = md5_password;

            var loadding_index = layer.load(1, {time: 10 * 1000});   //加载

            //进行请求
            ajaxRequest('{{URL::asset('/admin/login')}}', param, "POST", function (ret) {
                if (ret.result) {
                    layer.msg('登录成功');
                    window.location.replace("{{URL::asset('/admin/index')}}");      //后台主页
                } else {
                    layer.msg(ret.message);
                }
                layer.close(loadding_index);
            });
        });
    });


    /*
     * 切换图片验证码
     */
    function re_vercode() {
        layer.load(1, {time: 0.3 * 1000}); //加载
        var url = "{{ URL::asset('captcha/code') }}";
        url = url + "/" + Math.random();
        consoledebug.log("re_vercode url:" + url);
        document.getElementById('LAY-user-get-vercode').src = url;
    }

</script>
</body>
</html>