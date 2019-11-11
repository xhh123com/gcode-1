<?php
/**
 * Created by PhpStorm.
 * User: HappyQi
 * Date: 2017/12/4
 * Time: 9:23
 */

namespace App\Components\Agora;

class AgoraTool
{

    /*
    * 获取token
    *
    * $channel_name
    * $uid
    * $role
    *
    * 2019-08-15 12:07:44
    */
    public static function getToken($channel_name, $user_account, $role)
    {
        $token = RtcTokenBuilder::buildTokenWithUserAccount(env('Agroa_App_ID'), env('Agroa_App_Certificate'), $channel_name, $user_account, $role, 0);
        //echo 'Token with int uid: ' . $token . PHP_EOL;

        return $token;
    }


}