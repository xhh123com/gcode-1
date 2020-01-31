<?php

/**
* Created by PhpStorm.
* User:robot
* Date: 2020-01-30 11:20:33
* Time: 13:29
*/

namespace App\Http\Controllers\AdminApi;


use App\Components\Common\RequestValidator;
use App\Components\DoctorPatientRelEasemobManager;
use App\Models\DoctorPatientRelEasemob;
use App\Components\AdminManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use Illuminate\Http\Request;

class DoctorPatientRelEasemobController
{

    /*
    * 根据id获取信息
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:33
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

        $doctor_patient_rel_easemob = DoctorPatientRelEasemobManager::getById($data['id']);
        //补充信息
        if($doctor_patient_rel_easemob){
            $level = null;
            if (array_key_exists('level', $data) && !Utils::isObjNull($data['level'])) {
                $level = $data['level'];
            }
            $doctor_patient_rel_easemob = DoctorPatientRelEasemobManager::getInfoByLevel($doctor_patient_rel_easemob,$level);
        }
        return ApiResponse::makeResponse(true, $doctor_patient_rel_easemob, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 根据条件获取列表
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:33
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
        $doctor_patient_rel_easemobs = DoctorPatientRelEasemobManager::getListByCon($con_arr, $is_paginate);
        foreach ($doctor_patient_rel_easemobs as $doctor_patient_rel_easemob) {
            $doctor_patient_rel_easemob = DoctorPatientRelEasemobManager::getInfoByLevel($doctor_patient_rel_easemob, $level);
        }

        return ApiResponse::makeResponse(true, $doctor_patient_rel_easemobs, ApiResponse::SUCCESS_CODE);
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

        $doctor_patient_rel_easemob = new DoctorPatientRelEasemob();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $doctor_patient_rel_easemob = DoctorPatientRelEasemobManager::getById($data['id']);
        }
        $doctor_patient_rel_easemob = DoctorPatientRelEasemobManager::setInfo($doctor_patient_rel_easemob, $data);
        DoctorPatientRelEasemobManager::save($doctor_patient_rel_easemob);
        return ApiResponse::makeResponse(true, $doctor_patient_rel_easemob, ApiResponse::SUCCESS_CODE);
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

        $doctor_patient_rel_easemob = DoctorPatientRelEasemobManager::getById($data['id']);
        if ($doctor_patient_rel_easemob) {
            DoctorPatientRelEasemobManager::deleteById($doctor_patient_rel_easemob->id);
        }
        return ApiResponse::makeResponse(true, "删除成功", ApiResponse::SUCCESS_CODE);
    }


}

