<?php

/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/20
* Time: 10:50
*/

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\VericodeVerifyRecordManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\VericodeVerifyRecord;
use Illuminate\Http\Request;

class VericodeVerifyRecordController
{

    /*
    * 首页
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:54
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
        $vericode_verify_records =VericodeVerifyRecordManager::getListByCon($con_arr, true);
        foreach ($vericode_verify_records as $vericode_verify_record) {
        $vericode_verify_record = VericodeVerifyRecordManager::getInfoByLevel($vericode_verify_record, '');
        }

        return view('admin.vericodeVerifyRecord.index', ['self_admin' => $self_admin, 'datas' => $vericode_verify_records, 'con_arr' => $con_arr]);
    }

    /*
    * 编辑-get
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:54
    */
    public function edit(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        $vericode_verify_record = new VericodeVerifyRecord();
        if (array_key_exists('id', $data)) {
        $vericode_verify_record = VericodeVerifyRecordManager::getById($data['id']);
        $vericode_verify_record = VericodeVerifyRecordManager::getInfoByLevel($vericode_verify_record, "");
        }
        return view('admin.vericodeVerifyRecord.edit', ['self_admin' => $self_admin, 'data' => $vericode_verify_record, 'upload_token' => $upload_token]);
    }


    /*
    * 添加或编辑-post
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:54
    */
    public function editPost(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        $vericode_verify_record = new VericodeVerifyRecord();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $vericode_verify_record = VericodeVerifyRecordManager::getById($data['id']);
        }
        $data['admin_id'] = $self_admin['id'];
        $vericode_verify_record = VericodeVerifyRecordManager::setInfo($vericode_verify_record, $data);
        VericodeVerifyRecordManager::save($vericode_verify_record);
        return ApiResponse::makeResponse(true, $vericode_verify_record, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 设置状态
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:54
    */
    public function setStatus(Request $request, $id)
    {
        $data = $request->all();
        $vericode_verify_record = VericodeVerifyRecordManager::getById($data['id']);
        if (!$vericode_verify_record) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        $vericode_verify_record = VericodeVerifyRecordManager::setInfo($vericode_verify_record, $data);
        VericodeVerifyRecordManager::save($vericode_verify_record);
        return ApiResponse::makeResponse(true, $vericode_verify_record, ApiResponse::SUCCESS_CODE);
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
        $vericode_verify_record = VericodeVerifyRecordManager::getById($data['id']);
        if (!$vericode_verify_record) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        VericodeVerifyRecordManager::deleteById($vericode_verify_record->id);
        return ApiResponse::makeResponse(true, "删除成功", ApiResponse::SUCCESS_CODE);
    }


    /*
    * 查看信息
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:54
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
        $vericode_verify_record = VericodeVerifyRecordManager::getById($data['id']);
        $vericode_verify_record = VericodeVerifyRecordManager::getInfoByLevel($vericode_verify_record, '0');

        return view('admin.vericodeVerifyRecord.info', ['self_admin' => $self_admin, 'data' => $vericode_verify_record]);
    }

}

