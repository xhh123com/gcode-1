<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class ExamOrderPostureResultDoc
{
    private $collection_name = "exam_order_posture_result";       //mongodb的collection名称

    private $exam_order_id;          //	检测订单号
    private $task_id;           //检测任务id
    private $front_exam_img;       //	正面照片
    private $right_exam_img;      //	右侧照片
    private $result_json;      //	体态检测的json结果
    private $remark;      //	备注
    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}