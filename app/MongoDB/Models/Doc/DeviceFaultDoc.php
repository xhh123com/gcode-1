<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class DeviceFaultDoc
{
    private $collection_name = "device_fault";       //mongodb的collection名称

    private $device_id;    //设备id
    private $partner_id;          //合作方id
    private $partner_company_id;          //合作方公司id
    private $partner_company_store_id;       //	合作方公司网点id
    private $report_partner_user_id;      //上报人员id
    private $device_fault_category_id;      //故障类型id
    private $img;      //故障图片，多张图片用，逗号分隔
    private $cotent;      //故障描述
    private $handle_status = '0';      //处理状态 0：未处理 1：已处理
    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}