<html>

/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/20
* Time: 10:50
*/

namespace App\Http\Controllers\Admin;

use App\Components\Common\RequestValidator;
use App\Components\{{$model_name}}Manager;
use App\Components\Common\QNManager;
use App\Components\Common\Utils;
use App\Components\Common\ApiResponse;
use App\Models\{{$model_name}};
use Illuminate\Http\Request;

class {{$model_name}}Controller
{

    /*
    * 首页
    *
    * By Auto CodeCreator
    *
    * {{$date_time}}
    */
    public function index(Request $request)
    {
        $self_admin = $request->session()->get('self_admin');
        $data = $request->all();
        //相关搜素条件
        $status = null;
        $search_word = null;
        if (array_key_exists('status', $data) && !Utils::isObjNull($data['status'])) {
            $status = $data['status'];
        }
        if (array_key_exists('search_word', $data) && !Utils::isObjNull($data['search_word'])) {
            $search_word = $data['search_word'];
        }
        $con_arr = array(
            'status' => $status,
            'search_word' => $search_word,
        );
        ${{$var_name}}s ={{$model_name}}Manager::getListByCon($con_arr, true);
        foreach (${{$var_name}}s as ${{$var_name}}) {
        ${{$var_name}} = {{$model_name}}Manager::getInfoByLevel(${{$var_name}}, '');
        }

        return view('admin.{{$router_blade_var_name}}.index', ['self_admin' => $self_admin, 'datas' => ${{$var_name}}s, 'con_arr' => $con_arr]);
    }

    /*
    * 编辑-get
    *
    * By Auto CodeCreator
    *
    * {{$date_time}}
    */
    public function edit(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        ${{$var_name}} = new {{$model_name}}();
        if (array_key_exists('id', $data)) {
        ${{$var_name}} = {{$model_name}}Manager::getById($data['id']);
        }
        return view('admin.{{$router_blade_var_name}}.edit', ['self_admin' => $self_admin, 'data' => ${{$var_name}}, 'upload_token' => $upload_token]);
    }


    /*
    * 添加或编辑-post
    *
    * By Auto CodeCreator
    *
    * {{$date_time}}
    */
    public function editPost(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        ${{$var_name}} = new {{$model_name}}();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            ${{$var_name}} = {{$model_name}}Manager::getById($data['id']);
        }
        $data['admin_id'] = $self_admin['id'];
        ${{$var_name}} = {{$model_name}}Manager::setInfo(${{$var_name}}, $data);
        {{$model_name}}Manager::save(${{$var_name}});
        return ApiResponse::makeResponse(true, ${{$var_name}}, ApiResponse::SUCCESS_CODE);
    }


    /*
    * 设置状态
    *
    * By Auto CodeCreator
    *
    * {{$date_time}}
    */
    public function setStatus(Request $request, $id)
    {
        $data = $request->all();
        ${{$var_name}} = {{$model_name}}Manager::getById($data['id']);
        if (!${{$var_name}}) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        ${{$var_name}} = {{$model_name}}Manager::setInfo(${{$var_name}}, $data);
        {{$model_name}}Manager::save(${{$var_name}});
        return ApiResponse::makeResponse(true, ${{$var_name}}, ApiResponse::SUCCESS_CODE);
    }

    /*
    * 删除
    *
    * By Auto CodeCreator
    *
    * 2019-05-18 17:14:16
    */
    public function deleteById(Request $request, $id)
    {
        $data = $request->all();
        ${{$var_name}} = {{$model_name}}Manager::getById($data['id']);
        if (!${{$var_name}}) {
        return ApiResponse::makeResponse(false, "未找到删除信息", ApiResponse::INNER_ERROR);
        }
        if (${{$var_name}}) {
            {{$model_name}}Manager::deleteById(${{$var_name}}->id);
        }
        return ApiResponse::makeResponse(true, "删除成功", ApiResponse::SUCCESS_CODE);
    }


    /*
    * 查看信息
    *
    * By Auto CodeCreator
    *
    * {{$date_time}}
    *
    */
    public function info(Request $request)
    {
        $data = $request->all();
        $self_admin = $request->session()->get('self_admin');
        //合规校验
        $requestValidationResult = RequestValidator::validator($request->all(), [
        'id' => 'required',
        ]);
        if ($requestValidationResult !== true) {
        return redirect()->action('\App\Http\Controllers\Admin\IndexController@error', ['msg' => '合规校验失败，请检查参数' . $requestValidationResult]);
        }
        //信息
        ${{$var_name}} = {{$model_name}}Manager::getById($data['id']);
        ${{$var_name}} = {{$model_name}}Manager::getInfoByLevel(${{$var_name}}, '0');

        return view('admin.{{$router_blade_var_name}}.info', ['self_admin' => $self_admin, 'data' => ${{$var_name}}]);
    }

}

</html>