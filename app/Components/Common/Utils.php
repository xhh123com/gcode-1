<?php
/**
 * Created by PhpStorm.
 * User: HappyQi
 * Date: 2017/12/4
 * Time: 9:23
 */

namespace App\Components\Common;

use Geohash\GeoHash;
use Illuminate\Support\Facades\Crypt;
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
    //通用的默认设置
    const DEFAULT_VAL = ['0' => '非默认', '1' => '默认'];
    const DEFAULT_STATUS_1 = '1';
    const DEFAULT_STATUS_0 = '0';
    //通用的结果
    const RESULT_STATUS_VAL = ['0' => '失败', '1' => '成功'];
    const RESULT_STATUS_0 = '0';
    const RESULT_STATUS_1 = '1';
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
    const AUDIT_STATUS_VAL = ['0' => '待审核中', '1' => '审核通过', '2' => '审核驳回'];

    //星期状态
    const WEEK_VAL = ['1' => '星期一', '1' => '星期一', '2' => '星期二', '3' => '星期三', '4' => '星期四', '5' => '星期五', '6' => '星期六', '7' => '星期日',];

    //账号类型
    const ACCOUNT_TYPE_TEL_PASSWORD = "tel_password";       //手机号加密码
    const ACCOUNT_TYPE_TEL_CODE = "tel_code";        //手机号加随机密码
    const ACCOUNT_TYPE_XCX = "xhx";     //小程序
    const ACCOUNT_TYPE_FWH = "fwh";     //公众号
    //登录账号
    const ACCOUNT_TYPE_VAL = [self::ACCOUNT_TYPE_TEL_PASSWORD => '手机号密码'
        , self::ACCOUNT_TYPE_TEL_CODE => '手机号短信码'
        , self::ACCOUNT_TYPE_XCX => '小程序'
        , self::ACCOUNT_TYPE_FWH => '公众号'];

    //用户性别
    const USER_GENDER_VAL = ['0' => '保密', '1' => '男', '2' => '女'];

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
    public static function curl($url, $params = false, $ispost = 0, $https = 0, $header = null)
    {
        Utils::processLog(__METHOD__, '', " " . "url:" . $url);
        $httpInfo = array();
        $ch = curl_init();

        //2019-10-07进行优化，可以设置header信息
        if ($header == null) {
            $header = array(
                'Content-Type: application/json; charset=utf-8'
            );
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
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
            Utils::processLog(__METHOD__, "", "POST请求的params：" . json_encode($params));
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
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
     *
     * @param num：代表邀请码数
     *
     * type：代表类型 0：不带英文 1：带英文
     */
    public static function createInviteCode($num, $type = 0)
    {
        $base_str = '123456789';
        if ($type == 1) {
            $base_str = $base_str . 'ABCDEFGHJKMNPQRSTUVWXYZ';
        }
        $code = "";
        for ($i = 0; $i < $num; $i++) {
            $rand_pos = rand(0, (strlen($base_str) - 1));
            $code = $code . self::substr_text($base_str, $rand_pos, 1);
        }
        return $code;
    }


    /*
     * 格式化值，即将81000格式化为8.1w
     * 
     * By TerryQi
     * 
     * 2019-10-15
     */
    public static function formateValue($value)
    {
        if ($value > 10000) {
            $value = (double)$value / 10000;
            $value = round($value, 2) . "w";
        }
        return $value;
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
            $chars = "0123456789";
        }
        mt_srand(10000000 * (double)microtime());
        for ($i = 0, $str = '', $lc = strlen($chars) - 1; $i < $len; $i++) {
            $str .= $chars[mt_rand(0, $lc)];
        }
        return $str;
    }

    //缩放图片
    /*
     * im 需要缩放的图片 maxwith最大宽度 maxheight最大高度
     *
     *
     */
    public static function resizeImage($im, $maxwidth, $maxheight)
    {
        $pic_width = imagesx($im);
        $pic_height = imagesy($im);

        //进行优化，增加是否需要重新设计大小的标识
        $resizewidth_tag = false;
        $resizeheight_tag = false;

        //缩放比例
        $widthratio = 1;
        $heightratio = 1;

        //最终缩放比例
        $ratio = 1;

        if (($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight)) {
            if ($maxwidth && $pic_width > $maxwidth) {
                $widthratio = (double)($maxwidth / $pic_width);
                $resizewidth_tag = true;
            }
            if ($maxheight && $pic_height > $maxheight) {
                $heightratio = (double)($maxheight / $pic_height);
                $resizeheight_tag = true;
            }

            if ($resizewidth_tag && $resizeheight_tag) {
                if ($widthratio < $heightratio)
                    $ratio = $widthratio;
                else
                    $ratio = $heightratio;
            }

            if ($resizewidth_tag && !$resizeheight_tag)
                $ratio = $widthratio;
            if ($resizeheight_tag && !$resizewidth_tag)
                $ratio = $heightratio;

            $newwidth = $pic_width * $ratio;
            $newheight = $pic_height * $ratio;

            self::processLog(__METHOD__, '', "widthratio："
                . $widthratio . " resizewidth_tag：" . $resizewidth_tag . " heightratio:" . $heightratio . " resizeheight_tag:" . $resizeheight_tag
                . " ratio" . $ratio . " newwidth:" . $newwidth . " newheight:" . $newheight);

            if (function_exists("imagecopyresampled")) {
                $newim = imagecreatetruecolor($newwidth, $newheight);
                imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height);
            } else {
                $newim = imagecreate($newwidth, $newheight);
                imagecopyresized($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height);
            }
            return $newim;
        } else {
            return $im;
        }
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
        Utils::processLog(__METHOD__, '', " " . "url:" . $url);
        Utils::processLog(__METHOD__, '', " " . "path:" . $path);
        Utils::processLog(__METHOD__, '', " " . "filename:" . $filename);

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
//        Utils::processLog(__METHOD__, '', " " . "file:" . $file);

        curl_close($ch);
//        Utils::processLog(__METHOD__, '', " " . "  ch:" . $ch);
//        Utils::processLog(__METHOD__, '', " " . "  url:" . $url);
//        Utils::processLog(__METHOD__, '', " " . "  filename——1:" . $filename);

//        $filename=iconv("utf-8","gb2312",$filename);//中文转码

//        Utils::processLog(__METHOD__, '', " " . "  filename——2:" . $filename);


        $resource = fopen($path . '/' . $filename, 'a');
//        Utils::processLog(__METHOD__, '', " " . "resource:" . $resource);

        fwrite($resource, $file);
//        Utils::processLog(__METHOD__, '', " " . "fwrite(resource, file):" . fwrite($resource, $file));

        fclose($resource);
        Utils::processLog(__METHOD__, '', " " . "filename_end:" . $filename);

        return $filename;
    }

    /*
     * 生成uuid全部用户不相同，uuid即为token
     *
     * By TerryQi
     *
     */
    public static function getGUID()
    {
        $uuid = null;
        if (function_exists('com_create_guid')) {
            $uuid = com_create_guid();
        } else {
            mt_srand((double)microtime() * 10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));

            $uuid = substr($charid, 0, 8)
                . substr($charid, 8, 4)
                . substr($charid, 12, 4)
                . substr($charid, 16, 4)
                . substr($charid, 20, 12);
        }
        //2019-08-07进行uuid的加盐
        /*
         * By TerryQi
         *
         * 2019-08-17
         */
        $uuid = $uuid . strtoupper(md5(rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9)));       //加盐方法为随机成功4个数字，然后md5加密，然后都转大写

        return $uuid;
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

    /*
     * 统计数据补领工具
     *
     * By TerryQi
     *
     * 要求数组的元素格式为 ["data"=>$data,'value'=>$value]，data代表日期、value代表具体的值
     *
     * 入参要求
     *
     * @arr 数组样式：必须参考元素格式，即data和value的格式
     * @start_at 开始日期，必须为2018-11-28的格式
     * @end_at 结束日期，必须为2018-12-01的格式
     *
     * 输出数组，将日期空缺补零
     *
     */
    public static function replZero($arr, $start_at, $end_at)
    {
        $nums = DateTool::dateDiff('D', $start_at, $end_at);
        //进行补零动作
        $replZero_arr = [];        //处理后的数组
        for ($i = 0; $i < $nums; $i++) {
            $date_at = DateTool::dateAdd('D', $i, $start_at, 'Y-m-d');
            //代表有值
            $index = self::isDateInStatisArr($date_at, $arr);
            $item = null;
            if ($index != -1) {
                $item = array(
                    'date' => $arr[$index]['date'],
                    'value' => round($arr[$index]['value'], 2)
                );
            } else {
                $item = array(
                    'date' => $date_at,
                    'value' => 0
                );
            }
            array_push($replZero_arr, $item);
        }
        return $replZero_arr;
    }


    //配合replZero使用，判断arr中有没有data_at的数据
    //如果有返回i，即具体位置，否则返回-1
    //该方法能够仅限于支撑replZero方法
    /*
     * By TerryQi
     *
     * @date_at 为arr中date的具体指，arr为数组，格式为[["data"=>$data,'value'=>$value],.....]
     *
     * @return 如果有值返回 index，如果没有值返回-1
     */
    public static function isDateInStatisArr($date_at, $arr)
    {
        //循环数组
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i]['date'] == $date_at) {
                return $i;
            }
        }
        return -1;
    }

    /*
     * 字符串截取
     *
     * By TerryQi
     *
     * 2018-12-05
     *
     * @str：需要截取的字符串 start：开始位置 length：长度 chartset：字符集 suffix 结束符
     */

    public static function substr_text($str, $start = 0, $length, $charset = "utf-8", $suffix = "")
    {
        if (function_exists("mb_substr")) {
            return mb_substr($str, $start, $length, $charset) . $suffix;
        } elseif (function_exists('iconv_substr')) {
            return iconv_substr($str, $start, $length, $charset) . $suffix;
        }
        $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("", array_slice($match[0], $start, $length));
        return $slice . $suffix;
    }

    /*
     * 配置文字自动换行
     *
     * By TerryQi
     *
     * 2018-12-05
     *
     * 字体大小:fontsize, 角度:angle, 字体名称:fontface, 字符串:string, 预设宽度:width
     *
     */
    public static function autowrap($fontsize, $angle, $fontface, $string, $width)
    {
        $content = "";

        // 将字符串拆分成一个个单字 保存到数组 letter 中
        for ($i = 0; $i < mb_strlen($string); $i++) {
            $letter[] = mb_substr($string, $i, 1);
        }

        foreach ($letter as $l) {
            $teststr = $content . " " . $l;
            $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
            // 判断拼接后的字符串是否超过预设的宽度
            if (($testbox[2] > $width) && ($content !== "")) {
                $content .= "\n";
            }
            $content .= $l;
        }

        return $content;
    }


    /**
     * 根据时间戳计算年龄
     * @param $birth
     * @return mixed
     */
    public static function getAge($birthday)
    {
        $iage = 0;
        if (!empty($birthday)) {
            $year = date('Y', strtotime($birthday));
            $month = date('m', strtotime($birthday));
            $day = date('d', strtotime($birthday));

            $now_year = date('Y');
            $now_month = date('m');
            $now_day = date('d');

            if ($now_year > $year) {
                $iage = $now_year - $year - 1;
                if ($now_month > $month) {
                    $iage++;
                } else if ($now_month == $month) {
                    if ($now_day >= $day) {
                        $iage++;
                    }
                }
            }
        }
        return $iage;
    }


    /*
     * 获取中国的weeknum，即周日是7，不是0
     *
     * By TerryQi
     *
     * 2019-06-23
     */
    public static function getChiWeekNum($date_str)
    {
        $en_week_num = DateTool::getWeekNum($date_str);
        if ($en_week_num == 0) {
            $en_week_num = 7;
        }
        return $en_week_num;
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
            Log::info('[Process]  ' . $LOGO_NO . '  ' . $logModular . '  ' . $logContent . '  ' . $logData);
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