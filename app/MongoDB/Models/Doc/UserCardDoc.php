<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class UserCardDoc
{
    private $collection_name = "user_card";       //mongodb的collection名称

    private $game_log_id;          //游戏记录id
    private $user_id;       //用户id
    private $card_id;      //卡片id
    private $is_first='0';      //是否首次获取
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}