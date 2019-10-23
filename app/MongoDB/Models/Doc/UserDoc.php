<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class UserDoc
{
    private $collection_name = "user";       //mongodb的collection名称

    private $code;          //	用户编码，对接外部系统
    private $real_name;      //	姓名
    private $nick_name;      //	昵称
    private $avatar;      //	头像图片
    private $gender = 0;    //用户性别 0：保密 1：男性 2：女性
    private $height = 0;      //		身高,cm
    private $weight = 0;      //	体重,kg
    private $type = 0;      //	用户类型，预留 0：普通用户
    private $country;      //	国家
    private $province;      //	省份
    private $city;      //	城市
    private $address;      //	地址
    private $birthday;      //	生日
    private $language;      //	语言
    private $level = 0;      //用户级别（预留）
    private $sign;      //		用户签名
    private $a_user_id;      //	上级用户id
    private $system_flag = 0;      //	系统标识 0：非系统 1：系统
    private $seq = 99;        //排序       值越大越靠前
    private $status = 1;        //状态        0：失效 1：生效

}