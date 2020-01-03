<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class GameLogDoc
{
    private $collection_name = "game_log";       //mongodb的collection名称

    private $user_id;          //用户id
    private $play_level = 0;       //关卡数
    private $score = 0;      //得分
    private $is_share = "0";      //是否分享:0没有分享,分享后能继续玩,1分享过一次失败后不能继续玩
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}