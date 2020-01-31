<?php

/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/20
* Time: 10:50
*/

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\HospitalDepartmentManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\HospitalDepartment;
use Illuminate\Http\Request;

class HospitalDepartmentController
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
        $hospital_departments =HospitalDepartmentManager::getListByCon($con_arr, true);
        foreach ($hospital_departments as $hospital_department) {
        $hospital_department = HospitalDepartmentManager::getInfoByLevel($hospital_department, '');
        }

        return view('admin.hospitalDepartment.index', ['self_admin' => $self_admin, 'datas' => $hospital_departments, 'con_arr' => $con_arr]);
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
        $hospital_department = new HospitalDepartment();
        if (array_key_exists('id', $data)) {
        $hospital_department = HospitalDepartmentManager::getById($data['id']);
        $hospital_department = HospitalDepartmentManager::getInfoByLevel($hospital_department, "");
        }
        return view('admin.hospitalDepartment.edit', ['self_admin' => $self_admin, 'data' => $hospital_department, 'upload_token' => $upload_token]);
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
        $hospital_department = new HospitalDepartment();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $hospital_department = HospitalDepartmentManager::getById($data['id']);
        }
        $data['admin_id'] = $self_admin['id'];
        $hospital_department = HospitalDepartmentManager::setInfo($hospital_department, $data);
        HospitalDepartmentManager::save($hospital_department);
        return ApiResponse::makeResponse(true, $hospital_department, ApiResponse::SUCCESS_CODE);
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
        $hospital_department = HospitalDepartmentManager::getById($data['id']);
        if (!$hospital_department) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        $hospital_department = HospitalDepartmentManager::setInfo($hospital_department, $data);
        HospitalDepartmentManager::save($hospital_department);
        return ApiResponse::makeResponse(true, $hospital_department, ApiResponse::SUCCESS_CODE);
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
        $hospital_department = HospitalDepartmentManager::getById($data['id']);
        if (!$hospital_department) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        HospitalDepartmentManager::deleteById($hospital_department->id);
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
        $hospital_department = HospitalDepartmentManager::getById($data['id']);
        $hospital_department = HospitalDepartmentManager::getInfoByLevel($hospital_department, '0');

        return view('admin.hospitalDepartment.info', ['self_admin' => $self_admin, 'data' => $hospital_department]);
    }

}

