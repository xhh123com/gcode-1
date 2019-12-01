<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class VertifyCodeDoc
{
    private $collection_name = "vertify_code";       //mongodb的collection名称

    private $phonenum;    //手机号
    private $code;    //短信码
    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}