<?php

/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/20
* Time: 10:50
*/

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\OrderProductManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderProductController
{

    /*
    * 首页
    *
    * By Auto CodeCreator
    *
    * 2020-02-02 04:07:12
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
        $order_products =OrderProductManager::getListByCon($con_arr, true);
        foreach ($order_products as $order_product) {
        $order_product = OrderProductManager::getInfoByLevel($order_product, '');
        }

        return view('admin.orderProduct.index', ['self_admin' => $self_admin, 'datas' => $order_products, 'con_arr' => $con_arr]);
    }

    /*
    * 编辑-get
    *
    * By Auto CodeCreator
    *
    * 2020-02-02 04:07:12
    */
    public function edit(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        $order_product = new OrderProduct();
        if (array_key_exists('id', $data)) {
        $order_product = OrderProductManager::getById($data['id']);
        $order_product = OrderProductManager::getInfoByLevel($order_product, "");
        }
        return view('admin.orderProduct.edit', ['self_admin' => $self_admin, 'data' => $order_product, 'upload_token' => $upload_token]);
    }


    /*
    * 添加或编辑-post
    *
    * By Auto CodeCreator
    *
    * 2020-02-02 04:07:12
    */
    public function editPost(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        $order_product = new OrderProduct();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $order_product = OrderProductManager::getById($data['id']);
        }
        $data['admin_id'] = $self_admin['id'];
        $order_product = OrderProductManager::setInfo($order_product, $data);
        OrderProductManager::save($order_product);
        return ApiResponse::makeResponse(true, $order_product, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 设置状态
    *
    * By Auto CodeCreator
    *
    * 2020-02-02 04:07:12
    */
    public function setStatus(Request $request, $id)
    {
        $data = $request->all();
        $order_product = OrderProductManager::getById($data['id']);
        if (!$order_product) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        $order_product = OrderProductManager::setInfo($order_product, $data);
        OrderProductManager::save($order_product);
        return ApiResponse::makeResponse(true, $order_product, ApiResponse::SUCCESS_CODE);
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
        $order_product = OrderProductManager::getById($data['id']);
        if (!$order_product) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        OrderProductManager::deleteById($order_product->id);
        return ApiResponse::makeResponse(true, "删除成功", ApiResponse::SUCCESS_CODE);
    }


    /*
    * 查看信息
    *
    * By Auto CodeCreator
    *
    * 2020-02-02 04:07:12
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
        $order_product = OrderProductManager::getById($data['id']);
        $order_product = OrderProductManager::getInfoByLevel($order_product, '0');

        return view('admin.orderProduct.info', ['self_admin' => $self_admin, 'data' => $order_product]);
    }

}

