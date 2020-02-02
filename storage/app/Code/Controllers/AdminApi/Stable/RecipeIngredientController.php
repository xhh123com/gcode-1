<?php

/**
* Created by PhpStorm.
* User:robot
* Date: 2020-02-02 04:07:16
* Time: 13:29
*/

namespace App\Http\Controllers\AdminApi;


use App\Components\Common\RequestValidator;
use App\Components\RecipeIngredientManager;
use App\Models\RecipeIngredient;
use App\Components\AdminManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use Illuminate\Http\Request;

class RecipeIngredientController
{

    /*
    * 根据id获取信息
    *
    * By Auto CodeCreator
    *
    * 2020-02-02 04:07:16
    */
    public function getById(Request $request)
    {
        $data = $request->all();
        $requestValidationResult = RequestValidator::validator($request->all(), [
            'id' => 'required',
            'self_admin_id' => 'required',
        ]);
        if ($requestValidationResult !== true) {
            return ApiResponse::makeResponse(false, $requestValidationResult, ApiResponse::MISSING_PARAM);
        }
        //过中间件一定存在
        $self_admin = AdminManager::getById($data['self_admin_id']);

        $recipe_ingredient = RecipeIngredientManager::getById($data['id']);
        //补充信息
        if($recipe_ingredient){
            $level = null;
            if (array_key_exists('level', $data) && !Utils::isObjNull($data['level'])) {
                $level = $data['level'];
            }
            $recipe_ingredient = RecipeIngredientManager::getInfoByLevel($recipe_ingredient,$level);
        }
        return ApiResponse::makeResponse(true, $recipe_ingredient, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 根据条件获取列表
    *
    * By Auto CodeCreator
    *
    * 2020-02-02 04:07:16
    */
    public function getListByCon(Request $request)
    {
        $data = $request->all();
        $requestValidationResult = RequestValidator::validator($request->all(), [
        'self_admin_id' => 'required',
        ]);
        if ($requestValidationResult !== true) {
        return ApiResponse::makeResponse(false, $requestValidationResult, ApiResponse::MISSING_PARAM);
        }
        //过中间件一定存在
        $self_admin = AdminManager::getById($data['self_admin_id']);

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
        $recipe_ingredients = RecipeIngredientManager::getListByCon($con_arr, $is_paginate);
        foreach ($recipe_ingredients as $recipe_ingredient) {
            $recipe_ingredient = RecipeIngredientManager::getInfoByLevel($recipe_ingredient, $level);
        }

        return ApiResponse::makeResponse(true, $recipe_ingredients, ApiResponse::SUCCESS_CODE);
    }

    /*
    * 修改添加
    *
    * By Auto CodeCreator
    *
    * 2019-09-26 12:45:38
    */
    public function edit(Request $request)
    {
        $data = $request->all();
        //获取合作方id
        $requestValidationResult = RequestValidator::validator($request->all(), [
        'self_admin_id' => 'required',
        ]);
        if ($requestValidationResult !== true) {
        return ApiResponse::makeResponse(false, $requestValidationResult, ApiResponse::MISSING_PARAM);
        }
        //过中间件一定存在
        $self_admin = AdminManager::getById($data['self_admin_id']);

        $recipe_ingredient = new RecipeIngredient();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $recipe_ingredient = RecipeIngredientManager::getById($data['id']);
        }
        $recipe_ingredient = RecipeIngredientManager::setInfo($recipe_ingredient, $data);
        RecipeIngredientManager::save($recipe_ingredient);
        return ApiResponse::makeResponse(true, $recipe_ingredient, ApiResponse::SUCCESS_CODE);
    }

    /*
    * 删除
    *
    * By Auto CodeCreator
    *
    * 2019-05-18 17:14:16
    */
    public function deleteById(Request $request)
    {
        $data = $request->all();
        //获取合作方id
        $requestValidationResult = RequestValidator::validator($request->all(), [
            'id' => 'required',
            'self_admin_id' => 'required',
        ]);
        if ($requestValidationResult !== true) {
            return ApiResponse::makeResponse(false, $requestValidationResult, ApiResponse::MISSING_PARAM);
        }
        //过中间件一定存在
        $self_admin = AdminManager::getById($data['self_admin_id']);

        $recipe_ingredient = RecipeIngredientManager::getById($data['id']);
        if ($recipe_ingredient) {
            RecipeIngredientManager::deleteById($recipe_ingredient->id);
        }
        return ApiResponse::makeResponse(true, "删除成功", ApiResponse::SUCCESS_CODE);
    }


}

