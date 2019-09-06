<?php


/**
 * Created by PhpStorm.
 * User: mtt17
 * Date: 2018/4/9
 * Time: 11:32
 */

namespace App\Components;


use App\Components\Common\Utils;
use App\Components\Redis\RedisManager;
use App\Models\UserLogin;

//V2版本的manager层，主要优化了getInfoByLevel，其中level需要传入1,3,5这样的形式，更加灵活和合理
class UserLoginManager
{

    /*
     * getById
     *
    * By Auto CodeCreator
    *
    * 2019-08-15 12:07:57
     */
    public static function getById($id)
    {
        $info = UserLogin::where('id', $id)->first();
        return $info;
    }

    /*
    * getByIdWithTrashed
    *
    * By Auto CodeCreator
    *
    * 2019-08-15 12:07:57
    */
    public static function getByIdWithTrashed($id)
    {
        $info = UserLogin::withTrashed()->where('id', $id)->first();
        return $info;
    }

    /*
    * deleteById
    *
    * By Auto CodeCreator
    *
    * 2019-08-15 12:07:57
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
     * 2019-08-18 17:16:08
     */
    public static function save($info, $refresh_redis = 0)
    {
        $result = $info->save();

        //进行redis的刷新
        if ($refresh_redis == 1) {

        }
        return $result;
    }


    /*
     * getInfoByLevel
     *
    * By Auto CodeCreator
    *
    * 2019-08-15 12:07:57
     *
     */
    public static function getInfoByLevel($info, $level)
    {
        $level_arr = explode(',', $level);

        $info->status_str = Utils::COMMON_STATUS_VAL[$info->status];
        $info->account_type_str = Utils::ACCOUNT_TYPE_VAL[$info->account_type];

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
    * 2019-08-15 12:07:57
     */
    public static function getListByCon($con_arr, $is_paginate)
    {
        $infos = new UserLogin();

        if (array_key_exists('search_word', $con_arr) && !Utils::isObjNull($con_arr['search_word'])) {
            $keyword = $con_arr['search_word'];
            $infos = $infos->where(function ($query) use ($keyword) {
                $query->where('nick_name', 'like', "%{$keyword}%")
                    ->where('code', 'like', "%{$keyword}%")
                    ->where('phonenum', 'like', "%{$keyword}%");
            });
        }

        if (array_key_exists('ids_arr', $con_arr) && !empty($con_arr['ids_arr'])) {
            $infos = $infos->wherein('id', $con_arr['ids_arr']);
        }


        if (array_key_exists('id', $con_arr) && !Utils::isObjNull($con_arr['id'])) {
            $infos = $infos->where('id', '=', $con_arr['id']);
        }

        if (array_key_exists('user_id', $con_arr) && !Utils::isObjNull($con_arr['user_id'])) {
            $infos = $infos->where('user_id', '=', $con_arr['user_id']);
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

        if (array_key_exists('valid_time', $con_arr) && !Utils::isObjNull($con_arr['valid_time'])) {
            $infos = $infos->where('valid_time', '=', $con_arr['valid_time']);
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
        } else {
            $infos = $infos->get();
        }
        return $infos;
    }

    /*
     * setInfo
     *
    * By Auto CodeCreator
    *
    * 2019-08-15 12:07:57
     */
    public static function setInfo($info, $data)
    {


        if (array_key_exists('id', $data)) {
            $info->id = $data['id'];
        }

        if (array_key_exists('user_id', $data)) {
            $info->user_id = $data['user_id'];
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

        if (array_key_exists('valid_time', $data)) {
            $info->valid_time = $data['valid_time'];
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
    * 2019-08-15 12:07:57
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
     * 校验token
     *
     * @param token，传入的access_token
     *
     * @return user_login对象
     *
     * By TerryQi
     *
     * 2019-08-17
     */
    public static function checkToken($token)
    {
        //先从redis中获取信息
        $user_login = RedisManager::get("user:token:" . $token);
        Utils::processLog(__METHOD__, "", "通过redis校验token user_login:" . json_encode($user_login));
        //如果获取失败，则通过mysql进行获取
        if (Utils::isObjNull($user_login)) {
            //根据token获取用户登录信息
            $user_login = self::getListByCon(['token' => $token], false)->first();
            Utils::processLog(__METHOD__, "", "通过mysql校验token user_login:" . json_encode($user_login));
            if ($user_login) {
                //存在用户信息，则写入redis，下次校验即可通过redis进行校验，提升校验效率
                $result = RedisManager::setex("user:token:" . $token, $user_login);
                Utils::processLog(__METHOD__, "", "将token信息写入redis result:" . json_encode($result));
            }
        }
        return $user_login;
    }


}

