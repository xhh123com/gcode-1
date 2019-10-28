<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class IndicatorDoc
{
    private $collection_name = "indicator_alert_rule";       //mongodb的collection名称

    private $life_system_id;    //生命系统id
    private $life_system_level1_type_id;          //	生命系统一级分类id
    private $name;       //	名称
    private $code;      //	编码（英文编码，区分大小写，空格英文下划线替代）
    private $intro;      //	简介(指标解释)
    private $seq = 99;        //排序       值越大越靠前
    private $status = 1;        //状态        0：失效 1：生效

}