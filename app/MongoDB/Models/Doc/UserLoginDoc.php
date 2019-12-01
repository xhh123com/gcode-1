<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class UserLoginDoc
{
    private $collection_name = "user_login";       //mongodb的collection名称

    private $user_id;          //	用户id
    private $token;      //	token信息
    private $account_type = '0';      //	登录类型(0：电话+密码 1：电话+短信验证码 2：小程序 3：服务号 4：APP)
    private $ve_value1;      //	校验数据1
    private $ve_value2;         //校验数据2
    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}