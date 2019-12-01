<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class PadVersionDoc
{
    private $collection_name = "pad_version";       //mongodb的collection名称

    private $name;          //版本名
    private $code;       //版本号
    private $url;      //下载地址
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}