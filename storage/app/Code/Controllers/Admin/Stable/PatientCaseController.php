<?php

/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/20
* Time: 10:50
*/

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\PatientCaseManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\PatientCase;
use Illuminate\Http\Request;

class PatientCaseController
{

    /*
    * 首页
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:34
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
        $patient_cases =PatientCaseManager::getListByCon($con_arr, true);
        foreach ($patient_cases as $patient_case) {
        $patient_case = PatientCaseManager::getInfoByLevel($patient_case, '');
        }

        return view('admin.patientCase.index', ['self_admin' => $self_admin, 'datas' => $patient_cases, 'con_arr' => $con_arr]);
    }

    /*
    * 编辑-get
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:34
    */
    public function edit(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        $patient_case = new PatientCase();
        if (array_key_exists('id', $data)) {
        $patient_case = PatientCaseManager::getById($data['id']);
        $patient_case = PatientCaseManager::getInfoByLevel($patient_case, "");
        }
        return view('admin.patientCase.edit', ['self_admin' => $self_admin, 'data' => $patient_case, 'upload_token' => $upload_token]);
    }


    /*
    * 添加或编辑-post
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:34
    */
    public function editPost(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        $patient_case = new PatientCase();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $patient_case = PatientCaseManager::getById($data['id']);
        }
        $data['admin_id'] = $self_admin['id'];
        $patient_case = PatientCaseManager::setInfo($patient_case, $data);
        PatientCaseManager::save($patient_case);
        return ApiResponse::makeResponse(true, $patient_case, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 设置状态
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:34
    */
    public function setStatus(Request $request, $id)
    {
        $data = $request->all();
        $patient_case = PatientCaseManager::getById($data['id']);
        if (!$patient_case) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        $patient_case = PatientCaseManager::setInfo($patient_case, $data);
        PatientCaseManager::save($patient_case);
        return ApiResponse::makeResponse(true, $patient_case, ApiResponse::SUCCESS_CODE);
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
        $patient_case = PatientCaseManager::getById($data['id']);
        if (!$patient_case) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        PatientCaseManager::deleteById($patient_case->id);
        return ApiResponse::makeResponse(true, "删除成功", ApiResponse::SUCCESS_CODE);
    }


    /*
    * 查看信息
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:34
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
        $patient_case = PatientCaseManager::getById($data['id']);
        $patient_case = PatientCaseManager::getInfoByLevel($patient_case, '0');

        return view('admin.patientCase.info', ['self_admin' => $self_admin, 'data' => $patient_case]);
    }

}

