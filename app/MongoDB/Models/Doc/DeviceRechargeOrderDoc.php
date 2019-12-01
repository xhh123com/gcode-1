<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class DeviceRechargeOrderDoc
{
    private $collection_name = "device_recharge_order";       //mongodb的collection名称

    private $trade_no;    //订单号
    private $pay_type;          //	支付类型
    private $partner_id;          //	合作方id
    private $partner_company_id;          //	合作放分组id
    private $device_id;       //	设备id
    private $unit_price;      //	设备单价
    private $recharge_num;      //	充值数量
    private $total_amount;      //	购买总价
    private $pay_status = "0";      //	订单状态 0:未支付 1:支付完成
    private $recharge_status = "0";      //	充值状态 0：充值失败 1：充值成功
    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}