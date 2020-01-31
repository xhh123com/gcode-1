<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class ScaleTopicDoc
{
    private $collection_name = "scale_topic";       //mongodb的collection名称

    private $admin_id;       //管理员id
    private $scale_id;      //量表类型id
    private $topic_no;      //题号
    private $name;       //题目
    private $intro;       //描述
    private $body_parts;       //身体部位
    private $position = 0;       //方位 0是全部 1是左面 2是右面
    private $type = 1;       //题目类型：0：计分题(单选) 1：填空题
    private $is_test = 1;       //是否是测试题：0：不是 1：是
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}