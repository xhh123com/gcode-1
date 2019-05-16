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

    // 下单操作相关
    const UITIFY_ORDER_FAILED = 300;
    const COUPON_IS_INVAILD = 301;
    const COUPON_IS_OUT_DATE = 302;
    const COUPON_IS_USED = 303;
    const COUPON_IS_NOT_CONDITION = 304;

    // 信息操作相关
    const FIND_ERROR = 400;
    const ADD_ERROR = 401;
    const EDIT_ERROR = 402;
    const DELETE_ERROR = 403;
    const SAVE_ERROR = 404;
    const DELETE_SUCCESS = 405;

    // 点赞感谢相关
    const NO_LIKE = 500;
    const ALREDAY_LIKE = 501;
    const NO_TNANK = 502;
    const ALREDAY_THANK = 503;

    /* 映射错误信息 */
    public static $errorMassage = [
        self::SUCCESS_CODE => '成功',

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

        self::UITIFY_ORDER_FAILED => '统一下单失败',
        self::COUPON_IS_INVAILD => '优惠券无效',
        self::COUPON_IS_OUT_DATE => '优惠券使用期限未开始或已结束',
        self::COUPON_IS_USED => '优惠券已使用',
        self::COUPON_IS_NOT_CONDITION => '优惠券不满足使用条件',

        self::FIND_ERROR => '没有找到相关信息',
        self::ADD_ERROR => '添加失败',
        self::EDIT_ERROR => '编辑失败',
        self::DELETE_ERROR => '删除失败',
        self::SAVE_ERROR => '保存失败',
        self::DELETE_SUCCESS => '删除成功',

        self::NO_LIKE => '还没点过赞',
        self::ALREDAY_LIKE => '已经点过赞',
        self::NO_TNANK => '还没感过谢',
        self::ALREDAY_THANK => '已经感过谢',

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
                $respones['message'] = self::$errorMassage[$code];
            }
        } else {
            $respones['result'] = false;
            if ($ret) {
                $respones['message'] = $ret;
            } else {
                if (array_key_exists($code, self::$errorMassage)) {
                    $respones['message'] = self::$errorMassage[$code];
                } else {
                    $respones['message'] = 'undefind error code';
                }
            }
        }

        Utils::ResponseLog(__METHOD__, $respones);
        return response()->json($respones);
    }
}
