<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class NationalityDoc
{
    private $collection_name = "nationality";       //mongodb的collection名称

    private $id;          //id
    private $admin_id;          //管理员id
    private $name;       //民族名称
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}