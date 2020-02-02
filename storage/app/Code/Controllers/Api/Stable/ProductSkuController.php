<?php

/**
* Created by PhpStorm.
* User:robot
* Date: 2020-02-02 04:07:14
* Time: 13:29
*/

namespace App\Http\Controllers\Api;


use App\Components\Common\RequestValidator;
use App\Components\ProductSkuManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use Illuminate\Http\Request;

class ProductSkuController
{

    /*
    * 根据id获取信息
    *
    * By Auto CodeCreator
    *
    * 2020-02-02 04:07:14
    */
    public function getById(Request $request)
    {
        $data = $request->all();
        $requestValidationResult = RequestValidator::validator($request->all(), [
            'id' => 'required',
        ]);
        if ($requestValidationResult !== true) {
            return ApiResponse::makeResponse(false, $requestValidationResult, ApiResponse::MISSING_PARAM);
        }
        $product_sku = ProductSkuManager::getById($data['id']);
        //补充信息
        if($product_sku){
            $level = null;
            if (array_key_exists('level', $data) && !Utils::isObjNull($data['level'])) {
                $level = $data['level'];
            }
            $product_sku = ProductSkuManager::getInfoByLevel($product_sku,$level);
        }
        return ApiResponse::makeResponse(true, $product_sku, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 根据条件获取列表
    *
    * By Auto CodeCreator
    *
    * 2020-02-02 04:07:14
    */
    public function getListByCon(Request $request)
    {
        $data = $request->all();
        //自定义参数位置
        $status = '1';

        //分页和信息级别
        $is_paginate = true;
        $level='Y';

        //参数配置
        if (array_key_exists('status', $data) && !Utils::isObjNull($data['status'])) {
            $status = $data['status'];
        }
        //配置获取信息级别
        if (array_key_exists('level', $data) && !Utils::isObjNull($data['level'])) {
            $level = $data['level'];
        }
        //配置是否分页
        if (array_key_exists('is_paginate', $data) && !Utils::isObjNull($data['is_paginate'])) {
            $is_paginate = $data['is_paginate'];
        }

        //配置条件
        if (array_key_exists('status', $data) && !Utils::isObjNull($data['status'])) {
            $status = $data['status'];
        }
        $con_arr = array(
            'status' => $status,
        );
        $product_skus = ProductSkuManager::getListByCon($con_arr, $is_paginate);
        foreach ($product_skus as $product_sku) {
            $product_sku = ProductSkuManager::getInfoByLevel($product_sku, $level);
        }

        return ApiResponse::makeResponse(true, $product_skus, ApiResponse::SUCCESS_CODE);
    }
}

