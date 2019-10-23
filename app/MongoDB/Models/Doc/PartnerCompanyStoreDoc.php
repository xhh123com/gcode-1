<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class PartnerCompanyStoreDoc
{
    private $collection_name = "partner_company_store";       //mongodb的collection名称

    private $partner_id;    //合作方id
    private $partner_company_id;          //合同id
    private $name;          //投放点名称
    private $phonenum;       //投放点电话
    private $address;      //地址
    private $lon;       //	经度
    private $lat;       //维度
    private $intro;        //介绍
    private $seq = 99;        //排序       值越大越靠前
    private $status = 1;        //状态        0：失效 1：生效

}