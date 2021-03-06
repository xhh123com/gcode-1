<?php

/**
 * Created by PhpStorm.
 * User: HappyQi
 * Date: 2017/9/28
 * Time: 10:30
 */

namespace App\Components\Common;

use App\Components\Project;
use Qiniu\Auth;
use Illuminate\Support\Facades\Storage;

class QNManager
{

    /*
     * 获取七牛upload token
     *
     * By TerryQi
     *
     */
    public static function uploadToken()
    {
        $accessKey = env('QINIU_ACCESS_KEY');
        $secretKey = env('QINIU_SECRET_KEY');
        $auth = new Auth($accessKey, $secretKey);
        $bucket = env('QINIU_BUCKET');
        $upToken = $auth->uploadToken($bucket);
        return $upToken;
    }

    /*
     * 上传文件
     *
     * By TerryQi
     *
     * 2018-12-26
     *
     * @return 如果上传成功返回七牛url，否则返回null
     */
    public static function upload($path, $fileContent)
    {
        $disk = Storage::disk('qiniu');
        $result = $disk->put($path, $fileContent);
        if ($result) {
//            return env("QINIU_DOMAIN") . "/" . $path;
            return Project::QI_NIU_DOMAIN . $path;
        } else {
            return null;
        }
    }

    /*
     * 获取音频文件的时长
     *
     * By TerryQi
     *
     * 2019-10-06
     *
     * param:audio_url音频路径
     *
     * return：返回数组
     */
    public static function getAudioInfo($audio_url)
    {
        $audio_info_url = $audio_url . "?avinfo";
        $info = Utils::curl($audio_info_url, [], 0, 0);
        Utils::processLog(__METHOD__, "", "info:" . json_encode($info));
        return json_decode($info, true);
    }

}
