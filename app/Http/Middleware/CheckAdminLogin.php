<?php

/**
 * 检测后台用户是否登录中间件
 */

namespace App\Http\Middleware;

use App\Components\AdminManager;
use Closure;

class CheckAdminLogin
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
        //检测session中是否有登录信息
        if (!$request->session()->has('self_admin')) {
            return redirect('/admin/login');
        }
        $self_admin = $request->session()->get('self_admin');
        $self_admin = AdminManager::getById($self_admin->id);     //增加判断status==0的失效踢出管理员
        if ($self_admin->status == '0') {
            return redirect('/admin/login');
        }
        return $next($request);
    }

}
