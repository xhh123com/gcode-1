<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{env('APP_NAME', '')}} | 管理后台</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
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
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/common.css') }}"/>

    @yield('header')

    <script>

    </script>
</head>

<body class="layui-layout-body">


<script src="{{ asset('lib/layuiAdmin.std-v1.2.1/dist/layuiadmin/layui/layui.js') }}"></script>
{{--doT、md5、七牛等相关--}}
<script type="text/javascript" src="{{ URL::asset('/lib/jquery/1.9.1/jquery.min.js') }}"></script>
{{--<script type="text/javascript" src="{{ URL::asset('/js/doT.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ URL::asset('/js/md5.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ URL::asset('/js/qiniu.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ URL::asset('/js/plupload/plupload.full.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ URL::asset('/js/plupload/moxie.js') }}"></script>--}}

{{--common.js--}}
<script type="text/javascript" src="{{ URL::asset('/js/common.js') }}"></script>
{{--<script type="text/javascript" src="{{ URL::asset('/js/echarts.common.min.js') }}"></script>--}}

{{--高德地图--}}
{{--!!!请注意，非常不建议再此处引入高德地图脚本，最好在使用页面引入，因为会降低所有页面的性能--}}
{{--<script src="https://webapi.amap.com/maps?v=1.4.14&key={{env('AMAP_KEY')}}"></script>--}}
{{--<script type="text/javascript"--}}
{{--src="https://webapi.amap.com/maps?v=1.4.14&key={{env('AMAP_KEY')}}&plugin=AMap.Geocoder"></script>--}}

<script type="text/javascript">

    DEBUG = '{{env('APP_DEBUG',false)}}';

    layui.config({
        base: '{{ asset('lib/layuiAdmin.std-v1.2.1/dist/layuiadmin/') }}/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    });

</script>

@yield('script')

@yield('content')

</body>

</html>




