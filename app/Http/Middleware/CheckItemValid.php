<?php

/**
 * 检测后台用户是否登录中间件
 */

namespace App\Http\Middleware;

use App\Components\AdminManager;
use App\Components\BusCompanyManager;
use App\Components\Common\ApiResponse;
use App\Components\Common\Utils;
use App\Components\CouponManager;
use App\Components\JobOrderItemManager;
use App\Components\JobOrderManager;
use App\Components\ManCompanyManager;
use App\Components\ProductManager;
use App\Components\ShopStoreManager;
use App\Components\SubProductManager;
use App\Components\UserManager;
use App\Models\Coupon;
use Closure;

class CheckItemValid
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
        $pathInfo = $request->getPathInfo();
        //这里排除getListByCon的路由，以便确保有效性
        if ($data && strpos($pathInfo, 'getListByCon') == false) {
            //校验用户有效性
            if (array_key_exists('user_id', $data) && !Utils::isObjNull($data['user_id'])) {
                $user = UserManager::getById($data['user_id']);
                if (!$user) {
                    return ApiResponse::makeResponse(false, "用户不存在", ApiResponse::INNER_ERROR);
                }
            }
            //校验物业公司有效性
            if (array_key_exists('man_company_id', $data) && !Utils::isObjNull($data['man_company_id'])) {
                $man_company = ManCompanyManager::getById($data['man_company_id']);
                if (!$man_company) {
                    return ApiResponse::makeResponse(false, "物业公司不存在", ApiResponse::INNER_ERROR);
                }
            }
            //校验在管项目有效性
            if (array_key_exists('bus_company_id', $data) && !Utils::isObjNull($data['bus_company_id'])) {
                $bus_company = BusCompanyManager::getById($data['bus_company_id']);
                if (!$bus_company) {
                    return ApiResponse::makeResponse(false, "在管项目不存在", ApiResponse::INNER_ERROR);
                }
            }
            //校验工作包有效性
            if (array_key_exists('job_order_id', $data) && !Utils::isObjNull($data['job_order_id'])) {
                $job_order = JobOrderManager::getById($data['job_order_id']);
                if (!$job_order) {
                    return ApiResponse::makeResponse(false, "工作包不存在", ApiResponse::INNER_ERROR);
                }
            }
            //校验工作任务有效性
            if (array_key_exists('job_order_item_id', $data) && !Utils::isObjNull($data['job_order_item_id'])) {
                $job_order_item = JobOrderItemManager::getById($data['job_order_item_id']);
                if (!$job_order_item) {
                    return ApiResponse::makeResponse(false, "工作任务不存在", ApiResponse::INNER_ERROR);
                }
            }
        }
        return $next($request);
    }

}
