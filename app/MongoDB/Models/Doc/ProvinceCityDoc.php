<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class ProvinceCityDoc
{
    private $collection_name = "province_city";       //mongodb的collection名称

    private $id;          //id
    private $name;       //省份名称
    private $parentId;       //父级id
    private $cityCode;       //code
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效
}