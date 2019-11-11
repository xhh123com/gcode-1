<?php
/**
 * Created by PhpStorm.
 * User: HappyQi
 * Date: 2017/12/4
 * Time: 9:23
 */

namespace App\Components\Redis;

use App\Components\Common\Utils;
use App\Components\EasemobManager;
use App\Components\Project;
use Geohash\GeoHash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

/*
 * 要通过RedisManager进行Redis的操作，以便统一封装一些信息和动作
 *
 * By TerryQi
 *
 */

class RedisManager
{

    /*
     * 获取缓存
     *
     * By TerryQi
     *
     * 返回对象
     *
     */
    public static function get($key)
    {
        $value = Redis::get(Project::APP_EN_NAME . ":" . $key);
        $value = unserialize($value);
//        Utils::processLog(__METHOD__, "", "获取缓存 key:" . $key . " value:" . json_encode($value));
        //redis取值如果取不到返回值为false
        if ($value == false) {
            return null;
        }
        return $value;
    }

    /*
     * 设置缓存
     *
     * By TerryQi
     *
     * @param
     *  key：redis的键值
     *  value：redis的值
     *  lifetime：有效期
     * return boolean
     *
     */
    public static function setex($key, $value, $lifetime = 60 * 60 * 12)
    {
        $result = Redis::setex(Project::APP_EN_NAME . ":" . $key, $lifetime, serialize($value));
//        Utils::processLog(__METHOD__, "", "设置缓存 key:" . $key . " value:" . json_encode($value));
        return $result;
    }


    /*
     * 删除缓存
     *
     * By TerryQI
     *
     * @param key
     * @return boolean true/false
     */
    public static function del($key)
    {
        $result = Redis::del(Project::APP_EN_NAME . ":" . $key);
//        Utils::processLog(__METHOD__, "", "删除缓存 key:" . $key . " result:" . json_encode($result));
        return $result;
    }


    /*
     * 有序稽核操作
     *
     * By TerryQi
     *
     */
    public static function zincrby($key, $increment, $member)
    {
        $result = Redis::zincrby(Project::APP_EN_NAME . ":" . $key, $increment, $member);
        Utils::processLog(__METHOD__, "", "设置 key:" . $key . " result:" . json_encode($result));
        return $result;
    }


    /*
     * 正序返回元素
     *
     * By TerryQi
     *
     * 2019-10-09
     */
    public static function zrange($key, $start, $stop)
    {
        $result = Redis::zrange(Project::APP_EN_NAME . ":" . $key, $start, $stop, 'withscores');
//        Utils::processLog(__METHOD__, "", "设置 key:" . $key . " result:" . json_encode($result));
        return $result;
    }


    /*
     * 倒序返回元素
     *
     * By TerryQi
     *
     * 2019-10-09
     */
    public static function zrevrange($key, $start, $stop)
    {
        $result = Redis::zrevrange(Project::APP_EN_NAME . ":" . $key, $start, $stop, 'withscores');
//        Utils::processLog(__METHOD__, "", "设置 key:" . $key . " result:" . json_encode($result));
        return $result;
    }


    /*
     * 合并有序数组
     *
     * By TerryQi
     *
     * 2019-10-09
     */
    public static function zunionstore($destination, $keys_arr)
    {
        $result = Redis::zunionstore(Project::APP_EN_NAME . ":" . $destination, $keys_arr);
//        Utils::processLog(__METHOD__, "", "设置 key:" . $key . " result:" . json_encode($result));
        return $result;
    }

    /*
     * 获取集合中某个用户的分数
     *
     * By TerryQi
     *
     */
    public static function zscore($key, $member)
    {
        $result = Redis::zscore(Project::APP_EN_NAME . ":" . $key, $member);
//        Utils::processLog(__METHOD__, "", "设置 key:" . $key . " result:" . json_encode($result));
        return $result;
    }


}