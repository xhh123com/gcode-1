<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class FieldTemplateDoc
{
    private $collection_name = "field_template";       //mongodb的collection名称

    private $doctor_id;          //医生id
    private $field_ids;          //字段id (用诊疗数据字段的id中间用逗号拼接,比如1,2,3,)
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}