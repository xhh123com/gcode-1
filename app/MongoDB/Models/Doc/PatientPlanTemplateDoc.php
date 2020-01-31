<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class PatientPlanTemplateDoc
{
    private $collection_name = "patient_plan_template";       //mongodb的collection名称

    private $name;          //模板名称
    private $type = '0';          //模板类型是否是系统默认的;0:否；1：是
    private $doctor_id;       //医生id
    private $admin_id;         //管理员id
    private $seq = 99;       //排序       值越大越靠前
    private $status = '0';        //状态        0：失效 1：生效

}