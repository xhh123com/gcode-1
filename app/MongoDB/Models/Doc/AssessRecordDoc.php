<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class AssessRecordDoc
{
    private $collection_name = "assess_record";       //mongodb的collection名称

    private $is_share = '0';       //是否共享0:不共享1:共享
    private $scale_id;       //量表id
    private $patient_id;      //患者id
    private $doctor_id;      //医生id
    private $hospital_id;      //医院id
    private $assess_at;       //评估时间
    private $intro;       //备注
    private $test_scale_json;       //量表题目和答案(json数据集合测试题)
    private $no_test_scale_json;       //量表题目和答案(json数据集合非测试题)
    private $more_scale_json;       //负责存储多余的题目无样式
    private $video_annex;       //视频附件
    private $other_annex;       //其它附件
    private $total_score = 0;       //总分
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}