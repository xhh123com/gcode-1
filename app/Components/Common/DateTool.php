<?php
/**
 * Created by PhpStorm.
 * User: HappyQi
 * Date: 2017/12/4
 * Time: 9:23
 */

namespace App\Components\Common;


class DateTool
{

    /*
     * 格式化日期函数
     *
     * By TerryQi
     *
     * 2017-12-07
     *
     * style具体查看代码中对应的日期处理函数
     *
     */
    public static function formateData($date_str, $style)
    {
        if (Utils::isObjNull($date_str)) {
            return $date_str;
        }
        switch ($style) {
            case 0:
                return self::getYMDChi($date_str);
            case 1:
                return self::getYMDHSChi($date_str);
        }
        return $date_str;
    }

    /*
     * 将2017-11-27 00:00:00转换为2017年11月27日
     *
     * By TerryQi
     *
     * 2017-12-04
     *
     */
    public static function getYMDChi($date_str)
    {
        $date_arr = explode(' ', $date_str);
        $date_obj_arr = explode('-', $date_arr[0]);
        return $date_obj_arr[0] . "年" . $date_obj_arr[1] . "月" . $date_obj_arr[2] . "日";
    }

    /*
     * 将2017-11-27 00:00:00转换为2017年11月27日 12:12
     *
     * By TerryQi
     *
     * 2017-12-06
     *
     */
    public static function getYMDHSChi($date_str)
    {
        $date_arr = explode(' ', $date_str);
        $date_obj_arr = explode('-', $date_arr[0]);
        $time_obj_arr = explode(':', $date_arr[1]);
        return $date_obj_arr[0] . "年" . $date_obj_arr[1] . "月" . $date_obj_arr[2] . "日" . " " . $time_obj_arr[0] . ":" . $time_obj_arr[1];
    }

    /*
     * 将2017-11-27 00:00:00转换为2017-11-27
     *
     * By TerryQi
     *
     * 2017-12-04
     */
    public static function getYMD($date_str)
    {
        $date_arr = explode(' ', $date_str);
        return $date_arr[0];
    }

    /**
     * 获取或者设置时区
     *
     * @param int $timezone 时区
     * @return string | bool
     */
    public static function timeZone($timezone = '')
    {
        if ($timezone) {
            return function_exists('date_default_timezone_set') ? date_default_timezone_set($timezone) : putenv("TZ={$timezone}");
        } else {
            return function_exists('date_default_timezone_get') ? date_default_timezone_get() : date('e');
        }
    }

    /**
     * 检查年、月、日是有效组合。
     * @param integer $y year
     * @param integer $m month
     * @param integer $d day
     * @return boolean true if valid date, semantic check only.
     */
    public static function isValidDate($y, $m, $d)
    {
        return checkdate($m, $d, $y);
    }

    /**
     * 检查日期是否合法日期。
     * @param string $date 2012-1-12
     * @param string $separator
     * @return boolean true if valid date, semantic check only.
     */
    public static function checkDate($date, $separator = "-")
    {
        $dateArr = explode($separator, $date);
        return self::isValidDate($dateArr[0], $dateArr[1], $dateArr[2]);
    }

    /**
     * 检查是否有效的小时、分钟和秒.
     * @param integer $h hour
     * @param integer $m minute
     * @param integer $s second
     * @param boolean $hs24 whether the hours should be 0 through 23 (default) or 1 through 12.
     * @return boolean true if valid date, semantic check only.
     */
    public static function isValidTime($h, $m, $s, $hs24 = true)
    {
        if ($hs24 && ($h < 0 || $h > 23) || !$hs24 && ($h < 1 || $h > 12)) return false;
        if ($m > 59 || $m < 0) return false;
        if ($s > 59 || $s < 0) return false;
        return true;
    }

    /**
     * 检查时间是否合法时间
     * @param integer $time
     * @param string $separator
     * @return boolean true if valid date, semantic check only.
     * @since 1.0.5
     */
    public static function checkTime($time, $separator = ":")
    {
        $timeArr = explode($separator, $time);
        return self::isValidTime($timeArr[0], $timeArr[1], $timeArr[2]);
    }

    /**
     * 获得时间戳
     *
     * @param int $dateTime 默认为空，则以当前时间戳返回
     * @return int
     */
    public static function getTimeStamp($dateTime = null)
    {
        return $dateTime ? is_numeric($dateTime) ? $dateTime : strtotime($dateTime) : time();
    }

    /**
     * 格式化输出
     *
     * @param string $format 目标格式，默认为空则以Y-m-d H:i:s格式输出
     * @param int $dateTime Unix时间戳,默认为空则获取当前时间戳
     * @return string
     */
    public static function format($format = null, $dateTime = null)
    {
        return date($format ? $format : 'Y-m-d H:i:s', self::getTimeStamp($dateTime));
    }

    /**
     * 获取星期
     *
     * @param string $date 日期
     * @return int
     */
    public static function getWeekNum($date, $separator = "-")
    {
        $dateArr = explode($separator, $date);
        return date("w", mktime(0, 0, 0, $dateArr[1], $dateArr[2], $dateArr[0]));
    }

    /**
     * 获取星期
     *
     * @param int $week 星期，默认为当前时间获取
     * @return string
     */
    public static function getWeek($week = null)
    {
        $week = $week ? $week : self::format('w');
        $weekArr = array('星期天', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六');
        return $weekArr[$week];
    }

    /**
     * 判断是否为闰年
     *
     * @param int $year 年份，默认为当前年份
     * @return bool
     */
    public static function isLeapYear($year = null)
    {
        $year = $year ? $year : self::format('Y');
        return ($year % 4 == 0 && $year % 100 != 0 || $year % 400 == 0);
    }

    /**
     * 获取一年中有多少天
     * @param int $year 年份，默认为当前年份
     */
    public static function getDaysInYear($year = null)
    {
        $year = $year ? $year : self::format('Y');
        return self::isLeapYear($year) ? 366 : 365;
    }

    /**
     * 获取一天中的时段
     *
     * @param int $hour 小时，默认为当前小时
     * @return string
     */
    public static function getPeriodOfTime($hour = null)
    {
        $hour = $hour ? $hour : self::format('G');
        $period = null;
        if ($hour >= 0 && $hour < 6) {
            $period = '凌晨';
        } elseif ($hour >= 6 && $hour < 8) {
            $period = '早上';
        } elseif ($hour >= 8 && $hour < 11) {
            $period = '上午';
        } elseif ($hour >= 11 && $hour < 13) {
            $period = '中午';
        } elseif ($hour >= 13 && $hour < 15) {
            $period = '响午';
        } elseif ($hour >= 15 && $hour < 18) {
            $period = '下午';
        } elseif ($hour >= 18 && $hour < 20) {
            $period = '傍晚';
        } elseif ($hour >= 20 && $hour < 22) {
            $period = '晚上';
        } elseif ($hour >= 22 && $hour <= 23) {
            $period = '深夜';
        }
        return $period;
    }

    /*
     * 计算距离当前时间获取多少天
     *
     * dateline：要计算的时间线
     */
    public static function timeFromNow($dateline)
    {
        if (empty($dateline)) return false;
        $seconds = time() - $dateline;
        if ($seconds < 60) {
            return "1分钟前";
        } elseif ($seconds < 3600) {
            return floor($seconds / 60) . "分钟前";
        } elseif ($seconds < 24 * 3600) {
            return floor($seconds / 3600) . "小时前";
        } elseif ($seconds < 48 * 3600) {
            return date("昨天 H:i", $dateline) . "";
        } else {
            return date('Y-m-d', $dateline);
        }
    }

    /**
     * 日期数字转中文，适用于日、月、周
     * @param int $day 日期数字，默认为当前日期
     * @return string
     */
    public static function numberToChinese($number)
    {
        $chineseArr = array('一', '二', '三', '四', '五', '六', '七', '八', '九', '十');
        $chineseStr = null;
        if ($number < 10) {
            $chineseStr = $chineseArr[$number - 1];
        } elseif ($number < 20) {
            $chineseStr = '十' . $chineseArr[$number - 11];
        } elseif ($number < 30) {
            $chineseStr = '二十' . $chineseArr[$number - 21];
        } else {
            $chineseStr = '三十' . $chineseArr[$number - 31];
        }
        return $chineseStr;
    }

    /**
     * 年份数字转中文
     *
     * @param int $year 年份数字，默认为当前年份
     * @return string
     */
    public static function yearToChinese($year = null, $flag = false)
    {
        $year = $year ? intval($year) : self::format('Y');
        $data = array('零', '一', '二', '三', '四', '五', '六', '七', '八', '九');
        $chineseStr = null;
        for ($i = 0; $i < 4; $i++) {
            $chineseStr .= $data[substr($year, $i, 1)];
        }
        return $flag ? '公元' . $chineseStr : $chineseStr;
    }


    /**
     * 获取日期所属的星座、干支、生肖
     *
     * @param string $type 获取信息类型（SX：生肖、GZ：干支、XZ：星座）
     * @return string
     */
    public static function dateInfo($type, $date = null)
    {
        $year = self::format('Y', $date);
        $month = self::format('m', $date);
        $day = self::format('d', $date);
        $result = null;
        switch ($type) {
            case 'SX':
                $data = array('鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊', '猴', '鸡', '狗', '猪');
                $result = $data[($year - 4) % 12];
                break;
            case 'GZ':
                $data = array(
                    array('甲', '乙', '丙', '丁', '戊', '己', '庚', '辛', '壬', '癸'),
                    array('子', '丑', '寅', '卯', '辰', '巳', '午', '未', '申', '酉', '戌', '亥')
                );
                $num = $year - 1900 + 36;
                $result = $data[0][$num % 10] . $data[1][$num % 12];
                break;
            case 'XZ':
                $data = array('摩羯', '宝瓶', '双鱼', '白羊', '金牛', '双子', '巨蟹', '狮子', '处女', '天秤', '天蝎', '射手');
                $zone = array(1222, 122, 222, 321, 421, 522, 622, 722, 822, 922, 1022, 1122, 1222);
                if ((100 * $month + $day) >= $zone[0] || (100 * $month + $day) < $zone[1]) {
                    $i = 0;
                } else {
                    for ($i = 1; $i < 12; $i++) {
                        if ((100 * $month + $day) >= $zone[$i] && (100 * $month + $day) < $zone[$i + 1]) break;
                    }
                }
                $result = $data[$i] . '座';
                break;
        }
        return $result;
    }

    /*
     * 获取当前日期
     *
     * 格式：Y-m-d
     */
    public static function getToday()
    {
        return date("Y-m-d");
    }

    /*
     * 获取当前时间
     *
     * 格式：Y-m-d H:i:s
     */
    public static function getCurrentTime()
    {
        return date("Y-m-d H:i:s");
    }

    /*
     * 判断日期A是否早于日期B
     */
    public static function isDateAEarlierThanDateB($date_a, $date_b)
    {
        if (self::dateDiff('S', $date_a, $date_b) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * 判断日期A是否晚于日期B
     */
    public static function isDateALaterThanDateB($date_a, $date_b)
    {
        if (self::dateDiff('S', $date_a, $date_b) < 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取两个日期的差
     *
     * @param string $interval 日期差的间隔类型，（Y：年、M：月、W：星期、D：日期、H：时、N：分、S：秒）
     * @param int $startDateTime 开始日期
     * @param int $endDateTime 结束日期
     * @return int
     */
    public static function dateDiff($interval, $startDateTime, $endDateTime)
    {
        $diff = self::getTimeStamp($endDateTime) - self::getTimeStamp($startDateTime);
        switch ($interval) {
            case 'Y': //年
                $result = bcdiv($diff, 60 * 60 * 24 * 365);
                break;
            case 'M': //月
                $result = bcdiv($diff, 60 * 60 * 24 * 30);
                break;
            case 'W': //星期
                $result = bcdiv($diff, 60 * 60 * 24 * 7);
                break;
            case 'D': //日
                $result = bcdiv($diff, 60 * 60 * 24);
                break;
            case 'H': //时
                $result = bcdiv($diff, 60 * 60);
                break;
            case 'N': //分
                $result = bcdiv($diff, 60);
                break;
            case 'S': //秒
            default:
                $result = $diff;
                break;
        }
        return $result;
    }

    /**
     * 返回指定日期在一段时间间隔时间后的日期
     *
     * @param string $interval 时间间隔类型，（Y：年、Q：季度、M：月、W：星期、D：日期、H：时、N：分、S：秒）
     * @param int $value 时间间隔数值，数值为正数获取未来的时间，数值为负数获取过去的时间
     * @param string $dateTime 日期
     * @param string $format 返回的日期转换格式
     * @return string 返回追加后的日期
     */
    public static function dateAdd($interval, $value, $dateTime = null, $format = null)
    {
        $dateTime = $dateTime ? $dateTime : self::format();
        $date = getdate(self::getTimeStamp($dateTime));
        switch ($interval) {
            case 'Y': //年
                $date['year'] += $value;
                break;
            case 'Q': //季度
                $date['mon'] += ($value * 3);
                break;
            case 'M': //月
                $date['mon'] += $value;
                break;
            case 'W': //星期
                $date['mday'] += ($value * 7);
                break;
            case 'D': //日
                $date['mday'] += $value;
                break;
            case 'H': //时
                $date['hours'] += $value;
                break;
            case 'N': //分
                $date['minutes'] += $value;
                break;
            case 'S': //秒
            default:
                $date['seconds'] += $value;
                break;
        }
        return self::format($format, mktime($date['hours'], $date['minutes'], $date['seconds'], $date['mon'], $date['mday'], $date['year']));
    }

    /**
     * 根据年份获取每个月的天数
     *
     * @param int $year 年份
     * @return array 月份天数数组
     */
    public static function getDaysByMonthsOfYear($year = null)
    {
        $year = $year ? $year : self::format('Y');
        $months = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        if (self::isLeapYear($year)) $months[1] = 29;
        return $months;
    }

    /**
     * 返回某年的某个月有多少天
     *
     * @param int $month 月份
     * @param int $year 年份
     * @return int 月份天数
     */
    public static function getDaysByMonth($month, $year)
    {
        $months = self::getDaysByMonthsOfYear($year);
        $value = $months[$month - 1];
        return !$value ? 0 : $value;
    }

    /**
     * 获取年份的第一天
     *
     * @param int $year 年份
     * @param int $format 返回的日期格式
     * @return string 返回的日期
     */
    public static function firstDayOfYear($year = null, $format = 'Y-m-d')
    {
        $year = $year ? $year : self::format('Y');
        return self::format($format, mktime(0, 0, 0, 1, 1, $year));
    }

    /**
     * 获取年份最后一天
     *
     * @param int $year 年份
     * @param int $format 返回的日期格式
     * @return string 返回的日期
     */
    public static function lastDayOfYear($year = null, $format = 'Y-m-d')
    {
        $year = $year ? $year : self::format('Y');
        return self::format($format, mktime(0, 0, 0, 1, 0, $year + 1));
    }

    /**
     * 获取月份的第一天
     *
     * @param int $month 月份
     * @param int $year 年份
     * @param int $format 返回的日期格式
     * @return string 返回的日期
     */
    public static function firstDayOfMonth($month = null, $year = null, $format = 'Y-m-d')
    {
        $year = $year ? $year : self::format('Y');
        $month = $month ? $month : self::format('m');
        return self::format($format, mktime(0, 0, 0, $month, 1, $year));
    }

    /**
     * 获取月份最后一天
     *
     * @param int $month 月份
     * @param int $year 年份
     * @param int $format 返回的日期格式
     * @return string 返回的日期
     */
    public static function lastDayOfMonth($month = null, $year = null, $format = 'Y-m-d')
    {
        $year = $year ? $year : self::format('Y');
        $month = $month ? $month : self::format('m');
        return self::format($format, mktime(0, 0, 0, $month + 1, 0, $year));
    }

    /**
     * 获取两个日期之间范围
     *
     * @param string $startDateTime
     * @param string $endDateTime
     * @param string $format
     * @return array 返回日期数组
     */
    public static function getDayRangeInBetweenDate($startDateTime, $endDateTime, $sort = false, $format = 'Y-m-d')
    {
        $startDateTime = self::getTimeStamp($startDateTime);
        $endDateTime = self::getTimeStamp($endDateTime);
        $num = ($endDateTime - $startDateTime) / 86400;
        $dateArr = array();
        for ($i = 0; $i <= $num; $i++) {
            $dateArr[] = self::format($format, $startDateTime + 86400 * $i);
        }
        return $sort ? array_reverse($dateArr) : $dateArr;
    }

    /*
     *将时间拆成天，小时，分，秒
     *
     * By mtt
     *
     * 2018-8-16
     *
     * @param string $time   开始时间
     * @param string $end_time    结束时间
     */
    public static function dismantlingTime($time, $end_time)
    {
        $strtime = '';
        $time = $end_time - $time;
        if ($time >= 86400) {
            $strtime .= intval($time / 86400) . '天';
            $time = $time % 86400;
        } else {
            $strtime .= '';
        }
        if ($time >= 3600) {
            $strtime .= intval($time / 3600) . '小时';
            $time = $time % 3600;
        } else {
            $strtime .= '';
        }
        if ($time >= 60) {
            $strtime .= intval($time / 60) . '分钟';
            $time = $time % 60;
        } else {
            $strtime .= '';
        }
        if ($time >= 0) {
            $strtime .= intval($time) . '秒';
        } else {
            $strtime = "时间错误";
        }
        return $strtime;
    }

    /*
     * php计算两个时间戳之间相差的日时分秒
     * 功能：计算两个时间戳之间相差的日时分秒
     * $begin_time 开始时间戳
     * $end_time 结束时间戳
     *
     * By Ada
     *
     * 2019-01-11
     */
    public static function timeDiff($begin_time, $end_time)
    {
        if ($begin_time < $end_time) {
            $starttime = $begin_time;
            $endtime = $end_time;
        } else {
            $starttime = $end_time;
            $endtime = $begin_time;
        }
        //计算天数
        $timediff = $endtime - $starttime;
        $days = intval($timediff / 86400);
        //计算小时数
        $remain = $timediff % 86400;
        $hours = intval($remain / 3600);
        //计算分钟数
        $remain = $remain % 3600;
        $mins = intval($remain / 60);
        //计算秒数
        $secs = $remain % 60;
        $res = array("day" => $days, "hour" => $hours, "min" => $mins, "sec" => $secs);
        return $res;
    }

    /**
     * 计算两个日期相隔多少年，多少月，多少天
     *
     * @param string $date1 [格式如：2011-11-5]
     * @param string $date2 [格式如：2012-12-01]
     * @return array array('年','月','日');
     *
     * By Amy
     *
     * 2018-08-09
     */
    public static function diffDate($date1, $date2)
    {
        if (strtotime($date1) > strtotime($date2)) {
            $tmp = $date2;
            $date2 = $date1;
            $date1 = $tmp;
        }
        list($Y1, $m1, $d1) = explode('-', $date1);
        list($Y2, $m2, $d2) = explode('-', $date2);
        $Y = $Y2 - $Y1;
        $m = $m2 - $m1;
        $d = $d2 - $d1;
        if ($d < 0) {
            $d += (int)date('t', strtotime("-1 month $date2"));
            $m--;
        }
        if ($m < 0) {
            $m += 12;
            $Y--;
        }
        return array('year' => $Y, 'month' => $m, 'day' => $d);
    }


}