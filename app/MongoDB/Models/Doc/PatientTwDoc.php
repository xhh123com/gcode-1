<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class PatientTwDoc
{
    private $collection_name = "patient_tw";       //mongodb的collection名称

    private $doctor_id;          //医生id
    private $title;       //患教文章名称
    private $img;         //图片，封皮
    private $intro;    //简介
    private $content_html;    //内容
    private $create_date;    //发布日期
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效


}