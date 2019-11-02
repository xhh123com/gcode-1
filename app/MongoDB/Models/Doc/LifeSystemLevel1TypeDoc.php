<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class LifeSystemLevel1TypeDoc
{
    private $collection_name = "life_system_level1_type";       //mongodb的collection名称

    private $life_system_id;    //生命系统id
    private $name;          //	名称
    private $type;          //	类型 ‘101’ => ‘基础指标’, ‘201’ => ‘基础指标’, ‘202’ => ‘进阶指标’, ‘301’ => ‘基础指标’, ‘401’ => ‘基础指标’, ‘402’ => ‘进阶指标’, ‘403’ => ‘评分指标’, ‘404’ => ‘详细体脂状况指标’, ‘405’ => ‘详细肌肉状况指标’, ‘501’ => ‘基础指标’
    private $intro;       //	简介
    private $content_html;      //	内容，指导意见
    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}