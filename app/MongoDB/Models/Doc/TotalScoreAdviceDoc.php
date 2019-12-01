<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class TotalScoreAdviceDoc
{
    private $collection_name = "total_score_advice";       //mongodb的collection名称

    private $min_score;          //得分范围最小值 x>=min_score
    private $max_score;       //得分范围最大值 x<max_score
    private $content;      //指导意见内容
    private $content_html;      //指导意见内容(预留)
    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}