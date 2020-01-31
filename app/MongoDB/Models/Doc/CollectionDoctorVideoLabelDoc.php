<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class CollectionDoctorVideoLabelDoc
{
    private $collection_name = "collection_doctor_video_label";       //mongodb的collection名称

    private $doctor_id;          //医生id
    private $name;        //分类名称
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}