<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class PatientPlanTemplateItemDoc
{
    private $collection_name = "patient_plan_template_item";       //mongodb的collection名称

    private $doctor_id;          //医生id
    private $template_id;       //模板id
    private $plan_type = '0';         //随访类型 0:药物注射随访 1:常规随访
    private $injection_type = '0';    //注射方案 0:复合剂量注射 1:维持剂量注射
    private $time_value;    //相隔时间数值
    private $time_type = '0';    //相隔时间类型0:天 1:月 2:年
    private $patient_injection_plan_time = '0';    //计划注射时间 例:15:30
    private $content;    //提醒内容
    private $time;    //创建模板时间
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}