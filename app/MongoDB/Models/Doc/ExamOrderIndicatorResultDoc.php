<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class ExamOrderIndicatorResultDoc
{
    private $collection_name = "exam_order_indicator_result";       //mongodb的collection名称
    private $exam_order_id;          //	订单id
    //呼吸系统
    private $SpO2_arr;      //血氧
    private $PR_arr;        //脉率
    private $PI;        //血流灌注指数
    //循环系统
    private $heart_rate_arr;  //心速

    //肌肉系统
    private $muscle_mass;        //	肌肉量
    private $muscle_rate;        //	肌肉率
    private $right_foot_MM;        //	右脚肌肉量
    private $right_foot_MR;        //	右脚肌肉率
    private $left_foot_MM;        //	左脚肌肉量
    private $left_foot_MR;        //	左脚肌肉率
    private $right_hand_MM;        //	右手肌肉量
    private $right_hand_MR;        //	右手肌肉率
    private $left_hand_MM;        //	左手肌肉量
    private $left_hand_MR;        //	左手肌肉率
    private $body_MM;        //	躯干肌肉量
    private $body_MR;        //	躯干肌肉率


    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}