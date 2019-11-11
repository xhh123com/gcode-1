<?php


/**
 * Created by PhpStorm.
 * User: mtt17
 * Date: 2018/4/9
 * Time: 11:32
 */

namespace App\Components\Easemob;


use App\Components\Easemob\EasemobTool;
use App\Components\Common\Utils;
use App\Components\Project;
use App\Components\Redis\RedisManager;
use App\Models\Ad;
use Illuminate\Support\Facades\Redis;

class EasemobBaseManager
{
    /*
     * 获取管理员token
     *
     * By TerryQi
     *
     * 2019-08-06
     */
    public static function token()
    {
        $config = EasemobTool::getConfig();
        $param = [
            "grant_type" => 'client_credentials',
            "client_id" => $config['client_id'],
            "client_secret" => $config['client_secret']
        ];
        $header [] = '';
        $result = EasemobTool::curl("/token", $param, $header, "POST", 0);
        Utils::processLog(__METHOD__, '', '获取token result:' . json_encode($result));
        return EasemobTool::resultFormate($result);
    }


    /*
     * 获取管理员token，一定会返回管理员token，在本地通过redis进行token的缓存
     *
     * redis中的token进行了有效期的控制，如果超期则重新获取
     *
     * By TerryQi
     *
     * 2019-8-05
     */
    public static function getToken()
    {
        Utils::processLog(__METHOD__, '', '获取环信access_token，先从redis中获取');
        $access_token = RedisManager::get("easemob:access_token");
        Utils::processLog(__METHOD__, '', 'redis中获取的access_token值为' . $access_token);
        //本地缓存中的easemob:access_token是不是空，如果是空，则需要刷新缓存
        if (Utils::isObjNull($access_token)) {
            Utils::processLog(__METHOD__, '', 'redis环信的access_token为空，需要刷新缓存，并将token存入redis');
            $refresh_result = self::refreshToken();     //刷新操作是否成功
            if ($refresh_result) {      //刷新成功，重新获取
                $access_token = RedisManager::get("easemob:access_token");
            }
        }
        Utils::processLog(__METHOD__, '', "返回的 access_token:" . $access_token);
        return $access_token;
    }


    /*
     * 重新获取token，并将token写入redis，每晚执行计划任务，将token重新刷新至缓存中
     *
     * return true/false，代表刷新成功或者失败
     *
     *
     * By TerryQi
     *
     * 2019-08-05
     */
    public static function refreshToken()
    {
        Utils::processLog(__METHOD__, '', "开始刷新环信access_token");
        $result = self::token();
        Utils::processLog(__METHOD__, '', "重新获取环信access_token的值为:" . json_encode($result));
        if (!array_key_exists('access_token', $result)) {
            return false;   //刷新失败
        }
        $access_token = $result->access_token;        //获取access_token
        Utils::processLog(__METHOD__, '', "环信access_token为" . $access_token);
        //写入redis，其中有效期为12小时
        Utils::processLog(__METHOD__, '', "准备写入redis，变量名为easemob:access_token，有效时间为60*60*12");
        $redis_opt_result = RedisManager::setex('easemob:access_token', $access_token, 60 * 60 * 12);
        Utils::processLog(__METHOD__, '', '写入结果 redis_opt_result:' . $redis_opt_result);
        return true;
    }

}

