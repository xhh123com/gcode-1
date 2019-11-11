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

class EasemobUserManager
{

    /*
     * 注册一个用户
     *
     * By TerryQi
     *
     * @param
     * username：一般为用户id
     * nickname：为昵称
     *
     */
    public static function register($username, $nickname, $password)
    {
        $param = [
            "username" => $username,
            "password" => $password,
            "nickname" => $nickname
        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users", $param, $header, "POST", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 获取单个用户
     *
     * By TerryQi
     *
     * @param username
     */
    public static function get($username)
    {
        $param = [];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users/" . $username, $param, $header, "GET", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 获取用户列表
     *
     * By TerryQi
     *
     * 2019-08-15
     *
     * @param limit为每页分页数 cursor为游标
     */
    public static function getList($limit = Utils::PAGE_SIZE, $cursor = null)
    {
        $param = [];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users?limit=" . $limit . "&cursor=" . $cursor, $param, $header, "GET", 0);
        return EasemobTool::resultFormate($result);
    }


    /*
     * 删除用户
     *
     * By TerryQi
     *
     * @param username
     */
    public static function delete($username)
    {
        $param = [];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users/" . $username, $param, $header, "DELETE", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 设置推送消息的昵称
     *
     * By TerryQi
     *
     * 2019-08-06
     */
    public static function setNickName($username, $nickname)
    {
        $param = [
            'nickname' => $nickname
        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users/" . $username, $param, $header, "PUT", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 设置用户密码
     *
     * By TerryQi
     *
     * 2019-08-29
     *
     */
    public static function setPassword($username, $password)
    {
        $param = [
            'newpassword' => $password
        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users/" . $username . "/password", $param, $header, "PUT", 0);
        return EasemobTool::resultFormate($result);
    }


    /*
     * 添加好友
     *
     * By TerryQi
     *
     * @param
     * username：一般为用户id
     * nickname：为昵称
     *
     */
    public static function addContact($owner_username, $friend_username)
    {
        $param = [];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users/" . $owner_username . "/contacts/users/" . $friend_username, $param, $header, "POST", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 删除好友
     *
     * By TerryQi
     *
     * @param username
     */
    public static function removeContact($owner_username, $friend_username)
    {
        $param = [];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users/" . $owner_username . "/contacts/users/" . $friend_username, $param, $header, "DELETE", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 获取好友列表
     *
     * By TerryQi
     *
     * 2019-08-06
     */
    public static function getContacts($owner_username)
    {
        $param = [];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users/" . $owner_username . "/contacts/users", $param, $header, "GET", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 添加黑名单
     *
     * By TerryQi
     *
     */
    public static function addBlock($owner_username, $block_username)
    {
        $param = [$block_username];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users/" . $owner_username . "/blocks/users", $param, $header, "POST", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 移除黑名单
     *
     * By TerryQi
     *
     */
    public static function removeBlock($owner_username, $block_username)
    {
        $param = [$block_username];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users/" . $owner_username . "/blocks/users", $param, $header, "DELETE", 0);
        return EasemobTool::resultFormate($result);
    }


    /*
     * 获取黑名单
     *
     * By TerryQi
     *
     */
    public static function getBlocks($owner_username)
    {
        $param = [];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users/" . $owner_username . "/blocks/users", $param, $header, "GET", 0);
        return EasemobTool::resultFormate($result);
    }


    /*
     * 获取单用户的在线状态
     *
     * By TerryQi
     *
     * 2019-08-15
     */
    public static function status($username)
    {
        $param = [];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users/" . $username . "/status", $param, $header, "GET", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 批量获取在线状态
     *
     * By TerryQi
     *
     * 2019-08-15
     *
     * usernames为数组，类型为["user1","user2"]
     */
    public static function batchStatus($usernames)
    {
        $param = [
            'usernames' => $usernames
        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users/batch/status", $param, $header, "POST", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 获取某个用户的离线消息数
     *
     * By TerryQi
     *
     * 2019-08-15
     *
     */
    public static function offlineMsgCount($owner_username)
    {
        $param = [];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users/" . $owner_username . "/offline_msg_count", $param, $header, "GET", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 禁用账号
     *
     * By TerryQi
     *
     * 2019-08-15
     */
    public static function deactivate($username)
    {
        $param = [

        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users/" . $username . "/deactivate", $param, $header, "POST", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 账号解禁
     *
     * By TerryQi
     *
     * 2019-08-15
     *
     */
    public static function activate($username)
    {
        $param = [

        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users/" . $username . "/activate", $param, $header, "POST", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 强制下线
     *
     * By TerryQi
     *
     * 2019-08-15
     */
    public static function disconnect($username)
    {
        $param = [

        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/users/" . $username . "/disconnect", $param, $header, "GET", 0);
        return EasemobTool::resultFormate($result);
    }

}

