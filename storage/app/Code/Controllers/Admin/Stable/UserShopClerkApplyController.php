<?php

/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/20
* Time: 10:50
*/

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\UserShopClerkApplyManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\UserShopClerkApply;
use Illuminate\Http\Request;

class UserShopClerkApplyController
{

    /*
    * 首页
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:53
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
        $user_shop_clerk_applys =UserShopClerkApplyManager::getListByCon($con_arr, true);
        foreach ($user_shop_clerk_applys as $user_shop_clerk_apply) {
        $user_shop_clerk_apply = UserShopClerkApplyManager::getInfoByLevel($user_shop_clerk_apply, '');
        }

        return view('admin.userShopClerkApply.index', ['self_admin' => $self_admin, 'datas' => $user_shop_clerk_applys, 'con_arr' => $con_arr]);
    }

    /*
    * 编辑-get
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:53
    */
    public function edit(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        $user_shop_clerk_apply = new UserShopClerkApply();
        if (array_key_exists('id', $data)) {
        $user_shop_clerk_apply = UserShopClerkApplyManager::getById($data['id']);
        $user_shop_clerk_apply = UserShopClerkApplyManager::getInfoByLevel($user_shop_clerk_apply, "");
        }
        return view('admin.userShopClerkApply.edit', ['self_admin' => $self_admin, 'data' => $user_shop_clerk_apply, 'upload_token' => $upload_token]);
    }


    /*
    * 添加或编辑-post
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:53
    */
    public function editPost(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        $user_shop_clerk_apply = new UserShopClerkApply();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $user_shop_clerk_apply = UserShopClerkApplyManager::getById($data['id']);
        }
        $data['admin_id'] = $self_admin['id'];
        $user_shop_clerk_apply = UserShopClerkApplyManager::setInfo($user_shop_clerk_apply, $data);
        UserShopClerkApplyManager::save($user_shop_clerk_apply);
        return ApiResponse::makeResponse(true, $user_shop_clerk_apply, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 设置状态
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:53
    */
    public function setStatus(Request $request, $id)
    {
        $data = $request->all();
        $user_shop_clerk_apply = UserShopClerkApplyManager::getById($data['id']);
        if (!$user_shop_clerk_apply) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        $user_shop_clerk_apply = UserShopClerkApplyManager::setInfo($user_shop_clerk_apply, $data);
        UserShopClerkApplyManager::save($user_shop_clerk_apply);
        return ApiResponse::makeResponse(true, $user_shop_clerk_apply, ApiResponse::SUCCESS_CODE);
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
        $user_shop_clerk_apply = UserShopClerkApplyManager::getById($data['id']);
        if (!$user_shop_clerk_apply) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        UserShopClerkApplyManager::deleteById($user_shop_clerk_apply->id);
        return ApiResponse::makeResponse(true, "删除成功", ApiResponse::SUCCESS_CODE);
    }


    /*
    * 查看信息
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:53
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
        $user_shop_clerk_apply = UserShopClerkApplyManager::getById($data['id']);
        $user_shop_clerk_apply = UserShopClerkApplyManager::getInfoByLevel($user_shop_clerk_apply, '0');

        return view('admin.userShopClerkApply.info', ['self_admin' => $self_admin, 'data' => $user_shop_clerk_apply]);
    }

}

