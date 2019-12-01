<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class OffiAccountSpeechTempDoc
{
    private $collection_name = "offi_account_speech_temp";       //mongodb的collection名称

    private $temp_id;          //自定义话术模板的id，一般可以是TEMPLATE_USER_SUBSCRIBE（订阅）、TEMPLATE_USER_UNSUBSCRIBE（取消订阅）
    private $temp_name;       //模板名称
    private $type = 0;      //模板类型；0：text；1：image；2：voice；3：video；4：thumb；
    private $content;       //文本消息内容；
    private $media_id;          //素材编号；media_id、view_limited类型必须；调用新增永久素材接口返回的合法media_id；
    private $thumb_media_id;        //视频消息；
    private $title;     //标题
    private $intro;     //介绍
    private $img;     //图片
    private $url;     //链接
    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}