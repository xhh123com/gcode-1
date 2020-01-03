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

    private $real_name;          //用户姓名
    private $nick_name;       //昵称
    private $avatar;      //头像图片
    private $phonenum;      //电话号
    private $gender = '0';      //用户性别 0：保密 1：男性 2：女性
    private $country;      //国家
    private $province;      //省份
    private $city;      //城市
    private $birthday;      //生日
    private $language;      //语言
    private $level = '0';       //等级
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}