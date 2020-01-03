<?php

/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/20
* Time: 10:50
*/

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\ProductLevel2TypeManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\ProductLevel2Type;
use Illuminate\Http\Request;

class ProductLevel2TypeController
{

    /*
    * 首页
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:43
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
        $product_level2_types =ProductLevel2TypeManager::getListByCon($con_arr, true);
        foreach ($product_level2_types as $product_level2_type) {
        $product_level2_type = ProductLevel2TypeManager::getInfoByLevel($product_level2_type, '');
        }

        return view('admin.productLevel2Type.index', ['self_admin' => $self_admin, 'datas' => $product_level2_types, 'con_arr' => $con_arr]);
    }

    /*
    * 编辑-get
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:43
    */
    public function edit(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        $product_level2_type = new ProductLevel2Type();
        if (array_key_exists('id', $data)) {
        $product_level2_type = ProductLevel2TypeManager::getById($data['id']);
        $product_level2_type = ProductLevel2TypeManager::getInfoByLevel($product_level2_type, "");
        }
        return view('admin.productLevel2Type.edit', ['self_admin' => $self_admin, 'data' => $product_level2_type, 'upload_token' => $upload_token]);
    }


    /*
    * 添加或编辑-post
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:43
    */
    public function editPost(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        $product_level2_type = new ProductLevel2Type();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $product_level2_type = ProductLevel2TypeManager::getById($data['id']);
        }
        $data['admin_id'] = $self_admin['id'];
        $product_level2_type = ProductLevel2TypeManager::setInfo($product_level2_type, $data);
        ProductLevel2TypeManager::save($product_level2_type);
        return ApiResponse::makeResponse(true, $product_level2_type, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 设置状态
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:43
    */
    public function setStatus(Request $request, $id)
    {
        $data = $request->all();
        $product_level2_type = ProductLevel2TypeManager::getById($data['id']);
        if (!$product_level2_type) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        $product_level2_type = ProductLevel2TypeManager::setInfo($product_level2_type, $data);
        ProductLevel2TypeManager::save($product_level2_type);
        return ApiResponse::makeResponse(true, $product_level2_type, ApiResponse::SUCCESS_CODE);
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
        $product_level2_type = ProductLevel2TypeManager::getById($data['id']);
        if (!$product_level2_type) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        ProductLevel2TypeManager::deleteById($product_level2_type->id);
        return ApiResponse::makeResponse(true, "删除成功", ApiResponse::SUCCESS_CODE);
    }


    /*
    * 查看信息
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:43
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
        $product_level2_type = ProductLevel2TypeManager::getById($data['id']);
        $product_level2_type = ProductLevel2TypeManager::getInfoByLevel($product_level2_type, '0');

        return view('admin.productLevel2Type.info', ['self_admin' => $self_admin, 'data' => $product_level2_type]);
    }

}

