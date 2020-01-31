<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class CollectionDoctorVideoDoc
{
    private $collection_name = "collection_doctor_video";       //mongodb的collection名称

    private $patient_id;          //患者id
    private $doctor_id;          //医生id
    private $collection_doctor_video_label_id = '0';        //默认0是全部
    private $video;       //医生主动收藏的视频
    private $type = '0';        //收藏类型 0：视频
    private $collect_at;         //收藏时间
    private $remark;    //备注
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}