<?php
/**
 * File_Name:ApiResponse.php
 * Author: leek
 * Date: 2017/8/23
 * Time: 14:37
 */

namespace App\Components\Common;

class ApiResponse
{
    /* 错误码表 */

    // 通用错误
    const UNKNOW_ERROR = 999;
    const MISSING_PARAM = 901;
    const INNER_ERROR = 902;
    const UPLOAD_ERROR = 903;
    const SECRET_ERROR = 904;

    // 成功
    const SUCCESS_CODE = 200;

    // 用户相关
    const TOKEN_LOST = 101;
    const TOKEN_ERROR = 102;
    const USER_ID_LOST = 103;
    const REGISTER_FAILED = 104;
    const NO_USER = 105;
    const SEND_VERTIFY_ERROR = 106;
    const VERTIFY_ERROR = 107;
    const PHONENUM_DUP = 108;
    const PHONENUM_ALREAD_REGISTED = 109;
    const LOGIN_ERROR = 110;
    const CAN_NOT_FIND_ACCOUTN = 111;
    const ORIGIN_PASSWORD_ERROR = 112;
    const CHANGE_PAWWORD_SUCCESS = 113;
    const CHANGE_PAWWORD_FAILED = 114;
    const VERTIFY_INVALID = 115;

    const NEED_PHONENUM_PASSWORD_CAPTCHA_CODE = 121;
    const CAPTCHA_CODE_ERROR = 122;
    const ACCOUNT_INVALID = 123;
    const PHONENUM_ERROR = 124;
    const PASSWORD_ERROR = 125;


    /* 映射错误信息 */
    public static $errorMessage = [
        self::SUCCESS_CODE => '操作成功',

        self::UNKNOW_ERROR => '未知错误',
        self::MISSING_PARAM => '缺少参数',
        self::INNER_ERROR => '逻辑错误',
        self::UPLOAD_ERROR => '上传错误',
        self::SECRET_ERROR => '密钥错误',

        self::TOKEN_LOST => '缺少token',
        self::TOKEN_ERROR => 'token校验失败',
        self::USER_ID_LOST => '缺少用户编码',
        self::REGISTER_FAILED => '注册失败',
        self::NO_USER => '未找到用户',
        self::VERTIFY_ERROR => '验证码验证失败',
        self::PHONENUM_ALREAD_REGISTED => '手机号已经注册',
        self::LOGIN_ERROR => '登录错误',
        self::CAN_NOT_FIND_ACCOUTN => '没有找到此账号',
        self::ORIGIN_PASSWORD_ERROR => '原密码错误',
        self::CHANGE_PAWWORD_SUCCESS => '修改密码成功',
        self::CHANGE_PAWWORD_FAILED => '修改密码失败',
        self::VERTIFY_INVALID => '验证码失效',

        self::NEED_PHONENUM_PASSWORD_CAPTCHA_CODE => '请输入手机号、密码、验证码',
        self::CAPTCHA_CODE_ERROR => '验证码错误',
        self::ACCOUNT_INVALID => '账号已经禁用',
        self::PHONENUM_ERROR => '手机号错误',
        self::PASSWORD_ERROR => '密码错误',
    ];

    /* 映射错误信息 */

    public static function makeResponse($result, $ret, $code, $message = null)
    {
        $respones = [];
        $respones['code'] = $code;

        if ($result === true) {
            $respones['result'] = true;
            $respones['ret'] = $ret;
            if (isset($message)) {
                $respones['message'] = $message;
            } else {
                $respones['message'] = self::$errorMessage[$code];
            }
        } else {
            $respones['result'] = false;
            $respones['ret'] = $ret;
            if (isset($message)) {
                $respones['message'] = $message;
            } else {
                if (array_key_exists($code, self::$errorMessage)) {
                    $respones['message'] = self::$errorMessage[$code];
                } else {
                    $respones['message'] = 'undefind error code';
                }
            }
        }

        Utils::ResponseLog(__METHOD__, $respones);
        return response()->json($respones);
    }
}
