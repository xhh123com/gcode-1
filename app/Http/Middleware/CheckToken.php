<?php

namespace App\Http\Middleware;

use App\Components\Common\ApiResponse;
use App\Components\UserLoginManager;
use App\Components\UserManager;
use Closure;
use App\Components\Common\Utils;


class CheckToken
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
            if (!array_key_exists('token', $data) || Utils::isObjNull($data['token'])) {
                return ApiResponse::makeResponse(false, ApiResponse::$errorMessage[ApiResponse::TOKEN_LOST], ApiResponse::TOKEN_LOST);
            }
            if (!array_key_exists('user_id', $data)) {
                return ApiResponse::makeResponse(false, ApiResponse::$errorMessage[ApiResponse::USER_ID_LOST], ApiResponse::USER_ID_LOST);
            }
            //校验token的合法性
            $con_arr = array(
                'user_id' => $data['user_id'],
                'token' => $data['token'],
            );
            Utils::processLog(__METHOD__, '', 'con_arr:' . json_encode($con_arr));
            $result = UserLoginManager::getListByCon($con_arr, false)->first();
            Utils::processLog(__METHOD__, '', 'result:' . json_encode($result));

            if (!$result) {
                return ApiResponse::makeResponse(false, ApiResponse::$errorMessage[ApiResponse::TOKEN_ERROR], ApiResponse::TOKEN_ERROR);
            }
        } else {
            return ApiResponse::makeResponse(false, ApiResponse::$errorMessage[ApiResponse::UNKNOW_ERROR], ApiResponse::UNKNOW_ERROR);
        }
        return $next($request);

    }
}
