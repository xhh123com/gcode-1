<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class ExamOrderDoc
{
    private $collection_name = "exam_order";       //mongodb的collection名称

    private $trade_no;          //	订单号
    private $user_id;       //	用户id
    private $partner_id;      //	检测时合作方id
    private $partner_company_id;      //	检测时合作方公司id
    private $partner_company_store_id;      //	检测时合作公司投放点id
    private $partner_company_activity_id;      //	检测时活动id
    private $device_id;      //	检测时设备id
    private $gender = '0';    //用户性别 0：保密 1：男性 2：女性
    private $age = '0';      //	检测时间点的年龄
    private $height = '0';      //	检测时间的身高
    private $weight = '0';      //	检测时间的体重
    private $front_exam_img;      //	正面照片
    private $right_exam_img;      //	右侧照片
    private $remark;      //	备注
    private $posture_exam_status = '0';     //体态检测状态 0：未开始 1：进行中 2：已完成
    private $indicator_exam_status = '0';       //指标检测状态 0：未开始 1：进行中 2：已完成
    private $order_status = '1';      //检测订单状态 	0:未开始, 1:进行中, 2:已完成 3：已过期
    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}