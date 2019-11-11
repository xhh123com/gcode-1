<?php


namespace App\Components\SensitiveWord\ALiYun;


use App\Components\Common\Utils;

class ContainsManager
{
    /*
     * isValid
     *
     * 是否存在敏感词
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
        $host = "http://apistore.tongchengyue.com";
        $path = "/sw/check";
        $method = "POST";
        $appcode = "da98754f85504271922193482d796383";
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
        return curl_exec($curl);
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
        $host = "http://apistore.tongchengyue.com";
        $path = "/sw/isContains";
        $method = "POST";
        $appcode = "da98754f85504271922193482d796383";
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
        return curl_exec($curl);
    }

}
