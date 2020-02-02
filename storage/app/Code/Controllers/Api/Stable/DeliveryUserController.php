<?php

/**
* Created by PhpStorm.
* User:robot
* Date: 2020-02-02 04:07:11
* Time: 13:29
*/

namespace App\Http\Controllers\Api;


use App\Components\Common\RequestValidator;
use App\Components\DeliveryUserManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use Illuminate\Http\Request;

class DeliveryUserController
{

    /*
    * 根据id获取信息
    *
    * By Auto CodeCreator
    *
    * 2020-02-02 04:07:11
    */
    public function getById(Request $request)
    {
        $data = $request->all();
        $requestValidationResult = RequestValidator::validator($request->all(), [
            'id' => 'required',
        ]);
        if ($requestValidationResult !== true) {
            return ApiResponse::makeResponse(false, $requestValidationResult, ApiResponse::MISSING_PARAM);
        }
        $delivery_user = DeliveryUserManager::getById($data['id']);
        //补充信息
        if($delivery_user){
            $level = null;
            if (array_key_exists('level', $data) && !Utils::isObjNull($data['level'])) {
                $level = $data['level'];
            }
            $delivery_user = DeliveryUserManager::getInfoByLevel($delivery_user,$level);
        }
        return ApiResponse::makeResponse(true, $delivery_user, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 根据条件获取列表
    *
    * By Auto CodeCreator
    *
    * 2020-02-02 04:07:11
    */
    public function getListByCon(Request $request)
    {
        $data = $request->all();
        //自定义参数位置
        $status = '1';

        //分页和信息级别
        $is_paginate = true;
        $level='Y';

        //参数配置
        if (array_key_exists('status', $data) && !Utils::isObjNull($data['status'])) {
            $status = $data['status'];
        }
        //配置获取信息级别
        if (array_key_exists('level', $data) && !Utils::isObjNull($data['level'])) {
            $level = $data['level'];
        }
        //配置是否分页
        if (array_key_exists('is_paginate', $data) && !Utils::isObjNull($data['is_paginate'])) {
            $is_paginate = $data['is_paginate'];
        }

        //配置条件
        if (array_key_exists('status', $data) && !Utils::isObjNull($data['status'])) {
            $status = $data['status'];
        }
        $con_arr = array(
            'status' => $status,
        );
        $delivery_users = DeliveryUserManager::getListByCon($con_arr, $is_paginate);
        foreach ($delivery_users as $delivery_user) {
            $delivery_user = DeliveryUserManager::getInfoByLevel($delivery_user, $level);
        }

        return ApiResponse::makeResponse(true, $delivery_users, ApiResponse::SUCCESS_CODE);
    }
}

