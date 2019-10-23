<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class AdminLoginDoc
{
    private $collection_name = "admin_login";       //mongodb的collection名称

    private $admin_id;    //管理员id
    private $token;    //用户token
    private $account_type = 0;    //登录类型，0：电话+密码、1：电话+短信验证码，2：小程序、3：服务号
    private $ve_value1;    //验证数据1
    private $ve_value2;    //验证数据2
    private $login_at;    //登录时间
    private $valid_time;    //有效时间
    private $seq = 99;       //排序       值越大越靠前
    private $status = 1;        //状态        0：失效 1：生效

}