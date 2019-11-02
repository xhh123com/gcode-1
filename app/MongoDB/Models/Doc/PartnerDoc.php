<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class PartnerDoc
{
    private $collection_name = "partner";       //mongodb的collection名称

    private $name;  //合作方名称
    private $contact;      //合作方联系人姓名
    private $contact_phonenum;      //合作方联系人电话
    private $address;       //地址
    private $zip_code;      //邮编
    private $intro;     //介绍
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}