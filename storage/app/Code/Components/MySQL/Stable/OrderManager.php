<?php


/**
 * Created by PhpStorm.
 * User: mtt17
 * Date: 2018/4/9
 * Time: 11:32
 */

namespace App\Components;


use App\Components\Common\Utils;
use App\Models\Order;

//V2版本的manager层，主要优化了getInfoByLevel，其中level需要传入1,3,5这样的形式，更加灵活和合理
class OrderManager
{

    /*
     * getById
     *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:40
     */
    public static function getById($id)
    {
        $info = Order::where('id', $id)->first();
        return $info;
    }

    /*
    * getByIdWithTrashed
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:40
    */
    public static function getByIdWithTrashed($id)
    {
        $info = Order::withTrashed()->where('id', $id)->first();
        return $info;
    }

    /*
    * deleteById
    *
    * By Auto CodeCreator
    *
    * 2020-01-03 02:14:40
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
    * 2020-01-03 02:14:40
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
    * 2020-01-03 02:14:40
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
    * 2020-01-03 02:14:40
     */
    public static function getListByCon($con_arr, $is_paginate)
    {
        $infos = new Order();

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
    
        if (array_key_exists('trade_no', $con_arr) && !Utils::isObjNull($con_arr['trade_no'])) {
            $infos = $infos->where('trade_no', '=', $con_arr['trade_no']);
        }
    
        if (array_key_exists('prepay_id', $con_arr) && !Utils::isObjNull($con_arr['prepay_id'])) {
            $infos = $infos->where('prepay_id', '=', $con_arr['prepay_id']);
        }
    
        if (array_key_exists('pay_shop_store_id', $con_arr) && !Utils::isObjNull($con_arr['pay_shop_store_id'])) {
            $infos = $infos->where('pay_shop_store_id', '=', $con_arr['pay_shop_store_id']);
        }
    
        if (array_key_exists('product_id', $con_arr) && !Utils::isObjNull($con_arr['product_id'])) {
            $infos = $infos->where('product_id', '=', $con_arr['product_id']);
        }
    
        if (array_key_exists('sub_product_id', $con_arr) && !Utils::isObjNull($con_arr['sub_product_id'])) {
            $infos = $infos->where('sub_product_id', '=', $con_arr['sub_product_id']);
        }
    
        if (array_key_exists('product_num', $con_arr) && !Utils::isObjNull($con_arr['product_num'])) {
            $infos = $infos->where('product_num', '=', $con_arr['product_num']);
        }
    
        if (array_key_exists('user_id', $con_arr) && !Utils::isObjNull($con_arr['user_id'])) {
            $infos = $infos->where('user_id', '=', $con_arr['user_id']);
        }
    
        if (array_key_exists('a_user_id', $con_arr) && !Utils::isObjNull($con_arr['a_user_id'])) {
            $infos = $infos->where('a_user_id', '=', $con_arr['a_user_id']);
        }
    
        if (array_key_exists('type', $con_arr) && !Utils::isObjNull($con_arr['type'])) {
            $infos = $infos->where('type', '=', $con_arr['type']);
        }
    
        if (array_key_exists('score_fee', $con_arr) && !Utils::isObjNull($con_arr['score_fee'])) {
            $infos = $infos->where('score_fee', '=', $con_arr['score_fee']);
        }
    
        if (array_key_exists('total_fee', $con_arr) && !Utils::isObjNull($con_arr['total_fee'])) {
            $infos = $infos->where('total_fee', '=', $con_arr['total_fee']);
        }
    
        if (array_key_exists('cash_fee', $con_arr) && !Utils::isObjNull($con_arr['cash_fee'])) {
            $infos = $infos->where('cash_fee', '=', $con_arr['cash_fee']);
        }
    
        if (array_key_exists('purse_fee', $con_arr) && !Utils::isObjNull($con_arr['purse_fee'])) {
            $infos = $infos->where('purse_fee', '=', $con_arr['purse_fee']);
        }
    
        if (array_key_exists('settle_fee', $con_arr) && !Utils::isObjNull($con_arr['settle_fee'])) {
            $infos = $infos->where('settle_fee', '=', $con_arr['settle_fee']);
        }
    
        if (array_key_exists('user_coupon_id', $con_arr) && !Utils::isObjNull($con_arr['user_coupon_id'])) {
            $infos = $infos->where('user_coupon_id', '=', $con_arr['user_coupon_id']);
        }
    
        if (array_key_exists('coupon_fee', $con_arr) && !Utils::isObjNull($con_arr['coupon_fee'])) {
            $infos = $infos->where('coupon_fee', '=', $con_arr['coupon_fee']);
        }
    
        if (array_key_exists('content', $con_arr) && !Utils::isObjNull($con_arr['content'])) {
            $infos = $infos->where('content', '=', $con_arr['content']);
        }
    
        if (array_key_exists('remark', $con_arr) && !Utils::isObjNull($con_arr['remark'])) {
            $infos = $infos->where('remark', '=', $con_arr['remark']);
        }
    
        if (array_key_exists('pay_status', $con_arr) && !Utils::isObjNull($con_arr['pay_status'])) {
            $infos = $infos->where('pay_status', '=', $con_arr['pay_status']);
        }
    
        if (array_key_exists('pay_at', $con_arr) && !Utils::isObjNull($con_arr['pay_at'])) {
            $infos = $infos->where('pay_at', '=', $con_arr['pay_at']);
        }
    
        if (array_key_exists('refund_trade_no', $con_arr) && !Utils::isObjNull($con_arr['refund_trade_no'])) {
            $infos = $infos->where('refund_trade_no', '=', $con_arr['refund_trade_no']);
        }
    
        if (array_key_exists('refund_status', $con_arr) && !Utils::isObjNull($con_arr['refund_status'])) {
            $infos = $infos->where('refund_status', '=', $con_arr['refund_status']);
        }
    
        if (array_key_exists('refund_at', $con_arr) && !Utils::isObjNull($con_arr['refund_at'])) {
            $infos = $infos->where('refund_at', '=', $con_arr['refund_at']);
        }
    
        if (array_key_exists('used_status', $con_arr) && !Utils::isObjNull($con_arr['used_status'])) {
            $infos = $infos->where('used_status', '=', $con_arr['used_status']);
        }
    
        if (array_key_exists('used_at', $con_arr) && !Utils::isObjNull($con_arr['used_at'])) {
            $infos = $infos->where('used_at', '=', $con_arr['used_at']);
        }
    
        if (array_key_exists('settle_status', $con_arr) && !Utils::isObjNull($con_arr['settle_status'])) {
            $infos = $infos->where('settle_status', '=', $con_arr['settle_status']);
        }
    
        if (array_key_exists('settle_at', $con_arr) && !Utils::isObjNull($con_arr['settle_at'])) {
            $infos = $infos->where('settle_at', '=', $con_arr['settle_at']);
        }
    
        if (array_key_exists('shop_id', $con_arr) && !Utils::isObjNull($con_arr['shop_id'])) {
            $infos = $infos->where('shop_id', '=', $con_arr['shop_id']);
        }
    
        if (array_key_exists('shop_settlement_id', $con_arr) && !Utils::isObjNull($con_arr['shop_settlement_id'])) {
            $infos = $infos->where('shop_settlement_id', '=', $con_arr['shop_settlement_id']);
        }
    
        if (array_key_exists('shop_store_id', $con_arr) && !Utils::isObjNull($con_arr['shop_store_id'])) {
            $infos = $infos->where('shop_store_id', '=', $con_arr['shop_store_id']);
        }
    
        if (array_key_exists('shop_clerk_id', $con_arr) && !Utils::isObjNull($con_arr['shop_clerk_id'])) {
            $infos = $infos->where('shop_clerk_id', '=', $con_arr['shop_clerk_id']);
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
    * 2020-01-03 02:14:40
     */
    public static function setInfo($info, $data)
    {

        
        if (array_key_exists('id', $data)) {
                $info->id = $data['id'];
            }
        
        if (array_key_exists('trade_no', $data)) {
                $info->trade_no = $data['trade_no'];
            }
        
        if (array_key_exists('prepay_id', $data)) {
                $info->prepay_id = $data['prepay_id'];
            }
        
        if (array_key_exists('pay_shop_store_id', $data)) {
                $info->pay_shop_store_id = $data['pay_shop_store_id'];
            }
        
        if (array_key_exists('product_id', $data)) {
                $info->product_id = $data['product_id'];
            }
        
        if (array_key_exists('sub_product_id', $data)) {
                $info->sub_product_id = $data['sub_product_id'];
            }
        
        if (array_key_exists('product_num', $data)) {
                $info->product_num = $data['product_num'];
            }
        
        if (array_key_exists('user_id', $data)) {
                $info->user_id = $data['user_id'];
            }
        
        if (array_key_exists('a_user_id', $data)) {
                $info->a_user_id = $data['a_user_id'];
            }
        
        if (array_key_exists('type', $data)) {
                $info->type = $data['type'];
            }
        
        if (array_key_exists('score_fee', $data)) {
                $info->score_fee = $data['score_fee'];
            }
        
        if (array_key_exists('total_fee', $data)) {
                $info->total_fee = $data['total_fee'];
            }
        
        if (array_key_exists('cash_fee', $data)) {
                $info->cash_fee = $data['cash_fee'];
            }
        
        if (array_key_exists('purse_fee', $data)) {
                $info->purse_fee = $data['purse_fee'];
            }
        
        if (array_key_exists('settle_fee', $data)) {
                $info->settle_fee = $data['settle_fee'];
            }
        
        if (array_key_exists('user_coupon_id', $data)) {
                $info->user_coupon_id = $data['user_coupon_id'];
            }
        
        if (array_key_exists('coupon_fee', $data)) {
                $info->coupon_fee = $data['coupon_fee'];
            }
        
        if (array_key_exists('content', $data)) {
                $info->content = $data['content'];
            }
        
        if (array_key_exists('remark', $data)) {
                $info->remark = $data['remark'];
            }
        
        if (array_key_exists('pay_status', $data)) {
                $info->pay_status = $data['pay_status'];
            }
        
        if (array_key_exists('pay_at', $data)) {
                $info->pay_at = $data['pay_at'];
            }
        
        if (array_key_exists('refund_trade_no', $data)) {
                $info->refund_trade_no = $data['refund_trade_no'];
            }
        
        if (array_key_exists('refund_status', $data)) {
                $info->refund_status = $data['refund_status'];
            }
        
        if (array_key_exists('refund_at', $data)) {
                $info->refund_at = $data['refund_at'];
            }
        
        if (array_key_exists('used_status', $data)) {
                $info->used_status = $data['used_status'];
            }
        
        if (array_key_exists('used_at', $data)) {
                $info->used_at = $data['used_at'];
            }
        
        if (array_key_exists('settle_status', $data)) {
                $info->settle_status = $data['settle_status'];
            }
        
        if (array_key_exists('settle_at', $data)) {
                $info->settle_at = $data['settle_at'];
            }
        
        if (array_key_exists('shop_id', $data)) {
                $info->shop_id = $data['shop_id'];
            }
        
        if (array_key_exists('shop_settlement_id', $data)) {
                $info->shop_settlement_id = $data['shop_settlement_id'];
            }
        
        if (array_key_exists('shop_store_id', $data)) {
                $info->shop_store_id = $data['shop_store_id'];
            }
        
        if (array_key_exists('shop_clerk_id', $data)) {
                $info->shop_clerk_id = $data['shop_clerk_id'];
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
    * 2020-01-03 02:14:40
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

