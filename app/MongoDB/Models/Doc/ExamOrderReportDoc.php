<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class ExamOrderReportDoc
{
    private $collection_name = "exam_order_report";       //mongodb的collection名称

    private $exam_order_id;          //	订单id
    private $respiratory_system_report;        //呼吸系统报告，其中仍旧继续是一个数组
    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}