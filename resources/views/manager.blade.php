<html>


/**
 * Created by PhpStorm.
 * User: mtt17
 * Date: 2018/4/9
 * Time: 11:32
 */

namespace App\Components;


use App\Components\Utils;
use App\Models\{{$model_name}};

class {{$manager_name}}
{

    /*
     * getById
     *
     * By TerryQi
     *
     * 2019-4-15
     */
    public static function getById($id)
    {
        $info = {{$model_name}}::where('id', $id)->first();
        return $info;
    }

    /*
     * getInfoByLevel
     *
     * By TerryQi
     *
     * 2019-02-25
     *
     */
    public static function getInfoByLevel($info, $level)
    {
        //0:
        if (strpos($level, '0') !== false) {

        }
        //1:
        if (strpos($level, '1') !== false) {

        }
        //2:
        if (strpos($level, '2') !== false) {

        }


        return $info;
    }

    /*
     * getListByCon
     *
     * By mtt
     *
     * 2018-4-9
     */
    public static function getListByCon($con_arr, $is_paginate)
    {

        $infos = new {{$model_name}}();

    @foreach($columns as $column)

        if (array_key_exists('{{$column}}', $con_arr) && !Utils::isObjNull($con_arr['{{$column}}'])) {
            $infos = $infos->where('{{$column}}', '=', $con_arr['{{$column}}']);
        }
    @endforeach



        $infos = $infos->orderby('seq', 'desc')->orderby('id', 'desc');
        if ($is_paginate) {
            $infos = $infos->paginate(Utils::PAGE_SIZE);
        } else {
            $infos = $infos->get();
        }
        return $infos;
    }

    /*
     * setInfo
     *
     * By TerryQi
     *
     * 2018-06-11
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

}

</html>