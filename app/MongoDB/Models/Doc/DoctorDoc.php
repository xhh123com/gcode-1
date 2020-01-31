<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class DoctorDoc
{
    private $collection_name = "doctor";       //mongodb的collection名称

    private $easmob_uuid;          //环信用户id
    private $name;          //医生姓名
    private $avatar;       //医生头像
    private $hospital_id;      //执业医院
    private $department_id;      //所在科室
    private $position_name;       //职称
    private $id_card_no;          //执业医师证编码
    private $phonenum;          //联系电话
    private $role = '0';          //等级 0:普通医生；1：科室主任;2:院长
    private $is_chat = '0';          //是否开通患者沟通功能（即时通讯） 0：否 1：是
    private $is_adopt = '0';          //审核是否通过 0：否 1：是
    private $admin_id;          //审核人员id
    private $date;          //注册日期
    private $seq = 99;       //排序       值越大越靠前
    private $status = '0';        //状态        0：失效 1：生效

}