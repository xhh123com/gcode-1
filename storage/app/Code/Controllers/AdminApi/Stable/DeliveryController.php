<?php

/**
* Created by PhpStorm.
* User:robot
* Date: 2020-02-02 04:07:10
* Time: 13:29
*/

namespace App\Http\Controllers\AdminApi;


use App\Components\Common\RequestValidator;
use App\Components\DeliveryManager;
use App\Models\Delivery;
use App\Components\AdminManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use Illuminate\Http\Request;

class DeliveryController
{

    /*
    * 根据id获取信息
    *
    * By Auto CodeCreator
    *
    * 2020-02-02 04:07:10
    */
    public function getById(Request $request)
    {
        $data = $request->all();
        $requestValidationResult = RequestValidator::validator($request->all(), [
            'id' => 'required',
            'self_admin_id' => 'required',
        ]);
        if ($requestValidationResult !== true) {
            return ApiResponse::makeResponse(false, $requestValidationResult, ApiResponse::MISSING_PARAM);
        }
        //过中间件一定存在
        $self_admin = AdminManager::getById($data['self_admin_id']);

        $delivery = DeliveryManager::getById($data['id']);
        //补充信息
        if($delivery){
            $level = null;
            if (array_key_exists('level', $data) && !Utils::isObjNull($data['level'])) {
                $level = $data['level'];
            }
            $delivery = DeliveryManager::getInfoByLevel($delivery,$level);
        }
        return ApiResponse::makeResponse(true, $delivery, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 根据条件获取列表
    *
    * By Auto CodeCreator
    *
    * 2020-02-02 04:07:10
    */
    public function getListByCon(Request $request)
    {
        $data = $request->all();
        $requestValidationResult = RequestValidator::validator($request->all(), [
        'self_admin_id' => 'required',
        ]);
        if ($requestValidationResult !== true) {
        return ApiResponse::makeResponse(false, $requestValidationResult, ApiResponse::MISSING_PARAM);
        }
        //过中间件一定存在
        $self_admin = AdminManager::getById($data['self_admin_id']);

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
        $deliverys = DeliveryManager::getListByCon($con_arr, $is_paginate);
        foreach ($deliverys as $delivery) {
            $delivery = DeliveryManager::getInfoByLevel($delivery, $level);
        }

        return ApiResponse::makeResponse(true, $deliverys, ApiResponse::SUCCESS_CODE);
    }

    /*
    * 修改添加
    *
    * By Auto CodeCreator
    *
    * 2019-09-26 12:45:38
    */
    public function edit(Request $request)
    {
        $data = $request->all();
        //获取合作方id
        $requestValidationResult = RequestValidator::validator($request->all(), [
        'self_admin_id' => 'required',
        ]);
        if ($requestValidationResult !== true) {
        return ApiResponse::makeResponse(false, $requestValidationResult, ApiResponse::MISSING_PARAM);
        }
        //过中间件一定存在
        $self_admin = AdminManager::getById($data['self_admin_id']);

        $delivery = new Delivery();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $delivery = DeliveryManager::getById($data['id']);
        }
        $delivery = DeliveryManager::setInfo($delivery, $data);
        DeliveryManager::save($delivery);
        return ApiResponse::makeResponse(true, $delivery, ApiResponse::SUCCESS_CODE);
    }

    /*
    * 删除
    *
    * By Auto CodeCreator
    *
    * 2019-05-18 17:14:16
    */
    public function deleteById(Request $request)
    {
        $data = $request->all();
        //获取合作方id
        $requestValidationResult = RequestValidator::validator($request->all(), [
            'id' => 'required',
            'self_admin_id' => 'required',
        ]);
        if ($requestValidationResult !== true) {
            return ApiResponse::makeResponse(false, $requestValidationResult, ApiResponse::MISSING_PARAM);
        }
        //过中间件一定存在
        $self_admin = AdminManager::getById($data['self_admin_id']);

        $delivery = DeliveryManager::getById($data['id']);
        if ($delivery) {
            DeliveryManager::deleteById($delivery->id);
        }
        return ApiResponse::makeResponse(true, "删除成功", ApiResponse::SUCCESS_CODE);
    }


}

