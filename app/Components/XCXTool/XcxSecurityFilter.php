<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 8:59
 */

namespace App\Components\XCXTool;

use App\Components\DateTool;

class XcxSecurityFilter
{
    /*
     * 验证小程序的文字中是否合规
     *
     * By TerryQi
     *
     * 2020-01-09
     *
     * @param config：配置信息，即Project::XCX_ACCOUNT_CONFIG
     *          text：文本信息，即校验文字信息
     *
     * @return 文本是否合规 true/false
     *
     */
    public static function validatorText($config, $text)
    {
        $app = app($config);        //获取app
        $result = $app->content_security->checkText($text);
        if ($result['errcode'] != 0) {
            return false;
        }
        return true;
    }

    /*
     * 验证图片是否合规
     *
     * 2020-01-09
     *
     * By TerryQi
     *
     * @param config：配置信息，即Project::XCX_ACCOUNT_CONFIG
     *       img_url：图片url信息
     *
     * @return 文本是否合规 true/false
     *
     */
    public static function validatorImg($config, $img_url)
    {
        $app = app($config);        //获取app
        $ret = self::getImage($img_url, 'temporary/');
        $result = $app->content_security->checkImage($ret['save_path']);
        if ($result['errcode'] != 0) {
            return false;
        }
        return true;
    }

    /*
     * 验证图片数组是否合规
     *
     * By TerryQi
     *
     * @param config：配置信息，即Project::XCX_ACCOUNT_CONFIG
     *       img_urls_arr：图片url信息
     *
     * @return 文本是否合规 true/false
     */
    public static function validatorImgs($config, $img_urls_arr)
    {
        $app = app($config);        //获取app
        foreach ($img_urls_arr as $img_url) {
            $ret = self::getImage($img_url, 'temporary/');
            $result = $app->content_security->checkImage($ret['save_path']);
            if ($result['errcode'] != 0) {
                return false;
            }
        }
        return true;
    }


    /*
   * 功能：php完美实现下载远程图片保存到本地
   * 参数：文件url,保存文件目录,保存文件名称，使用的下载方式
   * 当保存文件名称为空时则使用远程文件原来的名称
   */
    public static function getImage($url, $save_dir = '', $filename = '', $type = 0)
    {
        if (trim($url) == '') {
            return array('file_name' => '', 'save_path' => '', 'error' => 1);
        }
        if (trim($save_dir) == '') {
            $save_dir = './';
        }
        if (trim($filename) == '') {//保存文件名
            $ext = strrchr($url, '.');
            if ($ext != '.gif' && $ext != '.jpg') {
                return array('file_name' => '', 'save_path' => '', 'error' => 3);
            }
            $filename = time() . $ext;
        }
        if (0 !== strrpos($save_dir, '/')) {
            $save_dir .= '/';
        }
        //创建保存目录
        if (!file_exists($save_dir) && !mkdir($save_dir, 0777, true)) {
            return array('file_name' => '', 'save_path' => '', 'error' => 5);
        }
        //获取远程文件所采用的方法
        if ($type) {
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $img = curl_exec($ch);
            curl_close($ch);
        } else {
            ob_start();
            readfile($url);
            $img = ob_get_contents();
            ob_end_clean();
        }
        //$size=strlen($img);
        //文件大小
        $fp2 = @fopen($save_dir . $filename, 'a');
        fwrite($fp2, $img);
        fclose($fp2);
        unset($img, $url);
        return array('file_name' => $filename, 'save_path' => $save_dir . $filename, 'error' => 0);
    }

}