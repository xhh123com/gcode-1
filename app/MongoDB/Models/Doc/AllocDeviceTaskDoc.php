<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class AllocDeviceTaskDoc
{
    private $collection_name = "alloc_device_task";       //mongodb的collection名称

    private $file_name;    //导入文件
    private $result_file_name;          //	导入结果文件
    private $admin_id;       //导入管理员
    private $partner_user_id;       //合作人员id
    private $total_count = 0;       //总数
    private $success_count = 0;       //导入成功数
    private $remark;          //	导入备注
    private $task_status = '0';       //	任务状态
    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}