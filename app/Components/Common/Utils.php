<?php
/**
 * Created by PhpStorm.
 * User: HappyQi
 * Date: 2017/12/4
 * Time: 9:23
 */

namespace App\Components\Common;

use Geohash\GeoHash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class Utils
{
    const PAGE_SIZE = 15;


    //状态值
    const STATUS_VALUE_0 = '0';
    const STATUS_VALUE_1 = '1';
    const STATUS_VALUE_2 = '2';
    const STATUS_VALUE_3 = '3';
    const STATUS_VALUE_4 = '4';
    const STATUS_VALUE_5 = '5';
    //通用
    const COMMON_STATUS_VAL = ['0' => '失效', '1' => '有效'];
    const COMMON_STATUS_1 = '1';
    const COMMON_STATUS_0 = '0';
    //推荐状态
    const RECOMM_FLAG_VAL = ['0' => '未推荐', '1' => '已推荐'];
    const RECOMM_FLAG_1 = '1';
    const RECOMM_FLAG_0 = '0';
    //有效状态
    const VALID_STATUS_VAL = ['0' => '失效', '1' => '有效'];
    const VALID_STATUS_1 = '1';
    const VALID_STATUS_0 = '0';
    //使用状态
    const USED_STATUS_VAL = ['0' => '未使用', '1' => '已使用'];
    const USED_STATUS_1 = '1';
    const USED_STATUS_0 = '0';
    //结算状态
    const SETTLE_STATUS_VAL = ['0' => '未结算', '1' => '已结算'];
    const SETTLE_STATUS_1 = '1';
    const SETTLE_STATUS_0 = '0';
    //退款状态
    const REFUND_STATUS_VAL = ['0' => '未退款', '1' => '已退款'];
    const REFUND_STATUS_1 = '1';
    const REFUND_STATUS_0 = '0';
    //支付状态
    const PAY_STATUS_VAL = ['0' => '未支付', '1' => '已支付'];

    //审核状态
    const AUDIT_STATUS_VAL = ['0' => '待审核', '1' => '审核通过', '2' => '审核驳回'];

    //账号类型
    const ACCOUNT_TYPE_TEL_PASSWORD = "tel_password";       //手机号加密码
    const ACCOUNT_TYPE_TEL_CODE = "tel_code";        //手机号加随机密码
    const ACCOUNT_TYPE_XCX = "xcx";     //小程序
    const ACCOUNT_TYPE_FWH = "fwh";     //公众号
    //登录账号
    const ACCOUNT_TYPE_VAL = ['xcx' => '小程序', 'fwh' => '公众号', 'tel_password' => '手机号密码', '手机号随机码' => 'tel_code'];


    /*
    * 判断一个对象是不是空，一般用于校验参数等
    *
    * By TerryQi
    *
    * 2017-12-23
    *
    * @param obj：一个对象
    *
    * @return true：对象为空 false：对象非空
    */
    public static function isObjNull($obj)
    {
        if ($obj === null || $obj === "" || $obj === "undefined") {
            return true;
        }
        return false;
    }

    /*
     * 生成订单号
     *
     * By TerryQi
     *
     * 2017-01-12
     *
     */
    public static function generateTradeNo()
    {
        return date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);;
    }

    /**
     * 调取外部接口方法
     * @param $url 请求网址
     * @param bool $params 请求参数
     * @param int $ispost 请求方式
     * @param int $https https协议
     * @return bool|mixed
     */
    public static function curl($url, $params = false, $ispost = 0, $https = 0)
    {
        Utils::processLog(__METHOD__, '', " " . "url:" . $url);
        $httpInfo = array();
        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//                'Content-Type: application/json; charset=utf-8'
//            )
//        );
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                if (is_array($params)) {
                    $params = http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        $response = curl_exec($ch);

        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }

    /**
     * 经纬度转GeoHash编码
     *
     * $lat  $lon经纬度参数
     *
     * $key 1:代表获取8个区域所有  配合$distance字段使用   2：创建门店时存到数据库中的经纬度转geohash编码字段
     *
     * $distance 获取范围的经度6差不多在范围1000米内 值越大越精确
     */
    public static function latAndLngCoding($lat, $lon, $key, $distance)
    {
        $geohash = new GeoHash();
        $geo = $geohash->encode($lat, $lon);

        if ($key == 1) {
            //取出相邻八个区域
            $geo = substr($geo, 0, $distance);
            $neighbors = $geohash->neighbors($geo);
            array_push($neighbors, $geo);
            $values = [];
            foreach ($neighbors as $key => $val) {
                array_push($values, $val);
//                $values .= '\'' . $val . '\'' .',';
            }
            $geo = $values;
        }

        return $geo;
    }


    /*
     * 生成num位邀请码
     *
     * By TerryQi
     *
     * 2018-05-29
     */
    public static function createInviteCode($num)
    {
        $code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand = $code[rand(0, 25)]
            . strtoupper(dechex(date('m')))
            . date('d')
            . substr(time(), -5)
            . substr(microtime(), 2, 5)
            . sprintf('%02d', rand(0, 99));
        for (
            $a = md5($rand, true),
            $s = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ',
            $d = '',
            $f = 0;
            $f < $num;
            $g = ord($a[$f]),
            $d .= $s[($g ^ ord($a[$f + 8])) - $g & 0x1F],
            $f++
        ) ;
        return $d;
    }

    /*
     * 判断是否是JSON类型
     *
     * By Amy
     *
     * 2018-07-30
     *
     */
    public static function isJson($data)
    {
        $res = json_decode($data, true);
        $error = json_last_error();
        if (!empty($error)) {
            return $res;
        }
        return false;
    }

    /*
     * 判断是否有这个参数
     *
     * By Amy
     *
     * 2018-07-30
     */
    public static function isKeyInArray($key_array, $data)
    {
        $count = 0;
        foreach ($key_array as $key) {
            if (array_key_exists($key, $data) && $data[$key]) {
                $count++;
            }
        }
        if ($count == count($key_array) && $count > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 处理数据，精确到小数点第几位
     * @param $data 数据
     * @param $digit 小数点第几位
     * By Amy
     * 2018-08-27
     */
    public static function accurateTo($data, $digit)
    {
        $arr = explode('.', $data);
        if (count($arr) > 1) {
            $decimal = substr($arr[1], 0, $digit);
            $decimal = (int)$decimal * pow(0.1, strlen($decimal));
            $integer = (int)str_replace(',', '', $arr[0]);
            $data = bcadd($integer, $decimal, $digit);
        }
        return $data;
    }

    /*
     * 生成len数字加小写字符码
     *
     * By Ada
     *
     * 2018-8-8-30
     *
     * $len:生成字符长度
     * $chars:从哪个字符串中截取生成
     *
     * 可以通过该功能生成随机字符串、例如邀请码、验证码等
     *
     */
    public static function getRandomString($len, $chars = null)
    {
        if (is_null($chars)) {
            $chars = "abcdef0123456789";
        }
        mt_srand(10000000 * (double)microtime());
        for ($i = 0, $str = '', $lc = strlen($chars) - 1; $i < $len; $i++) {
            $str .= $chars[mt_rand(0, $lc)];
        }
        return $str;
    }

    /*
     * 下载图片方法
     *
     * By TerryQi
     *
     * 2018-10-11
     *
     * url：下载链接  path：下载路径  filename：文件名
     *
     */
    public static function downloadFile($url, $path, $filename)
    {
        Utils::processLog(__METHOD__, '', " " . "url:" . "  local_avatar_url:" . $url);
        Utils::processLog(__METHOD__, '', " " . "path:" . "  local_avatar_path:" . $path);
        Utils::processLog(__METHOD__, '', " " . "filename:" . "  local_avatar_filename:" . $filename);

//        header("Content-type=html/text;charset=utf-8");

        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_ENCODING,'gzip');

//        header("Content-Type:text/html; charset=gb2312");

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        $file = curl_exec($ch);
        if (self::isObjNull($file)) {
            return false;
        }
        Utils::processLog(__METHOD__, '', " " . "file:" . $file);

        curl_close($ch);
        Utils::processLog(__METHOD__, '', " " . "  ch:" . $ch);
        Utils::processLog(__METHOD__, '', " " . "  url:" . $url);
        Utils::processLog(__METHOD__, '', " " . "  filename——1:" . $filename);

//        $filename=iconv("utf-8","gb2312",$filename);//中文转码

        $filename = $filename;
        Utils::processLog(__METHOD__, '', " " . "  filename——2:" . $filename);


        $resource = fopen($path . '/' . $filename, 'a');
        Utils::processLog(__METHOD__, '', " " . "resource:" . $resource);

        fwrite($resource, $file);
        Utils::processLog(__METHOD__, '', " " . "fwrite(resource, file):" . fwrite($resource, $file));

        fclose($resource);
        Utils::processLog(__METHOD__, '', " " . "filename_end:" . $filename);

        return $filename;
    }

    /*
     * 生成uuid全部用户相同，uuid即为token
     *
     */
    public static function getGUID()
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double)microtime() * 10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));

            $uuid = substr($charid, 0, 8)
                . substr($charid, 8, 4)
                . substr($charid, 12, 4)
                . substr($charid, 16, 4)
                . substr($charid, 20, 12);
            return $uuid;
        }
    }

    /**
     * 求两个已知经纬度之间的距离,单位为米
     *
     * @param lng1 $ ,lng2 经度
     * @param lat1 $ ,lat2 纬度
     * @return float 距离，单位米
     * @author www.Alixixi.com
     */
    function getdistance($lng1, $lat1, $lng2, $lat2)
    {
        // 将角度转为狐度
        $radLat1 = deg2rad($lat1); //deg2rad()函数将角度转换为弧度
        $radLat2 = deg2rad($lat2);
        $radLng1 = deg2rad($lng1);
        $radLng2 = deg2rad($lng2);
        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * 6378.137 * 1000;
        return $s;
    }





    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    //LOG相关

    /**
     * 请求接口LOG
     * @param string $logPath 请求接口
     * @param string $logIp IP地址
     * @param array $logData 请求参数
     */
    public static function requestLog($logPath = "", $logIp = "", $logData = [])
    {
        $LOGO_NO = 'LOG' . date('Ymdhis', time()) . rand(1000000, 10000000);
        Session::put('LOGO_NO', $LOGO_NO);
        Log::info('[Request]  ' . $LOGO_NO . '  ' . $logPath . "(" . $logIp . ")   " . json_encode($logData));
    }

    /**
     * 过程中接口LOG
     * @param string $logModular 模块
     * @param string $logData 数据
     * @param string $logContent 备注
     */
    public static function processLog($logModular = "", $logContent = "", $logData = "")
    {
        $LOGO_NO = Session::get("LOGO_NO");
        if (is_array($logData)) {
            $logData = json_encode($logData, true);
        }
        if ($logContent) {
            Log::info('[Process]  ' . $LOGO_NO . '  ' . $logContent . '  ' . $logModular . '  ' . $logData);
        } else {
            Log::info('[Process]  ' . $LOGO_NO . '  ' . $logModular . '  ' . $logData);
        }
    }

    /**
     * 返回接口LOG
     * @param string $logModular 模块
     * @param array $logData 数据
     */
    public static function backLog($logModular = "", $logData = [])
    {
        $LOGO_NO = Session::get("LOGO_NO");
        $log = array(
            'code' => $logData['code'],
            'result' => $logData['result'],
            'message' => $logData['message'],
        );
        if (array_key_exists('ret', $logData)) {
            $log['ret'] = $logData['ret'];
        }
        Log::info('[Back]  ' . $LOGO_NO . '  ' . $logModular . '  ' . json_encode($log, true));
        Session::remove("LOGO_NO");
    }

    /**
     * 过程报错接口LOG
     * @param string $logData 数据
     */
    public static function errorLog($logData = "")
    {
        $LOGO_NO = Session::get("LOGO_NO");
        if (!$LOGO_NO) {
            $LOGO_NO = 'LOG' . date('Ymdhis', time()) . rand(1000000, 10000000);
            Session::put('LOGO_NO', $LOGO_NO);
        }
        if (is_array($logData)) {
            $logData = json_encode($logData, true);
        }
        Log::info('[Error]  ' . $LOGO_NO . '  ' . $logData);
        Session::remove("LOGO_NO");
    }

    /**
     * 自定义LOG
     * @param string $label log标签
     * @param string $logContent 备注
     * @param string/array $logData 数据
     */
    public static function customLog($label = "DEBUG", $logContent = "", $logData = "")
    {
        $LOGO_NO = Session::get("LOGO_NO");
        if (!$LOGO_NO) {
            $LOGO_NO = 'LOG' . date('Ymdhis', time()) . rand(1000000, 10000000);
            Session::put('LOGO_NO', $LOGO_NO);
        }
        if (is_array($logData)) {
            // 将数组转为字符串
            $logDataArray = $logData;
            $logData = '';
            foreach ($logDataArray as $key => $logDataRow) {
                if (is_array($logDataRow)) {
                    $logDataRow = json_encode($logDataRow, true);
                }
                $str = $key . "：" . $logDataRow;
                $logData .= $str . '  ';
            }
        }
        if ($logContent) {
            Log::info('[' . $label . ']  ' . $LOGO_NO . '  ' . $logContent . '  ' . $logData);
        } else {
            Log::info('[' . $label . ']  ' . $LOGO_NO . '  ' . $logData);
        }
        Session::remove("LOGO_NO");
    }

    /**
     * 返回接口LOG
     * @param string $logModular 模块
     * @param array $logData 数据
     */
    public static function responseLog($logModular = "", $logData = [])
    {
        $LOGO_NO = Session::get("LOGO_NO");
        $log = array(
            'code' => $logData['code'],
            'result' => $logData['result'],
            'message' => $logData['message'],
        );
        if (array_key_exists('ret', $logData)) {
            $log['ret'] = $logData['ret'];
        }
        Log::info('[RESPONSE]  ' . $LOGO_NO . '  ' . $logModular . '  ' . json_encode($log, true));
        Session::remove("LOGO_NO");
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////


}