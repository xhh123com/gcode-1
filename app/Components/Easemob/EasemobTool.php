<?php
/**
 * Created by PhpStorm.
 * User: HappyQi
 * Date: 2017/12/4
 * Time: 9:23
 */

namespace App\Components\Easemob;

use App\Components\Common\Utils;
use App\Components\EasemobManager;
use Geohash\GeoHash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class EasemobTool
{

    /*
     * 获取环信业务的基本配置信息
     *
     * @return 其中包括
     * base_url：调用环信接口的基本信息
     * client_id：环信client_id
     * client：环信client_secret
     *
     */
    public static function getConfig()
    {
        //环信端的基本配置
        $config = [
            "base_url" => "http://a1.easemob.com/" . env('EASEMOB_Orgname', '') . "/" . env('EASEMOB_appname'),
            "client_id" => env('EASEMOB_CLIENT_ID', ''),
            "client_secret" => env('EASEMOB_Client_Secret', ''),
        ];

        return $config;
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
    public static function curl($uri, $param = false, $header = '', $method = "GET", $https = 0)
    {
        Utils::processLog(__METHOD__, '', "调用接口工具 " . "uri:" . $uri . " param:" . json_encode($param));
        $url = self::getConfig()['base_url'] . $uri;
        Utils::processLog(__METHOD__, '', "拼接url为 " . "url:" . $url);
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
            Utils::processLog(__METHOD__, "", "请求值 easemob tool uri:" . $uri . " param:" . json_encode($param));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        }

        $response = curl_exec($ch);
        Utils::processLog(__METHOD__, '', '返回值为 easemob tool response:' . $response);

        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        Utils::processLog(__METHOD__, '', "返回的 easemob tool code:" . $httpCode);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);

        return $response;
    }


    /*
     * 生成密码，环信要求生成密码
     *
     * By TerryQi
     *
     * 2019-08-05
     *
     * @param
     * username：为环信的用户名
     * key：为加密的秘钥
     *
     * @return password 返回值为密码
     *
     */
    public static function generatePassword($username, $key = "_easemob")
    {
        return Crypt::encrypt($username . $key);
    }


    /////////////////////////////////////////////////
    /// 以下是基于上述方法进行的封装
    ///
    /// By TerryQi
    ///

    /*
     * 结果集转化，封装该方法的意义在于后续可能面临将结果集转化为某一格式的问题
     *
     * By TerryQi
     *
     */
    public static function resultFormate($result, $format = 'stdClass')
    {
        $format_result = null;

        switch ($format) {
            case "stdClass":       //返回stdClass，可以使用链式的调用结构
                $format_result = json_decode($result);
                break;
            case "array":       //返回数组形式
                $format_result = json_decode($result, true);
                break;
        }
        return $format_result;
    }


}