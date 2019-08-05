<html>


/**
 * Created by PhpStorm.
 * User: mtt17
 * Date: 2018/4/9
 * Time: 11:32
 */

namespace App\Components;


use App\Components\Common\Utils;
use App\Models\{{$model_name}};

class {{$manager_name}}
{

    /*
     * getById
     *
    * By Auto CodeCreator
    *
    * {{$date_time}}
     */
    public static function getById($id)
    {
        $info = {{$model_name}}::where('id', $id)->first();
        return $info;
    }

    /*
    * getById
    *
    * By Auto CodeCreator
    *
    * {{$date_time}}
    */
    public static function getByIdWithTrashed($id)
    {
        $info = {{$model_name}}::withTrashed()->where('id', $id)->first();
        return $info;
    }

    /*
    * deleteById
    *
    * By Auto CodeCreator
    *
    * {{$date_time}}
    */
    public static function deleteById($id)
    {
        $info = self::getById($id);
        $result = $info->delete();
        return $result;
    }


    /*
     * getInfoByLevel
     *
    * By Auto CodeCreator
    *
    * {{$date_time}}
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
    * {{$date_time}}
     */
    public static function getListByCon($con_arr, $is_paginate)
    {
        $infos = new {{$model_name}}();

        if (array_key_exists('search_word', $con_arr) && !Utils::isObjNull($con_arr['search_word'])) {
            $keyword = $con_arr['search_word'];
            $infos = $infos->where(function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            });
        }

        if (array_key_exists('ids_arr', $con_arr) && !empty($con_arr['ids_arr'])) {
            $infos = $infos->wherein('id', $con_arr['ids_arr']);
        }

    @foreach($columns as $column)

        if (array_key_exists('{{$column}}', $con_arr) && !Utils::isObjNull($con_arr['{{$column}}'])) {
            $infos = $infos->where('{{$column}}', '=', $con_arr['{{$column}}']);
        }
    @endforeach

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
        }
        else {
            $infos = $infos->get();
        }
        return $infos;
    }

    /*
     * setInfo
     *
    * By Auto CodeCreator
    *
    * {{$date_time}}
     */
    public static function setInfo($info, $data)
    {

        @foreach($columns as $column)

        if (array_key_exists('{{$column}}', $data)) {
                $info->{{$column}} = $data['{{$column}}'];
            }
        @endforeach

        return $info;
    }

    /*
    * 统一封装数量操作，部分对象涉及数量操作，例如产品销售，剩余数等，统一通过该方法封装
    *
    * By Auto CodeCreator
    *
    * {{$date_time}}
    *
    * @param id：对象id item：操作对象 num：加减数值
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

}

</html>