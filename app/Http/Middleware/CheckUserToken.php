<?php

namespace App\Http\Middleware;

use App\Components\Common\ApiResponse;
use App\Components\ShareVerifyManager;
use App\Components\UserLoginManager;
use App\Components\UserManager;
use App\MongoDB\Models\Doc\ShareVerifyDoc;
use Closure;
use App\Components\Common\Utils;


class CheckUserToken
{


    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
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
            $user_login = UserLoginManager::getListByCon($con_arr, false)->first();
            Utils::processLog(__METHOD__, '', 'result:' . json_encode($user_login));
            if (!$user_login) {
                return ApiResponse::makeResponse(false, ApiResponse::$errorMessage[ApiResponse::TOKEN_ERROR], ApiResponse::TOKEN_ERROR);
            }
            //获取用户信息
            $user = UserManager::getById($user_login->user_id);
            if (!$user || $user->status != Utils::COMMON_STATUS_1) {        //用户失效状态
                return ApiResponse::makeResponse(false, ApiResponse::$errorMessage[ApiResponse::USER_ERRROR], ApiResponse::USER_ERRROR);
            }
            $request->merge(['self_user_id' => $user_login->user_id]);//合并参数，加入self_user_id
        } else {
            return ApiResponse::makeResponse(false, ApiResponse::$errorMessage[ApiResponse::TOKEN_LOST], ApiResponse::TOKEN_LOST);
        }
        return $next($request);

    }
}
