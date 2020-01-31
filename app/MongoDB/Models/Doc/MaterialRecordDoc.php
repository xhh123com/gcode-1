<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class MaterialRecordDoc
{
    private $collection_name = "material_record";       //mongodb的collection名称

    private $f_table;          //父表名称，即doctor或者patient
    private $f_id;          //医生id/患者id
    private $material_type;     //素材类型 0：视频 1：图片
    private $material_url;       //素材链接
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}