<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class PatientPlanDoc
{
    private $collection_name = "patient_plan";       //mongodb的collection名称

    private $patient_id;          //患者id
    private $doctor_id;          //医生id
    private $patient_plan_type = '0';         //随访类型 0:药物注射随访 1:常规随访
    private $injection_type = '0';    //注射方案 0:复合剂量注射 1:维持剂量注射
    private $patient_plan_time;    //随访日期
    private $injection_plan_time;    //注射日期
    private $patient_injection_plan_time = '0';    //计划注射时间 例:15:30
    private $content;    //提醒内容
    private $injection_status = '0';    //注射状态0:待确定 1:未注射 2:已注射
    private $actual_injection_time;    //实际注射随访时间
    private $cumulative_injection_nums;    //累计注射次数
    private $cumulative_injection_reel_nums;    //本院累计注射次数
    private $arrived_status = '0';    //状态;0:未到访；1：已到访
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}