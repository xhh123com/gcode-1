<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/9/9
 * Time: 13:09
 */

namespace App\Components\AXB\HuaWei;

/*
 * 此处封装华为的AXB的服务
 *
 * By TerryQi
 *
 * 2019-09-09
 */

use App\Components\Common\DateTool;
use App\Components\Common\Utils;
use App\Components\PhonenumPoolBindManager;
use App\Models\PhonenumPoolBind;

class AXBTool
{
    //接口地址
    const API_URL = "http://v.juhe.cn/exp";

    /*
     * 绑定AXB的绑定接口
     *
     * By TerryQi
     *
     * 2019-09-09
     *
     * @caller_num为A用户号码、callee_num为B用户号码
     *
     * call_direction呼叫方向 0：双向 1：A to B 2：B to A
     *
     * duration：绑定时间控制
     *
     */
    public static function bind($caller_num, $callee_num, $x_num, $call_direction = 1, $duration = (60 * 60), $maxDuration = 15, $last_min_voice = null, $preVoice = null)
    {
        //封装header信息
        $headers = [
            'Accept: application/json',
            'Content-Type: application/json;charset=UTF-8',
            'Authorization: WSSE realm="SDP",profile="UsernameToken",type="Appkey"',
            'X-WSSE: ' . self::buildWsseHeader(env('HUAWEI_AXB_APP_Key', ''), env('HUAWEI_AXB_APP_Secret', ''))
        ];
        Utils::processLog(__METHOD__, "", "headers:" . json_encode($headers));

        //封装参数
        $params = [
            'relationNum' => "+86" . $x_num,
            'callerNum' => "+86" . $caller_num,
            'calleeNum' => "+86" . $callee_num,
            'recordFlag' => true,
            'callDirection' => $call_direction,
            'duration' => $duration,
            'maxDuration' => $maxDuration,
            'lastMinVoice' => 'alertAudio.wav',
            'lastMinVoice' => $last_min_voice,
            'preVoice' => $preVoice,
        ];

        $function_api_url = self::API_URL . "/rest/caas/relationnumber/partners/v1.0";
        $response = self::curl($function_api_url, $params, $headers, "POST", 0);

        $response = json_decode($response, true);
        return $response;
    }


    /*
     * 解绑AXB
     *
     * By TerryQi
     *
     *  @subscription_id为绑定号码、x_num中间号
     */
    public static function unbind($subscription_id)
    {
        //封装header信息
        $headers = [
            'Accept: application/json',
            'Content-Type: application/json;charset=UTF-8',
            'Authorization: WSSE realm="SDP",profile="UsernameToken",type="Appkey"',
            'X-WSSE: ' . self::buildWsseHeader(env('HUAWEI_AXB_APP_Key', ''), env('HUAWEI_AXB_APP_Secret', ''))
        ];
        Utils::processLog(__METHOD__, "", "headers:" . json_encode($headers));
        //封装参数
        $params = [
            'subscriptionId' => $subscription_id,
        ];
        $url_params = http_build_query($params);
        $function_api_url = self::API_URL . "/rest/caas/relationnumber/partners/v1.0?" . $url_params;

        $response = self::curl($function_api_url, $params, $headers, "DELETE", 0);
        Utils::processLog(__METHOD__, "", "response:" . json_encode($response));

        return $response;
    }


    /*
     * 查询绑定信息接口
     *
     * By TerryQi
     *
     * 2019-09-09
     *
     * $x_num中间号
     */
    public static function select($x_num)
    {
        //封装header信息
        $headers = [
            'Accept: application/json',
            'Content-Type: application/json;charset=UTF-8',
            'Authorization: WSSE realm="SDP",profile="UsernameToken",type="Appkey"',
            'X-WSSE: ' . self::buildWsseHeader(env('HUAWEI_AXB_APP_Key', ''), env('HUAWEI_AXB_APP_Secret', ''))
        ];
        Utils::processLog(__METHOD__, "", "headers:" . json_encode($headers));
        //封装参数
        $params = [
        ];
        $function_api_url = self::API_URL . "/rest/caas/relationnumber/partners/v1.0?" . "relationNum=" . "%2B86" . $x_num;

        $response = self::curl($function_api_url, $params, $headers, "GET", 0);
        Utils::processLog(__METHOD__, "", "response:" . json_encode($response));

        return $response;
    }


    /**
     * 构建X-WSSE值
     *
     * @param string $appKey
     * @param string $appSecret
     * @return string
     */
    private static function buildWsseHeader($appKey, $appSecret)
    {
        date_default_timezone_set("UTC");
        $Created = date('Y-m-d\TH:i:s\Z'); //Created
        $nonce = uniqid(); //Nonce
        $base64 = base64_encode(hash('sha256', ($nonce . $Created . $appSecret), TRUE)); //PasswordDigest
        date_default_timezone_set('PRC');
        return sprintf("UsernameToken Username=\"%s\",PasswordDigest=\"%s\",Nonce=\"%s\",Created=\"%s\"", $appKey, $base64, $nonce, $Created);
    }

    /*
     * 统一封装业务请求
     *
     * By TerryQi
     *
     * @param
     *
     * uri：uri不是url，uir是url与后缀拼接的方法，因为环信业务的
     * param：param是请求参数，数组形式，系统将转为json形式
     * method：为请求方法，get post put delete等
     */
    public static function curl($url, $param = false, $header = '', $method = "GET", $https = 0)
    {
        Utils::processLog(__METHOD__, '', "调用接口工具  " . "url:" . $url);
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);        //设置即将访问的地址
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        //如果存在param
        if (!empty($param)) {
            $param = json_encode($param);
            Utils::processLog(__METHOD__, "", "请求值 param:" . json_encode($param));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        }

        $response = curl_exec($ch);
        Utils::processLog(__METHOD__, '', '返回值为 response:' . json_encode($response));
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        Utils::processLog(__METHOD__, '', "返回的 code:" . $httpCode);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);

        return $response;
    }


}