<?php

namespace App\Http\Middleware;

use App\Components\UserLoginManager;
use App\Components\UserManager;
use App\Components\Common\ApiResponse;
use Closure;
use App\Components\Common\Utils;


class CheckTestENV
{


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data = $request->all();
        //如果不是测试环境
        if (!env('APP_DEBUG', false)) {
            return ApiResponse::makeResponse(false, "请到测试环境进行接口调用", ApiResponse::INNER_ERROR);
        }
        return $next($request);

    }
}
