<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class LifeSystemDoc
{
    private $collection_name = "life_system";       //mongodb的collection名称

    private $name;          //	名称
    private $intro;       //	简介
    private $type;      //	生命系统的类型，100：代表呼吸系统 200：循环系统 300：运动系统 400：营养系统 500：神经系统
    private $seq = 99;        //排序       值越大越靠前
    private $status = 1;        //状态        0：失效 1：生效

}