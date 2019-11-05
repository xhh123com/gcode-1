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
    private $partner_contract_id;       //合同id
    private $device_id;      //设备id
    private $total_num = 0;   //设备总使用次数
    private $valid_num = 0;       //设备可用次数
    private $unit_price = 0.01;      //使用单价
    private $expired_at;        //到期日期
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}