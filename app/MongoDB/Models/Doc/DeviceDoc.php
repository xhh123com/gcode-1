<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class DeviceDoc
{
    private $collection_name = "device";       //mongodb的collection名称

    private $name;    //设备名
    private $batch_no;          //	批次号
    private $produce_date;          //	生产时间
    private $jpush_id;       //	极光推送唯一id
    private $serial_no;      //	设备序列号
    private $code;      //设备贴签的条码数值（一般为资产编码）
    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}