<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class DoctorPatientRelEasemobDoc
{
    private $collection_name = "doctor_patient_rel_easemob";       //mongodb的collection名称

    private $owner_username;          //我的id
    private $friend_username;          //好友id
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}