<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class DeviceRechargeFaultDoc
{
    private $collection_name = "device_recharge_fault";       //mongodb的collection名称

    private $partner_id;          //	合作方id
    private $partner_company_id;          //	合作放分组id
    private $device_id;       //	设备id
    private $partner_user_id;      //	充值人id
    private $admin_id;      //	充值人id
    private $expired_at;      //	有效期
    private $valid_num;      //	剩余次数
    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}