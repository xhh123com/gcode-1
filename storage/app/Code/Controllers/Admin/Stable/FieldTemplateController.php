<?php

/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/20
* Time: 10:50
*/

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\FieldTemplateManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\FieldTemplate;
use Illuminate\Http\Request;

class FieldTemplateController
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
        $field_templates =FieldTemplateManager::getListByCon($con_arr, true);
        foreach ($field_templates as $field_template) {
        $field_template = FieldTemplateManager::getInfoByLevel($field_template, '');
        }

        return view('admin.fieldTemplate.index', ['self_admin' => $self_admin, 'datas' => $field_templates, 'con_arr' => $con_arr]);
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
        $field_template = new FieldTemplate();
        if (array_key_exists('id', $data)) {
        $field_template = FieldTemplateManager::getById($data['id']);
        $field_template = FieldTemplateManager::getInfoByLevel($field_template, "");
        }
        return view('admin.fieldTemplate.edit', ['self_admin' => $self_admin, 'data' => $field_template, 'upload_token' => $upload_token]);
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
        $field_template = new FieldTemplate();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $field_template = FieldTemplateManager::getById($data['id']);
        }
        $data['admin_id'] = $self_admin['id'];
        $field_template = FieldTemplateManager::setInfo($field_template, $data);
        FieldTemplateManager::save($field_template);
        return ApiResponse::makeResponse(true, $field_template, ApiResponse::SUCCESS_CODE);
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
        $field_template = FieldTemplateManager::getById($data['id']);
        if (!$field_template) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        $field_template = FieldTemplateManager::setInfo($field_template, $data);
        FieldTemplateManager::save($field_template);
        return ApiResponse::makeResponse(true, $field_template, ApiResponse::SUCCESS_CODE);
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
        $field_template = FieldTemplateManager::getById($data['id']);
        if (!$field_template) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        FieldTemplateManager::deleteById($field_template->id);
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
        $field_template = FieldTemplateManager::getById($data['id']);
        $field_template = FieldTemplateManager::getInfoByLevel($field_template, '0');

        return view('admin.fieldTemplate.info', ['self_admin' => $self_admin, 'data' => $field_template]);
    }

}

