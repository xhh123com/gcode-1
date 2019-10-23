<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class PartnerContractDoc
{
    private $collection_name = "partner_contract";       //mongodb的collection名称

    private $partner_id;    //合作方id
    private $name;          //合同名
    private $valid_start_at;       //开始时间
    private $valid_end_at;      //结束时间
    private $valid_status = 1;       //状态
    private $attach;       //合同附件
    private $seq = 99;       //排序       值越大越靠前
    private $status = 1;        //状态        0：失效 1：生效

}