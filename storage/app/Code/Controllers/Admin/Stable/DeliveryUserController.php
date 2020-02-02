<?php

/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/20
* Time: 10:50
*/

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\DeliveryUserManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\DeliveryUser;
use Illuminate\Http\Request;

class DeliveryUserController
{

    /*
    * 首页
    *
    * By Auto CodeCreator
    *
    * 2020-02-02 04:07:11
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
        $delivery_users =DeliveryUserManager::getListByCon($con_arr, true);
        foreach ($delivery_users as $delivery_user) {
        $delivery_user = DeliveryUserManager::getInfoByLevel($delivery_user, '');
        }

        return view('admin.deliveryUser.index', ['self_admin' => $self_admin, 'datas' => $delivery_users, 'con_arr' => $con_arr]);
    }

    /*
    * 编辑-get
    *
    * By Auto CodeCreator
    *
    * 2020-02-02 04:07:11
    */
    public function edit(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        $delivery_user = new DeliveryUser();
        if (array_key_exists('id', $data)) {
        $delivery_user = DeliveryUserManager::getById($data['id']);
        $delivery_user = DeliveryUserManager::getInfoByLevel($delivery_user, "");
        }
        return view('admin.deliveryUser.edit', ['self_admin' => $self_admin, 'data' => $delivery_user, 'upload_token' => $upload_token]);
    }


    /*
    * 添加或编辑-post
    *
    * By Auto CodeCreator
    *
    * 2020-02-02 04:07:11
    */
    public function editPost(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        $delivery_user = new DeliveryUser();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $delivery_user = DeliveryUserManager::getById($data['id']);
        }
        $data['admin_id'] = $self_admin['id'];
        $delivery_user = DeliveryUserManager::setInfo($delivery_user, $data);
        DeliveryUserManager::save($delivery_user);
        return ApiResponse::makeResponse(true, $delivery_user, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 设置状态
    *
    * By Auto CodeCreator
    *
    * 2020-02-02 04:07:11
    */
    public function setStatus(Request $request, $id)
    {
        $data = $request->all();
        $delivery_user = DeliveryUserManager::getById($data['id']);
        if (!$delivery_user) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        $delivery_user = DeliveryUserManager::setInfo($delivery_user, $data);
        DeliveryUserManager::save($delivery_user);
        return ApiResponse::makeResponse(true, $delivery_user, ApiResponse::SUCCESS_CODE);
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
        $delivery_user = DeliveryUserManager::getById($data['id']);
        if (!$delivery_user) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        DeliveryUserManager::deleteById($delivery_user->id);
        return ApiResponse::makeResponse(true, "删除成功", ApiResponse::SUCCESS_CODE);
    }


    /*
    * 查看信息
    *
    * By Auto CodeCreator
    *
    * 2020-02-02 04:07:11
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
        $delivery_user = DeliveryUserManager::getById($data['id']);
        $delivery_user = DeliveryUserManager::getInfoByLevel($delivery_user, '0');

        return view('admin.deliveryUser.info', ['self_admin' => $self_admin, 'data' => $delivery_user]);
    }

}

