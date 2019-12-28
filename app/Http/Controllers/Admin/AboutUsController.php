<?php

/**
 * Created by PhpStorm.
 * User: mtt17
 * Date: 2018/4/20
 * Time: 10:50
 */

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\AboutUsManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController
{

    /*
    * 首页
    *
    * By Auto CodeCreator
    *
    * 2019-08-18 17:16:08
    */
    public function index(Request $request)
    {
        $admin = $request->session()->get('admin');
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
        $about_uss = AboutUsManager::getListByCon($con_arr, true);
        foreach ($about_uss as $about_us) {
            $about_us = AboutUsManager::getInfoByLevel($about_us, '');
        }

        return view('admin.aboutUs.index', ['admin' => $admin, 'datas' => $about_uss, 'con_arr' => $con_arr]);
    }

    /*
    * 编辑-get
    *
    * By Auto CodeCreator
    *
    * 2019-08-18 17:16:08
    */
    public function edit(Request $request)
    {
        $data = $request->all();
        $admin = $request->session()->get('admin');
        //生成七牛token
        $upload_token = QNManager::uploadToken();

        $about_us = AboutUsManager::getListByCon(['status' => '1'], false)->first();
        if (!$about_us) {
            $about_us = new AboutUs();
        }

        return view('admin.aboutUs.edit', ['admin' => $admin, 'data' => $about_us, 'upload_token' => $upload_token]);
    }


    /*
    * 添加或编辑-post
    *
    * By Auto CodeCreator
    *
    * 2019-08-18 17:16:08
    */
    public function editPost(Request $request)
    {
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $about_us = new AboutUs();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $about_us = AboutUsManager::getById($data['id']);
        }
        $data['admin_id'] = $admin['id'];
        $about_us = AboutUsManager::setInfo($about_us, $data);
        AboutUsManager::save($about_us);
        return ApiResponse::makeResponse(true, $about_us, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 设置状态
    *
    * By Auto CodeCreator
    *
    * 2019-08-18 17:16:08
    */
    public function setStatus(Request $request, $id)
    {
        $data = $request->all();
        if (is_numeric($id) !== true) {
            return ApiResponse::makeResponse(false, "合规校验失败，请检查参数", ApiResponse::INNER_ERROR);
        }
        $about_us = AboutUsManager::getById($data['id']);
        $about_us = AboutUsManager::setInfo($about_us, $data);
        AboutUsManager::save($about_us);
        return ApiResponse::makeResponse(true, $about_us, ApiResponse::SUCCESS_CODE);
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
        if (is_numeric($id) !== true) {
            return ApiResponse::makeResponse(false, "合规校验失败，请检查参数", ApiResponse::INNER_ERROR);
        }
        $about_us = AboutUsManager::getById($data['id']);
        if ($about_us) {
            AboutUsManager::deleteById($about_us->id);
        }
        return ApiResponse::makeResponse(true, "删除成功", ApiResponse::SUCCESS_CODE);
    }


    /*
    * 查看信息
    *
    * By Auto CodeCreator
    *
    * 2019-08-18 17:16:08
    *
    */
    public function info(Request $request)
    {
        $data = $request->all();
        $admin = $request->session()->get('admin');
        //合规校验
        $requestValidationResult = RequestValidator::validator($request->all(), [
            'id' => 'required',
        ]);
        if ($requestValidationResult !== true) {
            return redirect()->action('\App\Http\Controllers\Admin\IndexController@error', ['msg' => '合规校验失败，请检查参数' . $requestValidationResult]);
        }
        //信息
        $about_us = AboutUsManager::getById($data['id']);
        $about_us = AboutUsManager::getInfoByLevel($about_us, '0');

        return view('admin.aboutUs.info', ['admin' => $admin, 'data' => $about_us]);
    }

}

