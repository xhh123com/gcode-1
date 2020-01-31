<?php

/**
* Created by PhpStorm.
* User:robot
* Date: 2020-01-30 11:20:36
* Time: 13:29
*/

namespace App\Http\Controllers\AdminApi;


use App\Components\Common\RequestValidator;
use App\Components\PatientPlanTemplateItemManager;
use App\Models\PatientPlanTemplateItem;
use App\Components\AdminManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use Illuminate\Http\Request;

class PatientPlanTemplateItemController
{

    /*
    * 根据id获取信息
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:36
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

        $patient_plan_template_item = PatientPlanTemplateItemManager::getById($data['id']);
        //补充信息
        if($patient_plan_template_item){
            $level = null;
            if (array_key_exists('level', $data) && !Utils::isObjNull($data['level'])) {
                $level = $data['level'];
            }
            $patient_plan_template_item = PatientPlanTemplateItemManager::getInfoByLevel($patient_plan_template_item,$level);
        }
        return ApiResponse::makeResponse(true, $patient_plan_template_item, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 根据条件获取列表
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:36
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
        $patient_plan_template_items = PatientPlanTemplateItemManager::getListByCon($con_arr, $is_paginate);
        foreach ($patient_plan_template_items as $patient_plan_template_item) {
            $patient_plan_template_item = PatientPlanTemplateItemManager::getInfoByLevel($patient_plan_template_item, $level);
        }

        return ApiResponse::makeResponse(true, $patient_plan_template_items, ApiResponse::SUCCESS_CODE);
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

        $patient_plan_template_item = new PatientPlanTemplateItem();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $patient_plan_template_item = PatientPlanTemplateItemManager::getById($data['id']);
        }
        $patient_plan_template_item = PatientPlanTemplateItemManager::setInfo($patient_plan_template_item, $data);
        PatientPlanTemplateItemManager::save($patient_plan_template_item);
        return ApiResponse::makeResponse(true, $patient_plan_template_item, ApiResponse::SUCCESS_CODE);
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

        $patient_plan_template_item = PatientPlanTemplateItemManager::getById($data['id']);
        if ($patient_plan_template_item) {
            PatientPlanTemplateItemManager::deleteById($patient_plan_template_item->id);
        }
        return ApiResponse::makeResponse(true, "删除成功", ApiResponse::SUCCESS_CODE);
    }


}

