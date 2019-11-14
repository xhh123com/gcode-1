<?php
/**
 * Created by PhpStorm.
 * User: mtt17
 * Date: 2018/7/4
 * Time: 14:08
 */

namespace App\Components\SMS\ALiYun;


use App\Components\Common\SignatureHelper;

class SMSManager
{
    /*
     * 发送验证码-阿里中国
     *
     * By Ada
     *
     * 2018-11-09
     */
    public static function sendVertifyALZH($telphone, $vertify_code)
    {
        $ACCESS_KEY_ID = env('AL_ACCESS_KEY_ID');
        $ACCESS_KEY_SECRET = env('AL_ACCESS_KEY_SECRET');
        // fixme 必填: 短信接收号码
        $params["PhoneNumbers"] = $telphone;
        // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = env('AL_SIGN_NAME');
        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = env('AL_TEMPLATE_CODE');
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
            $ACCESS_KEY_ID,
            $ACCESS_KEY_SECRET,
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











