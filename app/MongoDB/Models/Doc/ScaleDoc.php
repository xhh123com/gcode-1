<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class ScaleDoc
{
    private $collection_name = "scale";       //mongodb的collection名称

    private $admin_id;       //管理员id
    private $name;      //量表类型名称
    private $sign_name;      //量表唯一标识名
    private $intro;      //量表类型描述
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}