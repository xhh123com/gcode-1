<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class HospitalDepartmentDoc
{
    private $collection_name = "hospital_department";       //mongodb的collection名称

    private $hospital_id;          //医院id
    private $name;       //科室名称
    private $seq = 99;       //排序       值越大越靠前
    private $status = '0';        //状态        0：失效 1：生效


}