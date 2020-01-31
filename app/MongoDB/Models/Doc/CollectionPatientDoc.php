<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class CollectionPatientDoc
{
    private $collection_name = "collection_patient";       //mongodb的collection名称

    private $patient_id;          //患者id
    private $doctor_id;          //医生id
    private $type = '0';       //类型;0:视频；1：图片;2:患教资料;3:动态信息
    private $video;         //收藏的视频，当type==0时有效
    private $img;         //收藏的图片，当type==1时有效
    private $patient_tw_id;         //患教资料id，当type==2时有效
    private $circle_text;         //动态文本
    private $circle_imgs;       //动态图片，多张图片用，号分割
    private $remark;    //备注
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效
    

}