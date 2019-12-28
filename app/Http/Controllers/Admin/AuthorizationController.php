<?php

/**
 * Created by PhpStorm.
 * User: mtt17
 * Date: 2018/4/20
 * Time: 10:50
 */

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\AdManager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\Ad;
use Illuminate\Http\Request;

class AuthorizationController
{

    /*
    * 首页
    *
    * By Auto CodeCreator
    *
    * 2019-05-11 18:01:25
    */
    public function index(Request $request)
    {
        $admin = $request->session()->get('admin');
        $data = $request->all();

        return view('admin.authorization.index', ['admin' => $admin, 'datas' => null, 'con_arr' => null]);
    }

}

