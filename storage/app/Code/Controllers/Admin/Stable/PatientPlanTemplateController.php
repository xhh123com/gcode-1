<?php

/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/20
* Time: 10:50
*/

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\PatientPlanTemplateManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\PatientPlanTemplate;
use Illuminate\Http\Request;

class PatientPlanTemplateController
{

    /*
    * 首页
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:35
    */
    public function index(Request $request)
    {
        $self_admin = $request->session()->get('self_admin');
        $data = $request->all();
        //相关搜素条件
        $status = null;
        $search_word = null;
        if (array_key_exists('status', $data) && !Utils::isObjNull($data['status'])) {
            $status = $data['status'];
        }
        if (array_key_exists('search_word', $data) && !Utils::isObjNull($data['search_word'])) {
            $search_word = $data['search_word'];
        }
        $con_arr = array(
            'status' => $status,
            'search_word' => $search_word,
        );
        $patient_plan_templates =PatientPlanTemplateManager::getListByCon($con_arr, true);
        foreach ($patient_plan_templates as $patient_plan_template) {
        $patient_plan_template = PatientPlanTemplateManager::getInfoByLevel($patient_plan_template, '');
        }

        return view('admin.patientPlanTemplate.index', ['self_admin' => $self_admin, 'datas' => $patient_plan_templates, 'con_arr' => $con_arr]);
    }

    /*
    * 编辑-get
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:35
    */
    public function edit(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        $patient_plan_template = new PatientPlanTemplate();
        if (array_key_exists('id', $data)) {
        $patient_plan_template = PatientPlanTemplateManager::getById($data['id']);
        $patient_plan_template = PatientPlanTemplateManager::getInfoByLevel($patient_plan_template, "");
        }
        return view('admin.patientPlanTemplate.edit', ['self_admin' => $self_admin, 'data' => $patient_plan_template, 'upload_token' => $upload_token]);
    }


    /*
    * 添加或编辑-post
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:35
    */
    public function editPost(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        $patient_plan_template = new PatientPlanTemplate();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $patient_plan_template = PatientPlanTemplateManager::getById($data['id']);
        }
        $data['admin_id'] = $self_admin['id'];
        $patient_plan_template = PatientPlanTemplateManager::setInfo($patient_plan_template, $data);
        PatientPlanTemplateManager::save($patient_plan_template);
        return ApiResponse::makeResponse(true, $patient_plan_template, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 设置状态
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:35
    */
    public function setStatus(Request $request, $id)
    {
        $data = $request->all();
        $patient_plan_template = PatientPlanTemplateManager::getById($data['id']);
        if (!$patient_plan_template) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        $patient_plan_template = PatientPlanTemplateManager::setInfo($patient_plan_template, $data);
        PatientPlanTemplateManager::save($patient_plan_template);
        return ApiResponse::makeResponse(true, $patient_plan_template, ApiResponse::SUCCESS_CODE);
    }

    /*
    * 删除
    *
    * By Auto CodeCreator
    *
    * 2019-05-18 17:14:16
    */
    public function deleteById(Request $request, $id)
    {
        $data = $request->all();
        $patient_plan_template = PatientPlanTemplateManager::getById($data['id']);
        if (!$patient_plan_template) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        PatientPlanTemplateManager::deleteById($patient_plan_template->id);
        return ApiResponse::makeResponse(true, "删除成功", ApiResponse::SUCCESS_CODE);
    }


    /*
    * 查看信息
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:35
    *
    */
    public function info(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        //合规校验
        $requestValidationResult = RequestValidator::validator($request->all(), [
        'id' => 'required',
        ]);
        if ($requestValidationResult !== true) {
        return redirect()->action('\App\Http\Controllers\Admin\IndexController@error', ['msg' => '合规校验失败，请检查参数' . $requestValidationResult]);
        }
        //信息
        $patient_plan_template = PatientPlanTemplateManager::getById($data['id']);
        $patient_plan_template = PatientPlanTemplateManager::getInfoByLevel($patient_plan_template, '0');

        return view('admin.patientPlanTemplate.info', ['self_admin' => $self_admin, 'data' => $patient_plan_template]);
    }

}

