<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class CityDoc
{
    private $collection_name = "city";       //mongodb的collection名称

    private $admin_id;          //管理员id
    private $province_id;          //省份id
    private $name;       //城市名称
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}