<?php

/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/20
* Time: 10:50
*/

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\CollectionDoctorVideoLabelManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\CollectionDoctorVideoLabel;
use Illuminate\Http\Request;

class CollectionDoctorVideoLabelController
{

    /*
    * 首页
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:32
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
        $collection_doctor_video_labels =CollectionDoctorVideoLabelManager::getListByCon($con_arr, true);
        foreach ($collection_doctor_video_labels as $collection_doctor_video_label) {
        $collection_doctor_video_label = CollectionDoctorVideoLabelManager::getInfoByLevel($collection_doctor_video_label, '');
        }

        return view('admin.collectionDoctorVideoLabel.index', ['self_admin' => $self_admin, 'datas' => $collection_doctor_video_labels, 'con_arr' => $con_arr]);
    }

    /*
    * 编辑-get
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:32
    */
    public function edit(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        $collection_doctor_video_label = new CollectionDoctorVideoLabel();
        if (array_key_exists('id', $data)) {
        $collection_doctor_video_label = CollectionDoctorVideoLabelManager::getById($data['id']);
        $collection_doctor_video_label = CollectionDoctorVideoLabelManager::getInfoByLevel($collection_doctor_video_label, "");
        }
        return view('admin.collectionDoctorVideoLabel.edit', ['self_admin' => $self_admin, 'data' => $collection_doctor_video_label, 'upload_token' => $upload_token]);
    }


    /*
    * 添加或编辑-post
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:32
    */
    public function editPost(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        $collection_doctor_video_label = new CollectionDoctorVideoLabel();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $collection_doctor_video_label = CollectionDoctorVideoLabelManager::getById($data['id']);
        }
        $data['admin_id'] = $self_admin['id'];
        $collection_doctor_video_label = CollectionDoctorVideoLabelManager::setInfo($collection_doctor_video_label, $data);
        CollectionDoctorVideoLabelManager::save($collection_doctor_video_label);
        return ApiResponse::makeResponse(true, $collection_doctor_video_label, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 设置状态
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:32
    */
    public function setStatus(Request $request, $id)
    {
        $data = $request->all();
        $collection_doctor_video_label = CollectionDoctorVideoLabelManager::getById($data['id']);
        if (!$collection_doctor_video_label) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        $collection_doctor_video_label = CollectionDoctorVideoLabelManager::setInfo($collection_doctor_video_label, $data);
        CollectionDoctorVideoLabelManager::save($collection_doctor_video_label);
        return ApiResponse::makeResponse(true, $collection_doctor_video_label, ApiResponse::SUCCESS_CODE);
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
        $collection_doctor_video_label = CollectionDoctorVideoLabelManager::getById($data['id']);
        if (!$collection_doctor_video_label) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        CollectionDoctorVideoLabelManager::deleteById($collection_doctor_video_label->id);
        return ApiResponse::makeResponse(true, "删除成功", ApiResponse::SUCCESS_CODE);
    }


    /*
    * 查看信息
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:32
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
        $collection_doctor_video_label = CollectionDoctorVideoLabelManager::getById($data['id']);
        $collection_doctor_video_label = CollectionDoctorVideoLabelManager::getInfoByLevel($collection_doctor_video_label, '0');

        return view('admin.collectionDoctorVideoLabel.info', ['self_admin' => $self_admin, 'data' => $collection_doctor_video_label]);
    }

}

