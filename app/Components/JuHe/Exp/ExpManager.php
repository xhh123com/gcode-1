<?php
/**
 * Created by PhpStorm.
 * User: HappyQi
 * Date: 2017/12/4
 * Time: 9:23
 */

namespace App\Components\JuHe\Exp;

use App\Components\Common\Utils;
use App\Components\EasemobManager;
use Geohash\GeoHash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ExpManager
{

    //具体文档请查看

    /*
     * 获取常用快递公司编码
     *
     * By TerryQi
     *
     * 请注意，此处只是单纯调用接口，后端人员可以将常用的快递公司维护到数据库中，而不需要通过该接口获取全量的数据
     *
     * 即常用的快递公司的no记录到库中，以便查询快递时可以使用即可
     *
     * @return 返回stdClass对象，即可以通过$x->item方式来访问
     *
     */
    public static function com()
    {
        $appkey = env('JUHE_EXP_APPKEY', '');
        $url = "http://v.juhe.cn/exp/com?key=" . $appkey;
        $param = [];
        $header = [];
        $result = self::curl($url, $param, $header, "GET", 0);
        return self::resultFormate($result);
    }

    /*
     * 常用快递查询
     *
     * By TerryQi
     *
     * 2020-01-02
     *
     * @param com：快递公司编号，通过com接口获得，应该让客户通过select选择
     *        no：快递单号
     *
     * @return 返回stdClass对象，即可以通过$x->item方式来访问
     *
     */

    public static function index($com, $no)
    {
        $appkey = env('JUHE_EXP_APPKEY', '');
        $url = "http://v.juhe.cn/exp/index?com=" . $com . "&no=" . $no . "&key=" . $appkey;
        $param = [];
        $header = [];
        $result = self::curl($url, $param, $header, "GET", 0);
        return self::resultFormate($result);
    }


    /*
     * 统一封装业务请求
     *
     * By TerryQi
     *
     * @param
     *
     * param：param是请求参数，数组形式，系统将转为json形式
     * method：为请求方法，get post put delete等
     */
    public static function curl($url, $param = false, $header = '', $method = "GET", $https = 0)
    {
        Utils::processLog(__METHOD__, '', "调用接口工具 " . "url:" . $url . " param:" . json_encode($param));
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
            Utils::processLog(__METHOD__, "", "请求值 easemob tool url:" . $url . " param:" . json_encode($param));
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