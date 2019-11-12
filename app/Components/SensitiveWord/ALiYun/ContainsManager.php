<?php


namespace App\Components\SensitiveWord\ALiYun;


use App\Components\Common\Utils;

//该Manager用于阿里云的敏感词查询接口
//一般发布内容类(内容、评论)需要使用敏感词的查询
class ContainsManager
{

    const HOST = "http://apistore.tongchengyue.com";

    /*
     *
     * 判断文字中是否有敏感词
     *
     *
     * $content 敏感词
     *
     * By Auto CodeCreator
     *
     * 2019-11-11 06:45:11
     */
    public static function isWordValid($content)
    {
        $host = HOST;
        $path = "/sw/check";
        $method = "POST";
        $appcode = env('ALIYUN_SENSITIVE_APPCODE', "");
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        //根据API的要求，定义相对应的Content-Type
        array_push($headers, "Content-Type" . ":" . "application/x-www-form-urlencoded; charset=UTF-8");
        $querys = "word=$content";
        $bodys = "";
        $url = $host . $path . "?" . $querys;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$" . $host, "https://")) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, $bodys);
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);        //转化为数组

        return $response;
    }


    /*
   * isContentValid
   *
   * 是否句子里存在敏感词
   *
   *
   * $content 敏感句子
   *
   * By Auto CodeCreator
   *
   * 2019-11-11 06:45:11
   */
    public static function isContentValid($content)
    {
        $host = HOST;
        $path = "/sw/isContains";
        $method = "POST";
        $appcode = env('ALIYUN_SENSITIVE_APPCODE', "");
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        //根据API的要求，定义相对应的Content-Type
        array_push($headers, "Content-Type" . ":" . "application/x-www-form-urlencoded; charset=UTF-8");
        $querys = "src=$content";
        $bodys = "";
        $url = $host . $path . "?" . $querys;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$" . $host, "https://")) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, $bodys);

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);        //转化为数组

        return $response;
    }

}
