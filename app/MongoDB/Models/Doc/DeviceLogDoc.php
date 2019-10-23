<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class DeviceLogDoc
{
    private $collection_name = "device_log";       //mongodb的collection名称

    private $device_id;    //设备id
    private $lat;          //	维度
    private $lon;       //	经度
    private $remark;      //备注
    private $seq = 99;        //排序       值越大越靠前
    private $status = 1;        //状态        0：失效 1：生效

}