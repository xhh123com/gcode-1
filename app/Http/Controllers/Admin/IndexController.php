<?php
/**
 * 首页控制器
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/20 0020
 * Time: 20:15
 */

namespace App\Http\Controllers\Admin;

use App\Components\AdminManager;
use App\Components\Common\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //首页
    public function index(Request $request)
    {
        $self_admin = $request->session()->get('self_admin');
        $self_admin = AdminManager::getInfoByLevel($self_admin, '');
        Utils::processLog(__METHOD__, '', 'env APP_NAME:' . json_encode(env('APP_NAME', '')));
        return view('admin.index.index', ['self_admin' => $self_admin]);
    }

    //错误
    public function error(Request $request)
    {
        $data = $request->all();
        $msg = null;
        if (array_key_exists('msg', $data)) {
            $msg = $data['msg'];
        }
        $self_admin = $request->session()->get('self_admin');
        return view('admin.index.error500', ['msg' => $msg, 'self_admin' => $self_admin]);
    }
}