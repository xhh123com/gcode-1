@extends('gcode.admin.layouts.app')

@section('content')
    <style>
        body {
            background: url("{{URL::asset('/img/background@3x.png')}}") no-repeat center;
            background-size: 100%;
            margin-left: -3rem;
        }

        .back-index {
            background-color: rgba(0, 0, 0, .05);
            color: white;
            margin-left: 8rem;
            font-size: 1rem;
            margin-top: 1rem;
        }

        div {
            color: white;
            margin-left: 11rem;
            font-size: 1.2rem;
            margin-top: 1rem;
        }

        p {
            margin-left: 8rem;
            color: white;
        }
    </style>

    <section class="container-fluid page-404 minWP">
        <p style="padding-top: 13rem;font-size: 2rem;">业务错误</p>
        <p class="error-info" style="font-size: 1rem;margin-top: 1rem;">
            <small style="font-size: 1.3rem">请试试以下方法：</small>
        </p>
        <div>
            @if($msg)
                <span>·</span>
                {{$msg}}
            @endif
        </div>

        <button class="layui-btn layui-btn-radius layui-btn-primary back-index" onclick="back_index();">
            回到首页
        </button>
    </section>

@endsection


@section('script')
    <script type="text/javascript">

        //返回首页
        function back_index() {
            location.replace('{{URL::asset('/admin/admin/index')}}');
        }

    </script>
@endsection