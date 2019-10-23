<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class PartnerCompanyDeviceDoc
{
    private $collection_name = "partner_company_device";       //mongodb的collection名称

    private $partner_id;    //合作方id
    private $partner_user_id;          //合作公司用户id
    private $partner_company_id;       //公司id
    private $device_id;      //设备id
    private $valid_start_at;       //开始时间
    private $valid_end_at;       //结束时间
    private $valid_status = 1;       //状态
    private $seq = 99;       //排序       值越大越靠前
    private $status = 1;        //状态        0：失效 1：生效

}