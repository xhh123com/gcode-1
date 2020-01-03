<?php


/**
 * Created by PhpStorm.
 * User: mtt17
 * Date: 2018/4/9
 * Time: 11:32
 */

namespace App\Components;


use App\Components\Common\Utils;
use App\Models\ShopClerkLogin;

class ShopClerkLoginManager
{

    /*
     * getById
     *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:46
     */
    public static function getById($id)
    {
        $info = ShopClerkLogin::where('id', $id)->first();
        return $info;
    }

    /*
    * getByIdWithTrashed
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:46
    */
    public static function getByIdWithTrashed($id)
    {
        $info = ShopClerkLogin::withTrashed()->where('id', $id)->first();
        return $info;
    }

    /*
    * deleteById
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:46
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
    * 2020-01-03 02:14:46
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
    * 2020-01-03 02:14:46
     *
     */
    public static function getInfoByLevel($info, $level)
    {
        $info->status_str = Utils::COMMON_STATUS_VAL[$info->status];

        //0:
        if (strpos($level, '0') !== false) {

        }
        //1:
        if (strpos($level, '1') !== false) {

        }
        //2:
        if (strpos($level, '2') !== false) {

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
    * 2020-01-03 02:14:46
     */
    public static function getListByCon($con_arr, $is_paginate)
    {
        $infos = new ShopClerkLogin();

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
    
        if (array_key_exists('shop_clerk_id', $con_arr) && !Utils::isObjNull($con_arr['shop_clerk_id'])) {
            $infos = $infos->where('shop_clerk_id', '=', $con_arr['shop_clerk_id']);
        }
    
        if (array_key_exists('token', $con_arr) && !Utils::isObjNull($con_arr['token'])) {
            $infos = $infos->where('token', '=', $con_arr['token']);
        }
    
        if (array_key_exists('account_type', $con_arr) && !Utils::isObjNull($con_arr['account_type'])) {
            $infos = $infos->where('account_type', '=', $con_arr['account_type']);
        }
    
        if (array_key_exists('ve_value1', $con_arr) && !Utils::isObjNull($con_arr['ve_value1'])) {
            $infos = $infos->where('ve_value1', '=', $con_arr['ve_value1']);
        }
    
        if (array_key_exists('ve_value2', $con_arr) && !Utils::isObjNull($con_arr['ve_value2'])) {
            $infos = $infos->where('ve_value2', '=', $con_arr['ve_value2']);
        }
    
        if (array_key_exists('login_at', $con_arr) && !Utils::isObjNull($con_arr['login_at'])) {
            $infos = $infos->where('login_at', '=', $con_arr['login_at']);
        }
    
        if (array_key_exists('valid_at', $con_arr) && !Utils::isObjNull($con_arr['valid_at'])) {
            $infos = $infos->where('valid_at', '=', $con_arr['valid_at']);
        }
    
        if (array_key_exists('status', $con_arr) && !Utils::isObjNull($con_arr['status'])) {
            $infos = $infos->where('status', '=', $con_arr['status']);
        }
    
        if (array_key_exists('seq', $con_arr) && !Utils::isObjNull($con_arr['seq'])) {
            $infos = $infos->where('seq', '=', $con_arr['seq']);
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
    * 2020-01-03 02:14:46
     */
    public static function setInfo($info, $data)
    {

        
        if (array_key_exists('id', $data)) {
                $info->id = $data['id'];
            }
        
        if (array_key_exists('shop_clerk_id', $data)) {
                $info->shop_clerk_id = $data['shop_clerk_id'];
            }
        
        if (array_key_exists('token', $data)) {
                $info->token = $data['token'];
            }
        
        if (array_key_exists('account_type', $data)) {
                $info->account_type = $data['account_type'];
            }
        
        if (array_key_exists('ve_value1', $data)) {
                $info->ve_value1 = $data['ve_value1'];
            }
        
        if (array_key_exists('ve_value2', $data)) {
                $info->ve_value2 = $data['ve_value2'];
            }
        
        if (array_key_exists('login_at', $data)) {
                $info->login_at = $data['login_at'];
            }
        
        if (array_key_exists('valid_at', $data)) {
                $info->valid_at = $data['valid_at'];
            }
        
        if (array_key_exists('status', $data)) {
                $info->status = $data['status'];
            }
        
        if (array_key_exists('seq', $data)) {
                $info->seq = $data['seq'];
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
    * 2020-01-03 02:14:46
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

