<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class EasemobUserDoc
{
    private $collection_name = "easemob_user";       //mongodb的collection名称

    private $uuid;          //环信id
    private $username;          //用户id
    private $password;          //密码
    private $nickname;          //昵称
    private $activated = '1';          //用户是否已激活，“1”已激活，“0“封禁，封禁需要通过解禁接口进行解禁，才能正常登录
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}