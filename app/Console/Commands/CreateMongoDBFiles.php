<?php

namespace App\Console\Commands;

use App\Components\Common\DateTool;
use App\MongoDB\Models\Doc\PartnerDoc;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CreateMongoDBFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:createMongoDBFiles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //路由变量数组
        $route_param_items = [];
        $table_names = [];

        //类的名称数组
        $class_names_arr = self::getFiles();
//        echo "class_names_arr" . json_encode($class_names_arr);

        foreach ($class_names_arr as $class_name) {
            $ref = new \ReflectionClass("App\MongoDB\Models\Doc\\" . $class_name);
            $vars_arr = $ref->getDefaultProperties();       //获取全部的变量
            $columns_arr = array_keys($vars_arr);
            $model_name = substr($class_name, 0, strlen($class_name) - 3);    //model名
            $var_name = $vars_arr['collection_name'];       //表名，变量名
            $table_name = $var_name;            //表名
            $router_blade_var_name = self::getVarName($model_name);
            $controller_name = self::getControllerName($model_name);
            $manager_name = self::getManagerName($model_name);      //manager名

            self::createMongoDBModel($model_name, $table_name);            //建设model

            self::createMongoDBManager($model_name, $table_name, $manager_name, $var_name, $columns_arr); //建设V3版本的Manager

            //生成AdminController
            self::createAdminController($model_name, $var_name, $controller_name, $router_blade_var_name);

            //生成APIController
            self::createAPIController($model_name, $var_name, $controller_name, $router_blade_var_name);

            //生成AdminApiController
            self::createAdminAPIController($model_name, $var_name, $controller_name, $router_blade_var_name);

            //向路由数组中推入数据
            $item = [
                'var_name' => $router_blade_var_name,
                'model_name' => $model_name
            ];
            array_push($route_param_items, $item);
        }

        //生成web路由
        self::createWebRoute($route_param_items);

        //生成api路由
        self::createAPIRoute($route_param_items);

        //生成admin api路由
        self::createAdminAPIRoute($route_param_items);

        //生成修改字符集的信息
        self::createAlertDB($table_names);

    }



    //获取storage/app/MongoDB/Models/Doc下的全部文件
    //@return array形式的数组，里面存储文件名，文件名为去掉Doc.php，即UserDoc.php输出为User
    public static function getFiles()
    {
        //获取全部的app/MongoDB/Models/Doc下的文件，全部的对象文件
        $doc_files = Storage::disk('app')->allFiles('./MongoDB/Models/Doc');
        $class_names_arr = [];
        foreach ($doc_files as $doc_file) {
//            echo "doc_file:" . $doc_file . "\n";
            $base_doc_file_name = basename($doc_file);
//            echo "base_doc_file_name:" . $base_doc_file_name . "\n";
            $base_doc_file_name = str_replace(strrchr($base_doc_file_name, '.'), '', $base_doc_file_name);
            array_push($class_names_arr, $base_doc_file_name);
        }
        return $class_names_arr;
    }

    //根据表名生成Model名
    private function getModelName($table_name)
    {
        /*
         * 此处请注意，要求表格前缀为t_，这样主要是标明
         */
        $prefix_chars = substr($table_name, 0, 2);
        $r_prefix_table_name = $table_name;
        if ($prefix_chars == 't_') {
            $r_prefix_table_name = substr($r_prefix_table_name, 2);
        }

        //去掉_info信息，这样t_user_info，则会转变为user
        $r_prefix_table_name = str_replace("_info", "", $r_prefix_table_name);


//        echo "r_prefix_table_name:" . $r_prefix_table_name . "\n";
        $r_prefix_table_name_arr = explode('_', $r_prefix_table_name);
//        echo "r_prefix_table_name_arr:" . json_encode($r_prefix_table_name_arr) . "\n";

        $model_name = "";
        foreach ($r_prefix_table_name_arr as $r_prefix_table_name_item) {
            $model_name = $model_name . ucfirst($r_prefix_table_name_item);
        }
        echo "model_name:" . $model_name . "\n";
        return $model_name;
    }

    //根据model名生成变量名，即首字母小写
    private function getVarName($model_name)
    {
        return lcfirst($model_name);
    }


    //根据表名生成变量名，采用_下划线的方式
    private function getVarNameByTableName($table_name)
    {
        /*
        * 此处请注意，要求表格前缀为t_，这样主要是标明
        */
        $prefix_chars = substr($table_name, 0, 2);
        $r_prefix_table_name = $table_name;
        if ($prefix_chars == 't_') {
            $r_prefix_table_name = substr($r_prefix_table_name, 2);
        }

        //去掉_info信息，这样t_user_info，则会转变为user
        $r_prefix_table_name = str_replace("_info", "", $r_prefix_table_name);

        return $r_prefix_table_name;
    }

    //根据model名生成Manager名
    private function getManagerName($model_name)
    {
        $manager_name = $model_name . "Manager";
        echo "\nmanager_name:" . $manager_name . "\n";
        return $manager_name;
    }

    //根据model名生成Controller名
    private function getControllerName($model_name)
    {
        $controller_name = $model_name . "Controller";
        echo "\ncontroller_name:" . $controller_name . "\n";
        return $controller_name;
    }

    //生成Model文件
    private function createMongoDBModel($model_name, $table_name)
    {
        $param = [
            'model_name' => $model_name,
            'table_name' => $table_name
        ];
        $file_string = view('gcode.models.MongoDB.model', $param)->__toString();
        echo "\nmodel code string:\n" . $file_string . "\n";

        $file_string = self::replaceTags($file_string);

        Storage::disk('local')->put('/Code/Models/MongoDB/' . $model_name . ".php", $file_string);
    }


    //生成MongoDBManagerV3文件
    private function createMongoDBManager($model_name, $table_name, $manager_name, $var_name, $columns_arr)
    {
        $columns = $columns_arr;
        echo "\ncolumns:\n" . json_encode($columns) . "\n";

        $param = [
            'var_name' => $var_name,
            'model_name' => $model_name,
            'table_name' => $table_name,
            'manager_name' => $manager_name,
            'columns' => $columns,
            'date_time' => DateTool::getCurrentTime()
        ];

        $file_string = view('gcode.managers.MongoDB.manager', $param)->__toString();
        echo "\nmodel code string:\n" . $file_string . "\n";
        $file_string = self::replaceTags($file_string);

        Storage::disk('local')->put('/Code/Components/MongoDB/' . $manager_name . ".php", $file_string);
    }

    //生成admin的controller文件
    private function createAdminController($model_name, $var_name, $controller_name, $router_blade_var_name)
    {
        $param = [
            'model_name' => $model_name,
            'var_name' => $var_name,
            'controller_name' => $controller_name,
            'router_blade_var_name' => $router_blade_var_name,
            'date_time' => DateTool::getCurrentTime()
        ];

        $file_string = view('gcode.controllers.admin.controllerv4', $param)->__toString();

        echo "\nadmin.controller code string:\n" . $file_string . "\n";
        $file_string = self::replaceTags($file_string);

        Storage::disk('local')->put('/Code/Controllers/Admin/Stable/' . $controller_name . ".php", $file_string);
    }

    //生成web route文件
    private function createWebRoute($route_param_items)
    {
        $param = [
            'route_param_items' => $route_param_items
        ];
        $file_string = view('gcode.controllers.admin.web_route', $param)->__toString();

        echo "\nweb route string:\n" . $file_string . "\n";
        $file_string = self::replaceTags($file_string);

        Storage::disk('local')->put('/Code/Route/web.php', $file_string);
    }


    //生成API的controller文件
    private function createAPIController($model_name, $var_name, $controller_name, $router_blade_var_name)
    {
        $param = [
            'model_name' => $model_name,
            'var_name' => $var_name,
            'controller_name' => $controller_name,
            'router_blade_var_name' => $router_blade_var_name,
            'date_time' => DateTool::getCurrentTime()
        ];

        $file_string = view('gcode.controllers.api.controller', $param)->__toString();

        echo "\napi.controller code string:\n" . $file_string . "\n";
        $file_string = self::replaceTags($file_string);

        Storage::disk('local')->put('/Code/Controllers/Api/Stable/' . $controller_name . ".php", $file_string);

    }


    //生成AdminAPI的controller文件
    private function createAdminAPIController($model_name, $var_name, $controller_name, $router_blade_var_name)
    {
        $param = [
            'model_name' => $model_name,
            'var_name' => $var_name,
            'controller_name' => $controller_name,
            'router_blade_var_name' => $router_blade_var_name,
            'date_time' => DateTool::getCurrentTime()
        ];

        $file_string = view('gcode.controllers.adminApi.controller', $param)->__toString();

        echo "\napi.controller code string:\n" . $file_string . "\n";
        $file_string = self::replaceTags($file_string);

        Storage::disk('local')->put('/Code/Controllers/AdminApi/Stable/' . $controller_name . ".php", $file_string);
    }


    //生成API route文件
    private function createAPIRoute($route_param_items)
    {
        $param = [
            'route_param_items' => $route_param_items
        ];
        $file_string = view('gcode.controllers.api.api_route', $param)->__toString();

        echo "\napi route string:\n" . $file_string . "\n";
        $file_string = self::replaceTags($file_string);

        Storage::disk('local')->put('/Code/Route/api.php', $file_string);
    }


    //生成AdminAPI route文件
    private function createAdminAPIRoute($route_param_items)
    {
        $param = [
            'route_param_items' => $route_param_items
        ];
        $file_string = view('gcode.controllers.adminApi.api_route', $param)->__toString();

        echo "\napi route string:\n" . $file_string . "\n";
        $file_string = self::replaceTags($file_string);

        Storage::disk('local')->put('/Code/Route/admin_api.php', $file_string);
    }


    //生成tables修改utf8mb4的代码
    private function createAlertDB($table_names)
    {
        $param = [
            'table_names' => $table_names
        ];
        $file_string = view('gcode.db.alertCharset', $param)->__toString();

        echo "\nalert charset string:\n" . $file_string . "\n";
        $file_string = self::replaceTags($file_string);

        Storage::disk('local')->put('/Code/DB/alertChartset.text', $file_string);
    }


    //替换文件字符
    private function replaceTags($file_string)
    {
        $file_string = str_replace("<html>", "<?php", $file_string);
        $file_string = str_replace("</html>", "", $file_string);
        return $file_string;
    }


}
