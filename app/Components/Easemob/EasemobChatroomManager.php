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
use App\Models\Ad;
use Illuminate\Support\Facades\Redis;

// IM管理-用户体系集成

class EasemobChatroomManager
{

    /*
     * 创建聊天室
     *
     * By TerryQi
     *
     * 2019-08-15
     */
    public static function create($name, $decription, $maxusers = 5000, $owner)
    {
        $param = [
            "name" => $name,
            "description" => $decription,
            "maxusers" => $maxusers,
            "owner" => strval($owner)
        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/chatrooms", $param, $header, "POST", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 获取聊天室详情
     *
     * By TerryQi
     *
     */
    public static function get($chatroom_id)
    {
        $param = [

        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/chatrooms/" . $chatroom_id, $param, $header, "GET", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 获取聊天室
     *
     * By TerryQi
     *
     */
    public static function getList()
    {
        $param = [

        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/chatrooms", $param, $header, "GET", 0);
        return EasemobTool::resultFormate($result);
    }


    /*
     * 获取用户加入的聊天室
     *
     * By TerryQi
     *
     * 2019-08-15
     */
    public static function joinedChartrooms($username)
    {
        $param = [

        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users/" . $username . "/joined_chatrooms", $param, $header, "GET", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 修改聊天室
     *
     * By TerryQi
     *
     */
    public static function edit($chatroom_id, $name, $description, $maxusers)
    {
        $param = [
            "name" => $name,
            "description" => $description,
            "maxusers" => $maxusers
        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/chatrooms/" . $chatroom_id, $param, $header, "PUT", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 删除聊天室
     *
     * By TerryQi
     *
     */
    public static function delete($chatroom_id)
    {
        $param = [

        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/chatrooms/" . $chatroom_id, $param, $header, "DELETE", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 获取聊天室成员
     *
     * By TerryQi
     *
     * 2019-08-15
     */
    public static function getUsers($chatroom_id, $pagenum = 1, $pagesize = Utils::PAGE_SIZE)
    {
        $param = [

        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/chatrooms/" . $chatroom_id . "/users" . "?pagenum=" . $pagenum . "&pagesize=" . $pagesize, $param, $header, "GET", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 添加聊天室成员
     *
     * By TerryQi
     *
     * 2019-08-15
     */
    public static function addUser($chatroom_id, $username)
    {
        $param = [

        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/chatrooms/" . $chatroom_id . "/users/" . $username, $param, $header, "POST", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 批量添加聊天室成员
     *
     * By TerryQi
     *
     * 2019-08-15
     *
     * @param
     *
     * chatroom_id：聊天室id
     * usernames：用户数组
     */
    public static function addUsers($chatroom_id, $usernames)
    {
        $param = [
            "usernames" => $usernames
        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/chatrooms/" . $chatroom_id . "/users", $param, $header, "POST", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 删除单个聊天室成员
     *
     * By TerryQi
     *
     */
    public static function deleteUser($chatroom_id, $username)
    {
        $param = [

        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/chatrooms/" . $chatroom_id . "/users/" . $username, $param, $header, "DELETE", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 批量删除聊天室成员
     *
     * By TerryQi
     *
     * 2019-08-15
     *
     * @param
     *
     * chatroom_id：聊天室id
     * usernames：用户数组
     */
    public static function deleteUsers($chatroom_id, $usernames)
    {
        $param = [
        ];
        $usernames_url_str = implode('&', $usernames);
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/chatrooms/" . $chatroom_id . "/users/" . $usernames_url_str, $param, $header, "DELETE", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 获取聊天室管理员列表
     *
     * By TerryQi
     *
     * 2019-08-15
     */
    public static function getAdmins($chatroom_id)
    {
        $param = [

        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/chatrooms/" . $chatroom_id . "/admin", $param, $header, "GET", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 添加聊天室管理会员
     *
     * By TerryQi
     *
     * 2019-08-15
     *
     */
    public static function addAdmin($chatroom_id, $username)
    {
        $param = [
            "newadmin" => $username
        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/chatrooms/" . $chatroom_id . "/admin", $param, $header, "POST", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
    * 删除聊天室管理会员
    *
    * By TerryQi
    *
    * 2019-08-15
    *
    */
    public static function deleteAdmin($chatroom_id, $username)
    {
        $param = [
            "newadmin" => $username
        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/chatrooms/" . $chatroom_id . "/admin/" . $username, $param, $header, "DELETE", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 获取禁言列表
     *
     * By TerryQi
     *
     * 2019-08-15
     */
    public static function getMutes($chatroom_id)
    {
        $param = [

        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/chatrooms/" . $chatroom_id . "/mute", $param, $header, "GET", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 设置禁言
     *
     * By TerryQi
     *
     */
    public static function addMute($chatroom_id, $usernames, $mute_duration = -1000)
    {
        $param = [
            "mute_duration" => $mute_duration,
            "usernames" => $usernames
        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/chatrooms/" . $chatroom_id . "/mute", $param, $header, "POST", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 移除禁言
     *
     * By TerryQi
     *
     */
    public static function removeMute($chatroom_id, $username)
    {
        $param = [

        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/chatrooms/" . $chatroom_id . "/mute/" . $username, $param, $header, "DELETE", 0);
        return EasemobTool::resultFormate($result);
    }


}