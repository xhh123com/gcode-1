<?php


/**
 * Created by PhpStorm.
 * User: mtt17
 * Date: 2018/4/9
 * Time: 11:32
 */

namespace App\Components;


use App\Components\Common\Utils;
use App\Models\Coupon;
use App\Components\Redis\RedisManager;

//V3版本的manager层，在V2版本的基础上，进一步结合redis
class CouponManager
{

    /*
     * getById
     *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:39
     */
    public static function getById($id)
    {
        $info = Coupon::where('id', $id)->first();
        return $info;
    }

    /*
    * getByIdWithTrashed
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:39
    */
    public static function getByIdWithTrashed($id)
    {
        $info = Coupon::withTrashed()->where('id', $id)->first();
        return $info;
    }

    /*
    * deleteById
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:39
    */
    public static function deleteById($id)
    {
        $info = self::getById($id);
        $result = $info->delete();
        RedisManager::del("coupon:" . $info->id);
        return $result;
    }


    /*
    * save
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:39
    */
    public static function save($info,$refresh_redis=0)
    {
        $result = $info->save();

        //进行redis的刷新
        if($refresh_redis==1){
            RedisManager::del("coupon:" . $info->id);
        }
        return $result;
    }


    /*
     * getInfoByLevel
     *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:39
     *
     */
    public static function getInfoByLevel($info, $level)
    {
        $level_arr = explode(',', $level);

        $info->status_str = Utils::COMMON_STATUS_VAL[$info->status];

        //0:
        if (in_array('0', $level_arr)) {

        }
        //1:
        if (in_array('1', $level_arr)) {

        }
        //2:
        if (in_array('2', $level_arr)) {

        }

        //X:        脱敏
        if (strpos($level, 'X') !== false) {

        }
        //Y:        压缩，去掉content_html等大报文信息
        if (strpos($level, 'Y') !== false) {
            unset($info->content_html);
            unset($info->seq);
            unset($info->status);
            unset($info->updated_at);
            unset($info->deleted_at);
        }
        //Z:        预留
        if (strpos($level, 'Z') !== false) {

        }


        return $info;
    }

    /*
     * getListByCon
     *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:39
     */
    public static function getListByCon($con_arr, $is_paginate)
    {
        $infos = new Coupon();

        if (array_key_exists('search_word', $con_arr) && !Utils::isObjNull($con_arr['search_word'])) {
            $keyword = $con_arr['search_word'];
            $infos = $infos->where(function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            });
        }

        if (array_key_exists('ids_arr', $con_arr) && !empty($con_arr['ids_arr'])) {
            $infos = $infos->wherein('id', $con_arr['ids_arr']);
        }

    
        if (array_key_exists('id', $con_arr) && !Utils::isObjNull($con_arr['id'])) {
            $infos = $infos->where('id', '=', $con_arr['id']);
        }
    
        if (array_key_exists('name', $con_arr) && !Utils::isObjNull($con_arr['name'])) {
            $infos = $infos->where('name', '=', $con_arr['name']);
        }
    
        if (array_key_exists('img', $con_arr) && !Utils::isObjNull($con_arr['img'])) {
            $infos = $infos->where('img', '=', $con_arr['img']);
        }
    
        if (array_key_exists('product_id', $con_arr) && !Utils::isObjNull($con_arr['product_id'])) {
            $infos = $infos->where('product_id', '=', $con_arr['product_id']);
        }
    
        if (array_key_exists('sub_product_id', $con_arr) && !Utils::isObjNull($con_arr['sub_product_id'])) {
            $infos = $infos->where('sub_product_id', '=', $con_arr['sub_product_id']);
        }
    
        if (array_key_exists('desc', $con_arr) && !Utils::isObjNull($con_arr['desc'])) {
            $infos = $infos->where('desc', '=', $con_arr['desc']);
        }
    
        if (array_key_exists('content_html', $con_arr) && !Utils::isObjNull($con_arr['content_html'])) {
            $infos = $infos->where('content_html', '=', $con_arr['content_html']);
        }
    
        if (array_key_exists('show_price', $con_arr) && !Utils::isObjNull($con_arr['show_price'])) {
            $infos = $infos->where('show_price', '=', $con_arr['show_price']);
        }
    
        if (array_key_exists('type', $con_arr) && !Utils::isObjNull($con_arr['type'])) {
            $infos = $infos->where('type', '=', $con_arr['type']);
        }
    
        if (array_key_exists('value', $con_arr) && !Utils::isObjNull($con_arr['value'])) {
            $infos = $infos->where('value', '=', $con_arr['value']);
        }
    
        if (array_key_exists('total_num', $con_arr) && !Utils::isObjNull($con_arr['total_num'])) {
            $infos = $infos->where('total_num', '=', $con_arr['total_num']);
        }
    
        if (array_key_exists('send_num', $con_arr) && !Utils::isObjNull($con_arr['send_num'])) {
            $infos = $infos->where('send_num', '=', $con_arr['send_num']);
        }
    
        if (array_key_exists('left_num', $con_arr) && !Utils::isObjNull($con_arr['left_num'])) {
            $infos = $infos->where('left_num', '=', $con_arr['left_num']);
        }
    
        if (array_key_exists('valid_start_time', $con_arr) && !Utils::isObjNull($con_arr['valid_start_time'])) {
            $infos = $infos->where('valid_start_time', '=', $con_arr['valid_start_time']);
        }
    
        if (array_key_exists('valid_end_time', $con_arr) && !Utils::isObjNull($con_arr['valid_end_time'])) {
            $infos = $infos->where('valid_end_time', '=', $con_arr['valid_end_time']);
        }
    
        if (array_key_exists('valid_status', $con_arr) && !Utils::isObjNull($con_arr['valid_status'])) {
            $infos = $infos->where('valid_status', '=', $con_arr['valid_status']);
        }
    
        if (array_key_exists('seq', $con_arr) && !Utils::isObjNull($con_arr['seq'])) {
            $infos = $infos->where('seq', '=', $con_arr['seq']);
        }
    
        if (array_key_exists('status', $con_arr) && !Utils::isObjNull($con_arr['status'])) {
            $infos = $infos->where('status', '=', $con_arr['status']);
        }
    
        if (array_key_exists('created_at', $con_arr) && !Utils::isObjNull($con_arr['created_at'])) {
            $infos = $infos->where('created_at', '=', $con_arr['created_at']);
        }
    
        if (array_key_exists('updated_at', $con_arr) && !Utils::isObjNull($con_arr['updated_at'])) {
            $infos = $infos->where('updated_at', '=', $con_arr['updated_at']);
        }
    
        if (array_key_exists('deleted_at', $con_arr) && !Utils::isObjNull($con_arr['deleted_at'])) {
            $infos = $infos->where('deleted_at', '=', $con_arr['deleted_at']);
        }
    
        //排序设定
        if (array_key_exists('orderby', $con_arr) && is_array($con_arr['orderby'])) {
            $orderby_arr = $con_arr['orderby'];
            //例子，传入数据样式为'status'=>'desc'
            if (array_key_exists('status', $orderby_arr) && !Utils::isObjNull($orderby_arr['status'])) {
                $infos = $infos->orderby('status', $orderby_arr['status']);
            }
            //如果传入random，代表要随机获取
            if (array_key_exists('random', $orderby_arr) && !Utils::isObjNull($orderby_arr['random'])) {
                $infos = $infos->inRandomOrder();
            }
        }
        $infos = $infos->orderby('seq', 'desc')->orderby('id', 'desc');

        //分页设定
        if ($is_paginate) {
            $page_size = Utils::PAGE_SIZE;
            //如果con_arr中有page_size信息
            if (array_key_exists('page_size', $con_arr) && !Utils::isObjNull($con_arr['page_size'])) {
                $page_size = $con_arr['page_size'];
            }
            $infos = $infos->paginate($page_size);
        }
        else {
            //如果con_arr中有page_size信息 2019-10-08优化，可以不分页也获取多条数据
            if (array_key_exists('page_size', $con_arr) && !Utils::isObjNull($con_arr['page_size'])) {
                $page_size = $con_arr['page_size'];
                $infos = $infos->take($page_size);
            }
            $infos = $infos->get();
        }
        return $infos;
    }

    /*
     * setInfo
     *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:39
     */
    public static function setInfo($info, $data,$level=0)
    {
        //0级信息配置
        if( $level >= 0){
        }

        //1级信息配置
        if( $level >= 1){
        }

        //2级信息配置
        if( $level >= 2){
        }

        
        if (array_key_exists('id', $data)) {
                $info->id = $data['id'];
            }
        
        if (array_key_exists('name', $data)) {
                $info->name = $data['name'];
            }
        
        if (array_key_exists('img', $data)) {
                $info->img = $data['img'];
            }
        
        if (array_key_exists('product_id', $data)) {
                $info->product_id = $data['product_id'];
            }
        
        if (array_key_exists('sub_product_id', $data)) {
                $info->sub_product_id = $data['sub_product_id'];
            }
        
        if (array_key_exists('desc', $data)) {
                $info->desc = $data['desc'];
            }
        
        if (array_key_exists('content_html', $data)) {
                $info->content_html = $data['content_html'];
            }
        
        if (array_key_exists('show_price', $data)) {
                $info->show_price = $data['show_price'];
            }
        
        if (array_key_exists('type', $data)) {
                $info->type = $data['type'];
            }
        
        if (array_key_exists('value', $data)) {
                $info->value = $data['value'];
            }
        
        if (array_key_exists('total_num', $data)) {
                $info->total_num = $data['total_num'];
            }
        
        if (array_key_exists('send_num', $data)) {
                $info->send_num = $data['send_num'];
            }
        
        if (array_key_exists('left_num', $data)) {
                $info->left_num = $data['left_num'];
            }
        
        if (array_key_exists('valid_start_time', $data)) {
                $info->valid_start_time = $data['valid_start_time'];
            }
        
        if (array_key_exists('valid_end_time', $data)) {
                $info->valid_end_time = $data['valid_end_time'];
            }
        
        if (array_key_exists('valid_status', $data)) {
                $info->valid_status = $data['valid_status'];
            }
        
        if (array_key_exists('seq', $data)) {
                $info->seq = $data['seq'];
            }
        
        if (array_key_exists('status', $data)) {
                $info->status = $data['status'];
            }
        
        if (array_key_exists('created_at', $data)) {
                $info->created_at = $data['created_at'];
            }
        
        if (array_key_exists('updated_at', $data)) {
                $info->updated_at = $data['updated_at'];
            }
        
        if (array_key_exists('deleted_at', $data)) {
                $info->deleted_at = $data['deleted_at'];
            }
        
        return $info;
    }

    /*
    * 统一封装数量操作，部分对象涉及数量操作，例如产品销售，剩余数等，统一通过该方法封装
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:39
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
        $info = self::save($info);
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

