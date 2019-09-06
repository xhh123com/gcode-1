<?php


/**
 * Created by PhpStorm.
 * User: mtt17
 * Date: 2018/4/9
 * Time: 11:32
 */

namespace App\Components;


use App\Components\Common\Utils;
use App\Components\Redis\RedisManager;
use App\Events\RegisterEasemobUserEvent;
use App\Models\User;
use App\Models\UserLogin;
use Illuminate\Support\Facades\Event;

class UserManager
{

    /*
     * 用于配合生成测试用户
     *
     * By TerryQi
     *
     * 2019-09-06
     */
    public static function setUserLoginTelCode($user, $phonenum, $code)
    {
        $user_login = new UserLogin();
        $user_login->user_id = $user->id;
        $user_login->account_type = Utils::ACCOUNT_TYPE_TEL_PASSWORD;
        $user_login->ve_value1 = $phonenum;
        $user_login->ve_value2 = md5($phonenum . $code);
        $user_login->token = Utils::getGUID();
        UserLoginManager::save($user_login);
        return $user_login;
    }


}

