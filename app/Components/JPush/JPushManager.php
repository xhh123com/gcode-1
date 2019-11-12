<?php


/**
 * Created by PhpStorm.
 * User: mtt17
 * Date: 2018/4/9
 * Time: 11:32
 */

namespace App\Components\JPush;


use JPush\Client as JPush;

//JPush
class JPushManager
{
    /*
   * 发送极光推送
   *
   * By Auto CodeCreator
   *
   * 2019-09-26 12:45:34
   *
   * @param   message：内容 registration_id：极光推送唯一标识
     *
     *  msg_content	消息内容本身
        title	消息标题
        content_type	消息内容类型
        extras	表示扩展字段，接受一个数组，自定义 Key/value 信息以供业务使用
     *
     * 请注意：msg_content为消息内容本身
     *
     * title为标题
     *
     * content_type为类型，目前为text
     *
     * extras为扩展消息样式     *
     *
   */
    public static function JPushMessage($registration_id, $msg_content, $title = "", $content_type = 'text', $extras = [])
    {
        $app_key = env('JPUSH_APP_KEY');
        $master_secret = env('JPUSH_APP_MASTER_SECRET');
        $client = new JPush($app_key, $master_secret);
        $pusher = $client->push();
        $pusher->setPlatform('all');
        //$pusher->addAllAudience();
        //$pusher->addTag(['tag1', 'tag2'])
        $pusher->addRegistrationId($registration_id);
        $pusher->message($msg_content, [
            'title' => $title,
            'content_type' => $content_type,
            'extras' => $extras
        ]);
        try {
            return $pusher->send();
        } catch (\JPush\Exceptions\APIConnectionException $e) {
            // try something here
            return $e;
        } catch (\JPush\Exceptions\APIRequestException $e) {
            // try something here
            return $e;
        }
    }

}

