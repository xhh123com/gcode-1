<?php

/**
 * Created by PhpStorm.
 * User: leek
 * Date: 2019/04/30
 * Time: 10:30
 */

namespace App\Components\Common;

use App\Components\Common\SignatureHelper;
use App\Components\VertifyManager;
use Illuminate\Support\Facades\Log;

class AliSMS
{

    //发送通知
    public static function sendVertifyCode($telphone, $code)
    {
        $result = self::sendSMS($telphone, $code);

        return $result;
    }


    public static function sendSMS($telphone, $vertify_code)
    {
        // fixme 必填: 短信接收号码
        $params["PhoneNumbers"] = $telphone;
        // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = "康复云平台";
        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
//            $params["TemplateCode"] = "SMS_138069318";
        //修改2018-9-11    国内
        $params["TemplateCode"] = "SMS_164395481";
        // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        $params['TemplateParam'] = Array(
            "code" => $vertify_code,
        );
        // fixme 可选: 设置发送短信流水号
        $params['OutId'] = "12345";
        // fixme 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
        $params['SmsUpExtendCode'] = "1234567";
        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if (!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }
        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelper();
        // 此处可能会抛出异常，注意catch
        $content = $helper->request(
            env('ALI_ACCESS_KEY_ID', ''),
            env('ALI_ACCESS_KEY_SECRET', ''),
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            ))
        // fixme 选填: 启用https
        // ,true
        );
        return $content;
    }
}
