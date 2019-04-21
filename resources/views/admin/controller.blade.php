<html>

/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/20
* Time: 10:50
*/

namespace App\Http\Controllers\Admin;


use App\Components\{{$model_name}}Manager;
use App\Components\QNManager;
use App\Components\Utils;
use App\Http\Controllers\ApiResponse;
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
        $admin = $request->session()->get('admin');
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

        return view('admin.{{$var_name}}.index', ['admin' => $admin, 'datas' => ${{$var_name}}s, 'con_arr' => $con_arr]);
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
        $admin = $request->session()->get('admin');
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        ${{$var_name}} = new {{$model_name}}();
        if (array_key_exists('id', $data)) {
        ${{$var_name}} = {{$model_name}}Manager::getById($data['id']);
        }
        return view('admin.{{$var_name}}.edit', ['admin' => $admin, 'data' => ${{$var_name}}, 'upload_token' => $upload_token]);
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
        $admin = $request->session()->get('admin');
        ${{$var_name}} = new {{$model_name}}();
        //存在id是保存
        if (array_key_exists('id', $data) && !Utils::isObjNull($data['id'])) {
            ${{$var_name}} = {{$model_name}}Manager::getById($data['id']);
        }
        $data['admin_id'] = $admin['id'];
        ${{$var_name}} = {{$model_name}}Manager::setInfo(${{$var_name}}, $data);
        ${{$var_name}}->save();
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
        if (is_numeric($id) !== true) {
            return redirect()->action('\App\Http\Controllers\Admin\IndexController@error', ['msg' => '合规校验失败，请检查参数id$id']);
        }
        ${{$var_name}} = {{$model_name}}Manager::getById($data['id']);
        ${{$var_name}} = {{$model_name}}Manager::setInfo(${{$var_name}}, $data);
        ${{$var_name}}->save();
        return ApiResponse::makeResponse(true, ${{$var_name}}, ApiResponse::SUCCESS_CODE);
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
        $admin = $request->session()->get('admin');
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

        return view('admin.{{$var_name}}.info', ['admin' => $admin, 'data' => ${{$var_name}}]);
    }

}

</html>