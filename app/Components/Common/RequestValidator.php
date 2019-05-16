<?php
/**
 * File_Name:RequestValidator.php
 * Author: leek
 * Date: 2017/8/29
 * Time: 18:20
 */

namespace App\Components\Common;

use Illuminate\Support\Facades\Validator;

class RequestValidator
{

    // 验证http传参
    public static function validator ($data, $ruler) {
        $validator = Validator::make($data, $ruler);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return true;
    }
}
