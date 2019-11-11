<?php


/**
 * Created by PhpStorm.
 * User: mtt17
 * Date: 2018/4/9
 * Time: 11:32
 */

namespace App\Components\Easemob;


use App\Components\Common\Utils;

// 实时音视频-会议管理

class EasemobConferenceManager
{

    /*
     * 创建会议
     *
     * By TerryQi
     *
     * @param
     * username：一般为用户id
     * nickname：为昵称
     *
     */
    public static function create($confrType = 10, $password = null, $confrDelayMillis = 3600
        , $memDefaultRole = 1, $allowAudienceTalk = true, $creator = null, $rec = true, $recMerge = true)
    {
        //获取creator
        if (Utils::isObjNull($creator)) {
            $creator = "banni_" . Utils::generateTradeNo();
        }
        $param = [
            "allowAudienceTalk" => $allowAudienceTalk,
            "confrDelayMillis" => $confrDelayMillis,
            "confrType" => $confrType,
            "creator" => $creator,
            "memDefaultRole" => $memDefaultRole,
            "password" => $password,
        ];

        Utils::processLog(__METHOD__, "", "创建会议 param:" . json_encode($param));
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/conferences", $param, $header, "POST", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 解散会议
     *
     * By TerryQi
     *
     */
    public static function delete($confrId)
    {
        $param = [];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/conferences/" . $confrId, $param, $header, "DELETE", 0);
        return EasemobTool::resultFormate($result);
    }


    /*
     * 获取会议
     *
     * By TerryQo
     *
     */
    public static function get($confrId)
    {
        $param = [];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/conferences/" . $confrId, $param, $header, "GET", 0);
        return EasemobTool::resultFormate($result);
    }


    /*
     * 删除会议用户
     *
     * By TerryQi
     *
     * 2019-08-06
     */
    public static function deleteUser($confrId, $username)
    {
        $param = [];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/conferences/" . $confrId . "/" . $username, $param, $header, "DELETE", 0);
        return EasemobTool::resultFormate($result);
    }

}

