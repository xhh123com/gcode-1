<?php

namespace App\Http\Middleware;

use App\Components\AdminManager;
use App\Components\Common\ApiResponse;
use App\Components\AdminLoginManager;
use Closure;
use App\Components\Common\Utils;


class CheckAdminToken
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
        if ($data) {
            //合规校验
            if (!array_key_exists('token', $data)) {
                return ApiResponse::makeResponse(false, ApiResponse::$errorMessage[ApiResponse::TOKEN_LOST], ApiResponse::TOKEN_LOST);
            }
            //校验token的合法性
            $con_arr = array(
                'token' => $data['token'],
            );
            Utils::processLog(__METHOD__, '', 'con_arr:' . json_encode($con_arr));
            $admin_login = AdminLoginManager::getListByCon($con_arr, false)->first();
            Utils::processLog(__METHOD__, '', 'result:' . json_encode($admin_login));
            if (!$admin_login) {
                return ApiResponse::makeResponse(false, ApiResponse::$errorMessage[ApiResponse::TOKEN_ERROR], ApiResponse::TOKEN_ERROR);
            }
            //管理员是否失效
            $admin = AdminManager::getById($admin_login->admin_id);
            if (!$admin || $admin->status != Utils::STATUS_VALUE_1) {
                return ApiResponse::makeResponse(false, ApiResponse::$errorMessage[ApiResponse::ACCOUNT_INVALID], ApiResponse::ACCOUNT_INVALID);
            }
            $request->merge(['self_admin_id' => $admin->id]);//在request中加入self_admin_id确保有id
        } else {
            return ApiResponse::makeResponse(false, ApiResponse::$errorMessage[ApiResponse::TOKEN_LOST], ApiResponse::TOKEN_LOST);
        }
        return $next($request);
    }
}
