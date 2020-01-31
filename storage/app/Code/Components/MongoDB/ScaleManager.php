<?php


/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/9
* Time: 11:32
*/

namespace App\Components;


use App\Components\Common\Utils;
use App\MongoDB\Models\Doc\ScaleDoc;
use App\MongoDB\Models\Scale;
use Illuminate\Support\Facades\DB;

//该版本Manager主要支持MongoDB的数据模型
class ScaleManager
{


    /*
    * getById
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:36
    */
    public static function getById($_id)
    {

        $info = Scale::where('_id', $_id)->first();
        return $info;
    }


    /*
    * getByIdWithTrashed
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:36
    */
    public static function getByIdWithTrashed($_id)
    {
        $info = Scale::withTrashed()->where('_id', $_id)->first();
        return $info;
    }

    /*
    * deleteById
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:36
    */
    public static function deleteById($id)
    {
        $info = self::getById($id);
        $result = $info->delete();
        return $result;
    }


    /*
    * save
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:36
    */
    public static function save($info)
    {
        $result = $info->save();
        return $result;
    }


    /*
    * getInfoByLevel
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:36
    *
    */
    public static function getInfoByLevel($info, $level)
    {
        $level_arr = explode(',', $level);

        $info->id = $info->_id;
        $info->status_str = Utils::COMMON_STATUS_VAL[$info->status];

        //图片转数组，2020-01-19 TerryQi补充了img转数组，img一般定义为图片链接，多张图片用逗号分隔
        if ($info->img) {
            $info->img_arr = explode(",", $info->img);
        }

        //0:
        if (in_array('0', $level_arr)) {

        }
        //1:
        if (in_array('1', $level_arr)) {

        }
        //2:
        if (in_array('2', $level_arr)) {

        }

        //X: 脱敏
        if (strpos($level, 'X') !== false) {

        }
        //Y: 压缩，去掉content_html等大报文信息
        if (strpos($level, 'Y') !== false) {
        unset($info->content_html);
        unset($info->seq);
        unset($info->status);
        unset($info->updated_at);
        unset($info->deleted_at);
        }
        //Z: 预留
        if (strpos($level, 'Z') !== false) {

        }


        return $info;
    }

    /*
    * getListByCon
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:36
    */
    public static function getListByCon($con_arr, $is_paginate, $page = 1)
    {
        $infos = new Scale();

        if (array_key_exists('search_word', $con_arr) && !Utils::isObjNull($con_arr['search_word'])) {
        $keyword = $con_arr['search_word'];
        $infos = $infos->where(function ($query) use ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
            });
        }

        if (array_key_exists('_ids_arr', $con_arr) && !empty($con_arr['_ids_arr'])) {
            $infos = $infos->wherein('_id', $con_arr['_ids_arr']);
        }


        if (array_key_exists('_id', $con_arr) && !Utils::isObjNull($con_arr['_id'])) {
            $infos = $infos->where('_id', '=', $con_arr['_id']);
        }

    
        if (array_key_exists('collection_name', $con_arr) && !Utils::isObjNull($con_arr['collection_name'])) {
        $infos = $infos->where('collection_name', '=', $con_arr['collection_name']);
        }
    
        if (array_key_exists('admin_id', $con_arr) && !Utils::isObjNull($con_arr['admin_id'])) {
        $infos = $infos->where('admin_id', '=', $con_arr['admin_id']);
        }
    
        if (array_key_exists('name', $con_arr) && !Utils::isObjNull($con_arr['name'])) {
        $infos = $infos->where('name', '=', $con_arr['name']);
        }
    
        if (array_key_exists('sign_name', $con_arr) && !Utils::isObjNull($con_arr['sign_name'])) {
        $infos = $infos->where('sign_name', '=', $con_arr['sign_name']);
        }
    
        if (array_key_exists('intro', $con_arr) && !Utils::isObjNull($con_arr['intro'])) {
        $infos = $infos->where('intro', '=', $con_arr['intro']);
        }
    
        if (array_key_exists('seq', $con_arr) && !Utils::isObjNull($con_arr['seq'])) {
        $infos = $infos->where('seq', '=', $con_arr['seq']);
        }
    
        if (array_key_exists('status', $con_arr) && !Utils::isObjNull($con_arr['status'])) {
        $infos = $infos->where('status', '=', $con_arr['status']);
        }
    
    //排序设定
    if (array_key_exists('orderby', $con_arr) && is_array($con_arr['orderby'])) {
        $orderby_arr = $con_arr['orderby'];
        //例子，传入数据样式为'status'=>'desc'
        if (array_key_exists('status', $orderby_arr) && !Utils::isObjNull($orderby_arr['status'])) {
            $infos = $infos->orderby('status', $orderby_arr['status']);
        }
    }
    $infos = $infos->orderby('seq', 'desc')->orderby('created_at', 'desc');

    //分页设定
    if ($is_paginate) {
        $page_size = Utils::PAGE_SIZE;
        //如果con_arr中有page_size信息
        if (array_key_exists('page_size', $con_arr) && !Utils::isObjNull($con_arr['page_size'])) {
            $page_size = $con_arr['page_size'];
        }
        $infos = $infos->skip(($page - 1) * $page_size)->paginate($page_size);
    }
    else {
        //如果con_arr中有page_size信息 2019-10-08优化，可以不分页也获取多条数据
        if (array_key_exists('page_size', $con_arr) && !Utils::isObjNull($con_arr['page_size'])) {
            $page_size = $con_arr['page_size'];
            $infos = $infos->take($page_size);
        }
            $infos = $infos->get();
        }

        //如果传入random，代表要随机获取，其中random->3代表获取3个随机数据
        //请注意，random是预留字段，数据库中不允许设定字段名叫做random
        if (array_key_exists('random', $con_arr) && !Utils::isObjNull($con_arr['random'])) {
            $infos = $infos->random($con_arr['random']);
        }

        return $infos;
    }

/*
* setInfo
*
* By Auto CodeCreator
*
* 2020-01-30 11:20:36
*/
public static function setInfo($info, $data)
{
    $ref = new \ReflectionClass(ScaleDoc::class);

    //编辑情况，不处理data，$data有id或者$info->_id不为空
    if ($info->_id != null) {

    } else {
    //新建情况，处理data
        $class_arr = $ref->getDefaultProperties();
        unset($class_arr['collection_name']);
        $data = array_merge($class_arr, $data);
    }

    
            if (array_key_exists('collection_name', $data)) {
    $info->collection_name = $data['collection_name'];
    }
        
    
            if (array_key_exists('admin_id', $data)) {
    $info->admin_id = $data['admin_id'];
    }
        
    
            if (array_key_exists('name', $data)) {
    $info->name = $data['name'];
    }
        
    
            if (array_key_exists('sign_name', $data)) {
    $info->sign_name = $data['sign_name'];
    }
        
    
            if (array_key_exists('intro', $data)) {
    $info->intro = $data['intro'];
    }
        
    
            if (array_key_exists('seq', $data)) {
    $info->seq = intval($data['seq']);
    }
        
    
            if (array_key_exists('status', $data)) {
    $info->status = $data['status'];
    }
        
    
    return $info;
}

    /*
    * 统一封装数量操作，部分对象涉及数量操作，例如产品销售，剩余数等，统一通过该方法封装
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:36
    *
    * @param  id：对象id item：操作对象 num：加减数值
    */
    public static function setNum($id, $item, $num)
    {
        $info = self::getById($id);
        switch ($item) {
            case "show_num":
            $info->show_num = $info->show_num + $num;
            break;
            case "left_num":
            $info->left_num = $info->left_num + $num;
            break;
            case "send_num":
            $info->send_num = $info->send_num + $num;
            break;
        }
        $info->save();
        return $info;
    }

    /*
    * 获取最近的一条信息
    *
    * By TerryQi
    *
    */
    public static function getLatest()
    {
        $info = self::getListByCon(['status' => '1'], false)->first();
        return $info;
    }

}

