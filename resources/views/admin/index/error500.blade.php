@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->

    <section class="container-fluid page-404 minWP text-c">
        <p class="error-title"><i class="Hui-iconfont va-m" style="font-size:80px">&#xe688;</i>
            <span class="va-m"> 500</span>
        </p>
        <p class="error-description">业务错误</p>
        <p class="error-info">
            <small>业务错误，请联系<a href="#">管理员处理</a></small>
            <a href="javascript:;" onclick="history.go(-1)" class="c-primary">&lt; 返回上一页</a>
            <span class="ml-20">|</span>
            <a href="/" class="c-primary ml-20">去首页 &gt;</a>
        </p>
        <p>
            <div class="error-content">
                <h3><i class="fa fa-warning text-red"></i>There is some Error</h3>
        <p>
            具体错误如下（请向管理员展示）
        </p>
        <p>
        @if($msg)
            <div style="color: red;">
                {{$msg}}
            </div>
        @else
            暂无错误提示，请重现问题并反馈管理员
            @endif
            </p>
            <p>
                <a href="#">{{env('DEVEOPLER','')}}</a>
            </p>
            </div>
            </p>
    </section>
@endsection