<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class PatientDoc
{
    private $collection_name = "patient";       //mongodb的collection名称

    private $easmob_uuid;          //环信用户id
    private $name;          //患者姓名
    private $gender = '0';       //患者性别 0：女 1：男
    private $avatar;       //患者头像
    private $id_card_no;      //患者身份证号码
    private $native_place_city_id;      //籍贯
    private $nationality_id;       //民族
    private $birthday;          //出生日期
    private $city;          //所在城市
    private $birth_mode;          //出生方式 0:顺产 1:剖腹产
    private $birth_weight;          //出生体重 单位:KG
    private $birth_height;          //出生身高(身长) 单位:CM
    private $guardian_name;          //监护人姓名
    private $guardian_relationship;          //患者和监护人关系
    private $guardian_id_card_no;          //监护人身份证号
    private $guardian_phonenum;          //监护人联系电话
    private $date;          //注册日期
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}