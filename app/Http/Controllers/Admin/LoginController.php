<?php

/**
 * Created by PhpStorm.
 * User: HappyQi
 * Date: 2017/10/3
 * Time: 0:38
 */

namespace App\Http\Controllers\Admin;

use App\Components\AdminLoginManager;
use App\Components\AdminManager;
use App\Components\Common\ApiResponse;
use App\Components\Project;
use App\Components\Common\Utils;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Components\Common\RequestValidator;

class LoginController extends Controller
{
    //GET方式-转移登录界面
    public function login(Request $request)
    {
        $admin = $request->session()->get('self_admin');
        return view('admin.login.login', ['self_admin' => $admin]);
    }

    //POST-实现登录逻辑
    public function loginPost(Request $request)
    {
        $data = $request->all();
        Utils::processLog(__METHOD__, '', 'data:' . json_encode($data));
        //参数校验
        $requestValidationResult = RequestValidator::validator($request->all(), [
            'phonenum' => 'required',
            'password' => 'required',
            'captcha_code' => 'required',
        ]);
        if ($requestValidationResult !== true) {
            return ApiResponse::makeResponse(false, "", ApiResponse::NEED_PHONENUM_PASSWORD_CAPTCHA_CODE);
        }
        //校验验证码
        $milkcaptcha = $request->session()->get('milkcaptcha');
        Utils::processLog(__METHOD__, '', 'milkcaptcha:' . json_encode($milkcaptcha));
        if ($data['captcha_code'] != $milkcaptcha) {
            return ApiResponse::makeResponse(false, "", ApiResponse::CAPTCHA_CODE_ERROR);
        }
        //判断手机号
        $con_arr = array(
            'phonenum' => $data['phonenum'],
        );
        $admin = AdminManager::getListByCon($con_arr, false)->first();
        Utils::processLog(__METHOD__, '', 'admin:' . json_encode($admin));
        //登录失败
        if ($admin == null) {
            return ApiResponse::makeResponse(false, "", ApiResponse::PHONENUM_ERROR);
        }
        if ($admin['status'] == Utils::STATUS_VALUE_0) {
            return ApiResponse::makeResponse(false, "", ApiResponse::ACCOUNT_INVALID);
        }
        //判断密码
        $con_arr = array(
            'admin_id' => $admin['id'],
            'account_type' => Utils::ACCOUNT_TYPE_TEL_PASSWORD,     //手机号码登录
            've_value2' => $data['password']
        );
        $admin_login = AdminLoginManager::getListByCon($con_arr, false)->first();
        Utils::processLog(__METHOD__, '', 'admin_login:' . json_encode($admin_login));
        //登录失败
        if (!$admin_login) {
            return ApiResponse::makeResponse(false, "", ApiResponse::PASSWORD_ERROR);
        }
        $admin = AdminManager::getInfoByLevel($admin, '');
        $request->session()->put('self_admin', $admin);//写入session

        return ApiResponse::makeResponse(true, $admin, ApiResponse::SUCCESS_CODE, "登录成功");
    }

    //注销登录
    public function logout(Request $request)
    {
        //清空session
        $request->session()->remove('self_admin');
        return redirect('/admin/login');
    }

}