<?php

/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/20
* Time: 10:50
*/

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\PatientInspectInfoManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\PatientInspectInfo;
use Illuminate\Http\Request;

class PatientInspectInfoController
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
        $patient_inspect_infos =PatientInspectInfoManager::getListByCon($con_arr, true);
        foreach ($patient_inspect_infos as $patient_inspect_info) {
        $patient_inspect_info = PatientInspectInfoManager::getInfoByLevel($patient_inspect_info, '');
        }

        return view('admin.patientInspectInfo.index', ['self_admin' => $self_admin, 'datas' => $patient_inspect_infos, 'con_arr' => $con_arr]);
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
        $patient_inspect_info = new PatientInspectInfo();
        if (array_key_exists('id', $data)) {
        $patient_inspect_info = PatientInspectInfoManager::getById($data['id']);
        $patient_inspect_info = PatientInspectInfoManager::getInfoByLevel($patient_inspect_info, "");
        }
        return view('admin.patientInspectInfo.edit', ['self_admin' => $self_admin, 'data' => $patient_inspect_info, 'upload_token' => $upload_token]);
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
        $patient_inspect_info = new PatientInspectInfo();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $patient_inspect_info = PatientInspectInfoManager::getById($data['id']);
        }
        $data['admin_id'] = $self_admin['id'];
        $patient_inspect_info = PatientInspectInfoManager::setInfo($patient_inspect_info, $data);
        PatientInspectInfoManager::save($patient_inspect_info);
        return ApiResponse::makeResponse(true, $patient_inspect_info, ApiResponse::SUCCESS_CODE);
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
        $patient_inspect_info = PatientInspectInfoManager::getById($data['id']);
        if (!$patient_inspect_info) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        $patient_inspect_info = PatientInspectInfoManager::setInfo($patient_inspect_info, $data);
        PatientInspectInfoManager::save($patient_inspect_info);
        return ApiResponse::makeResponse(true, $patient_inspect_info, ApiResponse::SUCCESS_CODE);
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
        $patient_inspect_info = PatientInspectInfoManager::getById($data['id']);
        if (!$patient_inspect_info) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        PatientInspectInfoManager::deleteById($patient_inspect_info->id);
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
        $patient_inspect_info = PatientInspectInfoManager::getById($data['id']);
        $patient_inspect_info = PatientInspectInfoManager::getInfoByLevel($patient_inspect_info, '0');

        return view('admin.patientInspectInfo.info', ['self_admin' => $self_admin, 'data' => $patient_inspect_info]);
    }

}

