<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class CardDoc
{
    private $collection_name = "card";       //mongodb的collection名称

    private $name;          //名称
    private $img;       //图片
    private $rarity;      //稀有度 0:首次领取,1:比较常见卡,2:稍微稀有卡,3:超级稀有卡
    private $intro;      //卡片描述
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}