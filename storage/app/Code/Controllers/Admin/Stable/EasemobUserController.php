<?php

/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/20
* Time: 10:50
*/

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\EasemobUserManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\EasemobUser;
use Illuminate\Http\Request;

class EasemobUserController
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
        $easemob_users =EasemobUserManager::getListByCon($con_arr, true);
        foreach ($easemob_users as $easemob_user) {
        $easemob_user = EasemobUserManager::getInfoByLevel($easemob_user, '');
        }

        return view('admin.easemobUser.index', ['self_admin' => $self_admin, 'datas' => $easemob_users, 'con_arr' => $con_arr]);
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
        $easemob_user = new EasemobUser();
        if (array_key_exists('id', $data)) {
        $easemob_user = EasemobUserManager::getById($data['id']);
        $easemob_user = EasemobUserManager::getInfoByLevel($easemob_user, "");
        }
        return view('admin.easemobUser.edit', ['self_admin' => $self_admin, 'data' => $easemob_user, 'upload_token' => $upload_token]);
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
        $easemob_user = new EasemobUser();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $easemob_user = EasemobUserManager::getById($data['id']);
        }
        $data['admin_id'] = $self_admin['id'];
        $easemob_user = EasemobUserManager::setInfo($easemob_user, $data);
        EasemobUserManager::save($easemob_user);
        return ApiResponse::makeResponse(true, $easemob_user, ApiResponse::SUCCESS_CODE);
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
        $easemob_user = EasemobUserManager::getById($data['id']);
        if (!$easemob_user) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        $easemob_user = EasemobUserManager::setInfo($easemob_user, $data);
        EasemobUserManager::save($easemob_user);
        return ApiResponse::makeResponse(true, $easemob_user, ApiResponse::SUCCESS_CODE);
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
        $easemob_user = EasemobUserManager::getById($data['id']);
        if (!$easemob_user) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        EasemobUserManager::deleteById($easemob_user->id);
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
        $easemob_user = EasemobUserManager::getById($data['id']);
        $easemob_user = EasemobUserManager::getInfoByLevel($easemob_user, '0');

        return view('admin.easemobUser.info', ['self_admin' => $self_admin, 'data' => $easemob_user]);
    }

}

