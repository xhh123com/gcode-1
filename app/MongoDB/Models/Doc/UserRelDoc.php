<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class UserRelDoc
{
    private $collection_name = "user_rel";       //mongodb的collection名称

    private $level = "0";          //关系强度0:促活(拉取老用户)1:拉新(拉去新用户)
    private $a_user_id;          //	邀请用户id
    private $b_user_id;          //被邀请用户id
    private $remark;          //关系备注
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}