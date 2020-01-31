<?php

/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/20
* Time: 10:50
*/

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\ScaleManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\Scale;
use Illuminate\Http\Request;

class ScaleController
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
        $scales =ScaleManager::getListByCon($con_arr, true);
        foreach ($scales as $scale) {
        $scale = ScaleManager::getInfoByLevel($scale, '');
        }

        return view('admin.scale.index', ['self_admin' => $self_admin, 'datas' => $scales, 'con_arr' => $con_arr]);
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
        $scale = new Scale();
        if (array_key_exists('id', $data)) {
        $scale = ScaleManager::getById($data['id']);
        $scale = ScaleManager::getInfoByLevel($scale, "");
        }
        return view('admin.scale.edit', ['self_admin' => $self_admin, 'data' => $scale, 'upload_token' => $upload_token]);
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
        $scale = new Scale();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $scale = ScaleManager::getById($data['id']);
        }
        $data['admin_id'] = $self_admin['id'];
        $scale = ScaleManager::setInfo($scale, $data);
        ScaleManager::save($scale);
        return ApiResponse::makeResponse(true, $scale, ApiResponse::SUCCESS_CODE);
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
        $scale = ScaleManager::getById($data['id']);
        if (!$scale) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        $scale = ScaleManager::setInfo($scale, $data);
        ScaleManager::save($scale);
        return ApiResponse::makeResponse(true, $scale, ApiResponse::SUCCESS_CODE);
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
        $scale = ScaleManager::getById($data['id']);
        if (!$scale) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        ScaleManager::deleteById($scale->id);
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
        $scale = ScaleManager::getById($data['id']);
        $scale = ScaleManager::getInfoByLevel($scale, '0');

        return view('admin.scale.info', ['self_admin' => $self_admin, 'data' => $scale]);
    }

}

