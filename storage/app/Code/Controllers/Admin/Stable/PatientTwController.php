<?php

/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/20
* Time: 10:50
*/

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\PatientTwManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\PatientTw;
use Illuminate\Http\Request;

class PatientTwController
{

    /*
    * 首页
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:36
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
        $patient_tws =PatientTwManager::getListByCon($con_arr, true);
        foreach ($patient_tws as $patient_tw) {
        $patient_tw = PatientTwManager::getInfoByLevel($patient_tw, '');
        }

        return view('admin.patientTw.index', ['self_admin' => $self_admin, 'datas' => $patient_tws, 'con_arr' => $con_arr]);
    }

    /*
    * 编辑-get
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:36
    */
    public function edit(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        $patient_tw = new PatientTw();
        if (array_key_exists('id', $data)) {
        $patient_tw = PatientTwManager::getById($data['id']);
        $patient_tw = PatientTwManager::getInfoByLevel($patient_tw, "");
        }
        return view('admin.patientTw.edit', ['self_admin' => $self_admin, 'data' => $patient_tw, 'upload_token' => $upload_token]);
    }


    /*
    * 添加或编辑-post
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:36
    */
    public function editPost(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        $patient_tw = new PatientTw();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $patient_tw = PatientTwManager::getById($data['id']);
        }
        $data['admin_id'] = $self_admin['id'];
        $patient_tw = PatientTwManager::setInfo($patient_tw, $data);
        PatientTwManager::save($patient_tw);
        return ApiResponse::makeResponse(true, $patient_tw, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 设置状态
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:36
    */
    public function setStatus(Request $request, $id)
    {
        $data = $request->all();
        $patient_tw = PatientTwManager::getById($data['id']);
        if (!$patient_tw) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        $patient_tw = PatientTwManager::setInfo($patient_tw, $data);
        PatientTwManager::save($patient_tw);
        return ApiResponse::makeResponse(true, $patient_tw, ApiResponse::SUCCESS_CODE);
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
        $patient_tw = PatientTwManager::getById($data['id']);
        if (!$patient_tw) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        PatientTwManager::deleteById($patient_tw->id);
        return ApiResponse::makeResponse(true, "删除成功", ApiResponse::SUCCESS_CODE);
    }


    /*
    * 查看信息
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:36
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
        $patient_tw = PatientTwManager::getById($data['id']);
        $patient_tw = PatientTwManager::getInfoByLevel($patient_tw, '0');

        return view('admin.patientTw.info', ['self_admin' => $self_admin, 'data' => $patient_tw]);
    }

}

