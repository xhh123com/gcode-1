<?php
/**
 * 首页控制器
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/20 0020
 * Time: 20:15
 */

namespace App\Http\Controllers\Admin;

use App\Components\AdminLoginManager;
use App\Components\AdminManager;
use App\Components\Common\DateTool;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminLogin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /*
     * 管理员首页
     *
     * By Ada
     *
     * 2019-06-12
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        //相关搜素条件
        $search_word = null;
        $role = null;
        if (array_key_exists('search_word', $data) && !Utils::isObjNull($data['search_word'])) {
            $search_word = $data['search_word'];
        }
        if (array_key_exists('role', $data) && !Utils::isObjNull($data['role'])) {
            $role = $data['role'];
        }
        $con_arr = array(
            'search_word' => $search_word,
            'role' => $role
        );
        $admins = AdminManager::getListByCon($con_arr, true);
        foreach ($admins as $admin) {
            $admin = AdminManager::getInfoByLevel($admin, '0');
        }
        return view('admin.admin.index', ['datas' => $admins, 'con_arr' => $con_arr]);
    }

    /*
     * 新建或编辑管理员-get
     *
     * By Ada
     *
     * 2019-06-12
     */
    public function edit(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        $admin = new Admin();
        if (array_key_exists('id', $data)) {
            $admin = AdminManager::getById($data['id']);
            $admin = AdminManager::getInfoByLevel($admin, '');
        }
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        return view('admin.admin.edit', ['self_admin' => $self_admin, 'data' => $admin, 'upload_token' => $upload_token]);
    }

    /*
     * 新建或编辑管理员->post
     *
     * By Ada
     *
     * 2019-06-12
     */
    public function editPost(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        $admin = new Admin();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            $admin = AdminManager::getById($data['id']);
            //保存查看手机号是否重复
            if (array_key_exists('phonenum', $data) && !Utils::isObjNull($data['phonenum'])) {
                $e_admin = AdminManager::getListByCon(['phonenum' => $data['phonenum']], false)->first();
                if ($e_admin->id != $data['id']) {
                    return ApiResponse::makeResponse(false, "手机号重复", ApiResponse::PHONENUM_DUP);
                }
            }
        } else {
            //新建进行校验，手机号是否重复
            if (array_key_exists('phonenum', $data) && !Utils::isObjNull($data['phonenum'])) {
                $con_arr = array(
                    'phonenum' => $data['phonenum']
                );
                $e_admin = AdminManager::getListByCon($con_arr, false)->first();
                if ($e_admin) {
                    return ApiResponse::makeResponse(false, "手机号重复", ApiResponse::PHONENUM_DUP);
                }
            }
        }
        $admin = AdminManager::setInfo($admin, $data);
        $admin->admin_id = $self_admin->id;
        $admin->save();
        //如果不存在id代表新建，则默认设置密码
        if (!array_key_exists('id', $data) || Utils::isObjNull($data['id'])) {
            $password = env('DEFAULT_PASSWORD', '');  //该password为Aa123456的码
            $admin_login = new AdminLogin();
            $admin_login->admin_id = $admin['id'];
            $admin_login->account_type = Utils::ACCOUNT_TYPE_TEL_PASSWORD;
            $admin_login->ve_value1 = $data['phonenum'];
            $admin_login->ve_value2 = $password;
            $admin_login->token = Utils::getGUID();
            $admin_login->login_at = DateTool::getCurrentTime();
            $admin_login->save();
        }
        return ApiResponse::makeResponse(true, $data, ApiResponse::SUCCESS_CODE);
    }

    /*
     * 设置管理员状态
     *
     * By Ada
     *
     * 2019-06-12
     */
    public function setStatus(Request $request, $id)
    {
        $data = $request->all();
        if (is_numeric($id) !== true) {
            return ApiResponse::makeResponse(false, "合规校验失败，请检查参数", ApiResponse::INNER_ERROR);
        }
        $admin = AdminManager::getById($id);
        $admin->status = $data['status'];
        $admin->save();
        return ApiResponse::makeResponse(true, $admin, ApiResponse::SUCCESS_CODE);
    }

    /*
     * 编辑个人密码-get
     *
     * By Ada
     *
     * 2019-06-12
     */
    public function editPassword(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        $upload_token = QNManager::uploadToken();
        return view('admin.admin.editPassword', ['self_admin' => $self_admin, 'data' => $self_admin, 'upload_token' => $upload_token]);
    }

    /*
     * 新建或编辑个人密码->post
     *
     * By Ada
     *
     * 2019-06-12
     */
    public function editPasswordPost(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        $con_arr = array(
            'admin_id' => $self_admin->id,
            'account_type' => Utils::ACCOUNT_TYPE_TEL_PASSWORD
        );
        $self_admin_login = AdminLoginManager::getListByCon($con_arr, false)->first();
        Utils::processLog(__METHOD__, 'admin_login:' . json_encode($self_admin_login));
        if ($data['old_password'] != $self_admin_login->ve_value2) {
            return ApiResponse::makeResponse(false, "原密码输入不正确", ApiResponse::INNER_ERROR, "原密码输入不正确");
        }
        $self_admin_login->ve_value2 = $data['password'];
        $self_admin_login->save();
        return ApiResponse::makeResponse(true, "修改成功", ApiResponse::SUCCESS_CODE);
    }


    /*
     * 编辑个人密码-get
     *
     * By Ada
     *
     * 2019-06-12
     */
    public function editMyself(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        $admin = AdminManager::getById($self_admin->id);
        $admin = AdminManager::getInfoByLevel($admin, '');
        Utils::processLog(__METHOD__, '', 'admin_b:' . json_encode($admin));
        $upload_token = QNManager::uploadToken();
        return view('admin.admin.editMyself', ['self_admin' => $self_admin, 'data' => $admin, 'upload_token' => $upload_token]);
    }

    /*
     * 新建或编辑个人密码->post
     *
     * By Ada
     *
     * 2019-06-12
     */
    public function editMyselfPost(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        Utils::processLog(__METHOD__, '', 'admin:' . json_encode($self_admin));
        $admin = AdminManager::getById($self_admin->id);
        $admin = AdminManager::setInfo($admin, $data);
        $admin->save();
        return ApiResponse::makeResponse(true, "修改成功", ApiResponse::SUCCESS_CODE);
    }

    /*
     * 重置密码
     *
     * By TerryQi
     *
     * 2019-06-12
     */
    public function resetPassword(Request $request, $id)
    {
        $data = $request->all();
        if (is_numeric($id) !== true) {
            return ApiResponse::makeResponse(false, "合规校验失败，请检查参数", ApiResponse::INNER_ERROR);
        }
        $self_admin = AdminManager::getById($id);
        $self_admin_login = AdminLoginManager::resetPassword($self_admin->id);

        return ApiResponse::makeResponse(true, $self_admin_login, ApiResponse::SUCCESS_CODE);
    }


}