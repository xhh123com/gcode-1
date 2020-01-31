<?php

/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/20
* Time: 10:50
*/

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\DoctorPatientRelManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\DoctorPatientRel;
use Illuminate\Http\Request;

class DoctorPatientRelController
{

    /*
    * 首页
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:33
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
        $doctor_patient_rels =DoctorPatientRelManager::getListByCon($con_arr, true);
        foreach ($doctor_patient_rels as $doctor_patient_rel) {
        $doctor_patient_rel = DoctorPatientRelManager::getInfoByLevel($doctor_patient_rel, '');
        }

        return view('admin.doctorPatientRel.index', ['self_admin' => $self_admin, 'datas' => $doctor_patient_rels, 'con_arr' => $con_arr]);
    }

    /*
    * 编辑-get
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:33
    */
    public function edit(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        $doctor_patient_rel = new DoctorPatientRel();
        if (array_key_exists('id', $data)) {
        $doctor_patient_rel = DoctorPatientRelManager::getById($data['id']);
        $doctor_patient_rel = DoctorPatientRelManager::getInfoByLevel($doctor_patient_rel, "");
        }
        return view('admin.doctorPatientRel.edit', ['self_admin' => $self_admin, 'data' => $doctor_patient_rel, 'upload_token' => $upload_token]);
    }


    /*
    * 添加或编辑-post
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:33
    */
    public function editPost(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        $doctor_patient_rel = new DoctorPatientRel();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $doctor_patient_rel = DoctorPatientRelManager::getById($data['id']);
        }
        $data['admin_id'] = $self_admin['id'];
        $doctor_patient_rel = DoctorPatientRelManager::setInfo($doctor_patient_rel, $data);
        DoctorPatientRelManager::save($doctor_patient_rel);
        return ApiResponse::makeResponse(true, $doctor_patient_rel, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 设置状态
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:33
    */
    public function setStatus(Request $request, $id)
    {
        $data = $request->all();
        $doctor_patient_rel = DoctorPatientRelManager::getById($data['id']);
        if (!$doctor_patient_rel) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        $doctor_patient_rel = DoctorPatientRelManager::setInfo($doctor_patient_rel, $data);
        DoctorPatientRelManager::save($doctor_patient_rel);
        return ApiResponse::makeResponse(true, $doctor_patient_rel, ApiResponse::SUCCESS_CODE);
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
        $doctor_patient_rel = DoctorPatientRelManager::getById($data['id']);
        if (!$doctor_patient_rel) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        DoctorPatientRelManager::deleteById($doctor_patient_rel->id);
        return ApiResponse::makeResponse(true, "删除成功", ApiResponse::SUCCESS_CODE);
    }


    /*
    * 查看信息
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:33
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
        $doctor_patient_rel = DoctorPatientRelManager::getById($data['id']);
        $doctor_patient_rel = DoctorPatientRelManager::getInfoByLevel($doctor_patient_rel, '0');

        return view('admin.doctorPatientRel.info', ['self_admin' => $self_admin, 'data' => $doctor_patient_rel]);
    }

}

