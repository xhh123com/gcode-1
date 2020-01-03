<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class UserWeekRankingDoc
{
    private $collection_name = "user_week_ranking";       //mongodb的collection名称

    private $user_id;    //用户id
    private $score;    //当周的最高得分数
    private $year;    //年度数，例如2020年
    private $week;    //周数，例如1代表第一周，2代表第二周
    private $start_date;    //周的开始时间，例如2019年第32周的开始时间为2019-6-5
    private $end_date;    //周的结束时间，同理
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}