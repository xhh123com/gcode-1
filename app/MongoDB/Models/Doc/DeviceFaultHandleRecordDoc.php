<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class DeviceFaultHandleRecordDoc
{
    private $collection_name = "device_fault_handle_record";       //mongodb的collection名称

    private $device_fault_id;    //设备故障id
    private $admin_id;          //管理员id
    private $img;          //故障图片，多张图片用，逗号分隔
    private $cotent;       //	故障描述
    private $result_status = 0;      //处理状态 0：未完成（故障经过处理未恢复） 1：已完成（故障经过处理已经恢复）
    private $seq = 99;        //排序       值越大越靠前
    private $status = 1;        //状态        0：失效 1：生效

}