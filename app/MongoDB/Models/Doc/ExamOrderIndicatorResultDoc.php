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
    private $average_SpO2;    //平均血氧含量
    private $maximum_SpO2;    //最高血氧含量
    private $minimum_SpO2;    //最低血氧含量
    private $PR;    //脉率PR（包含平均、最低、最高）
    private $PI;    //血流灌注指数PI
    private $respiratory_rate;    //呼吸速率
    private $average_heart_rate;    //平均心率
    private $maximum_heart_rate;    //最高心率
    private $minimum_heart_rate;    //最低心率
    private $total_heart_beat;    //总心搏
    private $RR_interval_;    //RR间期>2.0s
    private $the_largest_RR_interval;    //最长RR间期
    private $tachycardia;    //心动过速
    private $bradycardia;    //心动过缓
    private $arrhythmia;    //心律不齐
    private $escape_pulsation;    //逸博
    private $stop_pulsation;    //停搏
    private $PAC;    //房早
    private $atrial_fibrillation;    //房颤
    private $PVC;    //室早
    private $bigeminy;    //二联律
    private $trigeminy;    //三联律
    private $SVT;    //室上速
    private $VT;    //室速
    private $AF;    //房扑
    private $head_tilt;    //头部侧倾
    private $head_forward;    //头部前倾
    private $high_and_low_shoulder;    //高低肩
    private $round_shoulder;    //圆肩
    private $spine_ectopic;    //脊柱异位
    private $hip_dips;    //骨盆侧倾
    private $knee_extension;    //膝过伸
    private $XO_type_leg;    //XO型腿
    private $O_type_leg;    //O型腿
    private $X_type_leg;    //X型腿
    private $weight;    //体重
    private $fat_rate;    //脂肪率
    private $fat_mass;    //脂肪量
    private $muscle_rate;    //肌肉率
    private $muscle_mass;    //肌肉量
    private $subcutaneous_fat_rate;    //皮下脂肪率
    private $subcutaneous_fat_mass;    //皮下脂肪量
    private $pbw;    //水分率
    private $protein_rate;    //蛋白质率
    private $basic_metabolism;    //基础代谢
    private $bone_mass;    //骨量
    private $BMI;    //BMI
    private $fat_loss;    //去脂体重
    private $eighteen_sports_consumption;    //18项运动消耗
    private $body_type;    //身体类型
    private $body_score;    //身体得分
    private $body_age;    //体年龄
    private $visceral_fat_grade;    //内脏脂肪等级
    private $ideal_weight;    //理想体重
    private $body_FR;    //躯干体脂率
    private $body_FM;    //躯干体脂量
    private $left_hand_FR;    //左手体脂率
    private $left_hand_FM;    //左手体脂量
    private $right_hand_FR;    //右手体脂率
    private $right_hand_FM;    //右手体脂量
    private $left_foot_FR;    //左脚体脂率
    private $left_foot_FM;    //左脚体脂量
    private $right_foot_FR;    //右脚体脂率
    private $right_foot_FM;    //右脚体脂量
    private $body_MR;    //躯干肌肉率
    private $body_MM;    //躯干肌肉量
    private $left_hand_MR;    //左手肌肉率
    private $left_hand_MM;    //左手肌肉量
    private $right_hand_MR;    //右手肌肉率
    private $right_hand_MM;    //右手肌肉量
    private $left_foot_MR;    //左脚肌肉率
    private $left_foot_MM;    //左脚肌肉量
    private $right_foot_RM;    //右脚肌肉率
    private $right_foot_MM;    //右脚肌肉量
    private $heart_rate_heathy;    //心率健康度
    private $relaxation;    //放松度
    private $metal_age;    //心脏年龄
    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}