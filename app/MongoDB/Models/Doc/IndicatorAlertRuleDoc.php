<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class IndicatorAlertRuleDoc
{
    private $collection_name = "indicator_alert_rule";       //mongodb的collection名称

    private $indicator_id;    //指标id
    private $min_value;          //	预警范围 min value
    private $min_value_opt = '0'; //边界操作符，如果0代表不带等于，如果1代表带等于
    private $max_value;          //	预警范围 max value
    private $max_value_opt = '0';     //边界操作符，如果0代表不带等于，如果1代表带等于
    private $level = '0';       //	0正常 1代表一般问题 2严重问题
    private $meaning;      //已经含义
    private $intro;      //	简介
    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}