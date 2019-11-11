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

class EasemobMessageManager
{

    /*
     * 发送文本消息
     *
     * By TerryQi
     *
     * @param 详见环信文档
     *  target_type：发送的目标类型；users：给用户发消息，chatgroups：给群发消息，chatrooms：给聊天室发消息
     *  target：发送的目标；注意这里需要用数组，数组长度建议不大于20，即使只有一个用户，也要用数组 ['u1']；给用户发送时数组元素是用户名，给群组发送时，数组元素是groupid
     *  msg：消息内容
     *  from：表示消息发送者;无此字段Server会默认设置为“from”:“admin”，有from字段但值为空串(“”)时请求失败
     */
    public static function sendText($target_type = "users", $target, $msg, $from)
    {
        $param = [
            "target_type" => $target_type,
            "target" => $target,
            "msg" => [
                "type" => "txt",
                "msg" => $msg
            ],
            "from" => $from
        ];
        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/messages", $param, $header, "POST", 0);
        return EasemobTool::resultFormate($result);
    }

    /*
     * 发送扩展消息
     *
     * By TerryQi
     *
     * 详见 http://docs-im.easemob.com/im/server/basics/messages#发送扩展消息
     *
     *  target_type：发送的目标类型；users：给用户发消息，chatgroups：给群发消息，chatrooms：给聊天室发消息
     *  target：发送的目标；注意这里需要用数组，数组长度建议不大于20，即使只有一个用户，也要用数组 ['u1']；给用户发送时数组元素是用户名，给群组发送时，数组元素是groupid
     *  msg：消息内容
     *  from：表示消息发送者;无此字段Server会默认设置为“from”:“admin”，有from字段但值为空串(“”)时请求失败
     *  ext：为扩展消息内容，"ext":{"attr1":"test"}
     */
    public static function sendExt($target_type = "chatrooms", $target, $msg = "", $from, $ext)
    {
        $param = [
            "target_type" => $target_type,
            "target" => $target,
            "msg" => [
                "type" => "txt",
                "msg" => $msg
            ],
            "from" => $from,
            "ext" => $ext
        ];

        Utils::processLog(__METHOD__, "", "发送扩展消息 param:" . json_encode($ext));

        $header = [
            'Authorization: Bearer ' . EasemobBaseManager::getToken(),
            'Content-Type: application/json'
        ];
        $result = EasemobTool::curl("/messages", $param, $header, "POST", 0);
        return EasemobTool::resultFormate($result);
    }


}

