<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class DeviceFaultCategoryDoc
{
    private $collection_name = "device_fault_category";       //mongodb的collection名称

    private $name;    //故障类型
    private $intro;          //	故障描述
    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}