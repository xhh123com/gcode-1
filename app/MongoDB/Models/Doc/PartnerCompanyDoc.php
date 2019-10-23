<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class PartnerCompanyDoc
{
    private $collection_name = "partner_company";       //mongodb的collection名称

    private $partner_id;    //合作方id
    private $name;          //名称
    private $contact;       //合作方联系人姓名
    private $contact_phonenum;      //合作方联系人电话
    private $address;       //地址
    private $intro;     //介绍
    private $p_partner_company_id = 0;      //上级公司id        0：代表本身是总公司
    private $seq = 99;       //排序       值越大越靠前
    private $status = 1;        //状态        0：失效 1：生效

}