<?php

/**
 * Created by PhpStorm.
 * User: HappyQi
 * Date: 2017/9/28
 * Time: 10:30
 */

namespace App\Components\Common;

use Illuminate\Support\Facades\Log;

class SMS
{
    //发送通知
    public static function sendSMS($telphone, $templated_id, $sms_txt)
    {
        $param = array(
            'phonenum' => $telphone,
            'template_id' => $templated_id,
            'pro_code' => env('PRO_CODE', ''),
            'sms_txt' => $sms_txt
        );
        Log::info(__METHOD__ . " " . "sendSMS param:" . json_encode($param));
        $result = Utils::curl('http://common.isart.me/api/common/sms/sendSMS', $param, true);   //访问接口
        Log::info(__METHOD__ . " " . "result:" . json_encode($result));
        $result = json_decode($result, true);   //因为返回的已经是json数据，为了适配makeResponse方法，所以进行json转数组操作
        return $result;
    }
}
