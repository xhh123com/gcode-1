<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class HospitalDoc
{
    private $collection_name = "hospital";       //mongodb的collection名称

    private $name;          //医院名称
    private $province;       //省份
    private $city;         //市
    private $address;    //详细地址
    private $seq = 99;       //排序       值越大越靠前
    private $status = '0';        //状态        0：失效 1：生效
}