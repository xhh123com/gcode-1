<?php

/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/20
* Time: 10:50
*/

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\ScoreRuleManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\ScoreRule;
use Illuminate\Http\Request;

class ScoreRuleController
{

    /*
    * 首页
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:45
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
        $score_rules =ScoreRuleManager::getListByCon($con_arr, true);
        foreach ($score_rules as $score_rule) {
        $score_rule = ScoreRuleManager::getInfoByLevel($score_rule, '');
        }

        return view('admin.scoreRule.index', ['self_admin' => $self_admin, 'datas' => $score_rules, 'con_arr' => $con_arr]);
    }

    /*
    * 编辑-get
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:45
    */
    public function edit(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        $score_rule = new ScoreRule();
        if (array_key_exists('id', $data)) {
        $score_rule = ScoreRuleManager::getById($data['id']);
        $score_rule = ScoreRuleManager::getInfoByLevel($score_rule, "");
        }
        return view('admin.scoreRule.edit', ['self_admin' => $self_admin, 'data' => $score_rule, 'upload_token' => $upload_token]);
    }


    /*
    * 添加或编辑-post
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:45
    */
    public function editPost(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        $score_rule = new ScoreRule();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $score_rule = ScoreRuleManager::getById($data['id']);
        }
        $data['admin_id'] = $self_admin['id'];
        $score_rule = ScoreRuleManager::setInfo($score_rule, $data);
        ScoreRuleManager::save($score_rule);
        return ApiResponse::makeResponse(true, $score_rule, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 设置状态
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:45
    */
    public function setStatus(Request $request, $id)
    {
        $data = $request->all();
        $score_rule = ScoreRuleManager::getById($data['id']);
        if (!$score_rule) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        $score_rule = ScoreRuleManager::setInfo($score_rule, $data);
        ScoreRuleManager::save($score_rule);
        return ApiResponse::makeResponse(true, $score_rule, ApiResponse::SUCCESS_CODE);
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
        $score_rule = ScoreRuleManager::getById($data['id']);
        if (!$score_rule) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        ScoreRuleManager::deleteById($score_rule->id);
        return ApiResponse::makeResponse(true, "删除成功", ApiResponse::SUCCESS_CODE);
    }


    /*
    * 查看信息
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:45
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
        $score_rule = ScoreRuleManager::getById($data['id']);
        $score_rule = ScoreRuleManager::getInfoByLevel($score_rule, '0');

        return view('admin.scoreRule.info', ['self_admin' => $self_admin, 'data' => $score_rule]);
    }

}

