<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class PartnerUserDoc
{
    private $collection_name = "partner_user";       //mongodb的collection名称

    private $partner_id;    //合作方id
    private $partner_company_id;    //合作方公司id
    private $code;    //工号
    private $name;          //名称
    private $avatar;       //头像
    private $phonenum;      //手机号
    private $email;      //邮箱
    private $remark;       //备注
    private $duty;      //职责
    private $role = 100;          //角色（后续可以扩展） 100：普通人员 200：管理员
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效
}