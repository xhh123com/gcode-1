<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class OffiAccountMenuDoc
{
    private $collection_name = "offi_account_menu";       //mongodb的collection名称

    private $is_sub;          //是否拥有二级菜单 0：没有二级菜单 1：有二级菜单
    private $p_id = 0;       //上级编号；默认为0；没有上级；
    private $name;      //菜单名称
    //关于type的具体信息详见开发者文档 https://developers.weixin.qq.com/doc/offiaccount/Custom_Menus/Creating_Custom-Defined_Menu.html
    private $type = 'view';      //响应类型；1：click；2：view；3：scancode_push；4：scancode_waitmsg；5：pic_sysphoto；6：pic_photo_or_album；7：pic_weixin；8：location_select；9：media_id；10：view_limited；11：miniprogram；
    private $key_value;       //菜单KEY值；click等点击类型必须；用于消息接口推送；
    private $url;          //链接；view、miniprogram类型必须；用户点击菜单可打开链接；
    private $media_id;          //素材编号；media_id、view_limited类型必须；调用新增永久素材接口返回的合法media_id；
    private $page_path;        //页面链接；
    private $app_id;        //应用id，一般是指小程序的id
    private $seq = 99;        //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}