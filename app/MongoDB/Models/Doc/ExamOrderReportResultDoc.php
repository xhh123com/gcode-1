<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class ExamOrderReportResultDoc
{
    private $collection_name = "exam_order_report_result";       //mongodb的collection名称

    private $exam_order_id;          //	订单id
    private $user_id;       //	用户id
    private $partner_id;      //	检测时合作方id
    private $partner_company_id;      //	检测时合作方公司id
    private $partner_company_store_id;      //	检测时合作公司投放点id
    private $partner_company_activity_id;      //	检测时活动id
    private $life_system_type;      // 	指标类型
    private $device_id;      //	检测时设备id
    private $json_value;      // json的value值
    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}