<?php

namespace App\Console\Commands;

use App\Components\DateTool;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class CreateFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:createFiles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'the command for create models and components';

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
        //开始进行文件创建
        echo "start create files";
        $tables = DB::select("show tables");
        echo "the database tables:" . json_encode($tables) . "\n";

        $route_param_items = [];

        //循环获取表信息，创建model、manager和controller
        foreach ($tables as $key => $value) {
            echo "\n\n\ntable " . json_encode($key) . ":" . json_encode($value->Tables_in_qyxdb) . "\n";
            $table_name = $value->Tables_in_qyxdb;     //表名

            $model_name = self::getModelName($table_name);      //model名
            self::createModel($model_name, $table_name);            //建设model

            $manager_name = self::getManagerName($model_name);      //manager名
            self::createManager($model_name, $table_name, $manager_name);     //建设Manager

            $var_name = self::getVarName($model_name);
            $controller_name = self::getControllerName($model_name);
            //生成AdminController
            self::createAdminController($model_name, $var_name, $controller_name);
            //生成APIController
            self::createAPIController($model_name, $var_name, $controller_name);

            //向路由数组中推入数据
            $item = [
                'var_name' => $var_name,
                'model_name' => $model_name
            ];
            array_push($route_param_items, $item);
        }

        //生成web路由
        self::createWebRoute($route_param_items);

        //生成api路由
        self::createAPIRoute($route_param_items);

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
    private function createModel($model_name, $table_name)
    {
        $param = [
            'model_name' => $model_name,
            'table_name' => $table_name
        ];
        $file_string = view('model', $param)->__toString();
        echo "\nmodel code string:\n" . $file_string . "\n";

        $file_string = self::replaceTags($file_string);

        Storage::disk('local')->put('/Code/Models/' . $model_name . ".php", $file_string);
    }


    //生成Manager文件
    private function createManager($model_name, $table_name, $manager_name)
    {
        $columns = Schema::getColumnListing($table_name);
        echo "\ncolumns:\n" . json_encode($columns) . "\n";

        $param = [
            'model_name' => $model_name,
            'table_name' => $table_name,
            'manager_name' => $manager_name,
            'columns' => $columns
        ];

        $file_string = view('manager', $param)->__toString();
        echo "\nmodel code string:\n" . $file_string . "\n";
        $file_string = self::replaceTags($file_string);

        Storage::disk('local')->put('/Code/Components/' . $manager_name . ".php", $file_string);
    }

    //生成admin的controller文件
    private function createAdminController($model_name, $var_name, $controller_name)
    {
        $param = [
            'model_name' => $model_name,
            'var_name' => $var_name,
            'controller_name' => $controller_name,
            'date_time' => DateTool::getCurrentTime()
        ];

        $file_string = view('admin.controller', $param)->__toString();

        echo "\nadmin.controller code string:\n" . $file_string . "\n";
        $file_string = self::replaceTags($file_string);

        Storage::disk('local')->put('/Code/Admin/' . $controller_name . ".php", $file_string);
    }

    //生成web route文件
    private function createWebRoute($route_param_items)
    {
        $param = [
            'route_param_items' => $route_param_items
        ];
        $file_string = view('admin.web_route', $param)->__toString();

        echo "\nweb route string:\n" . $file_string . "\n";
        $file_string = self::replaceTags($file_string);

        Storage::disk('local')->put('/Code/Route/web.php', $file_string);
    }


    //生成API的controller文件
    private function createAPIController($model_name, $var_name, $controller_name)
    {
        $param = [
            'model_name' => $model_name,
            'var_name' => $var_name,
            'controller_name' => $controller_name,
            'date_time' => DateTool::getCurrentTime()
        ];

        $file_string = view('api.controller', $param)->__toString();

        echo "\napi.controller code string:\n" . $file_string . "\n";
        $file_string = self::replaceTags($file_string);

        Storage::disk('local')->put('/Code/Api/' . $controller_name . ".php", $file_string);
    }

    //生成API route文件
    private function createAPIRoute($route_param_items)
    {
        $param = [
            'route_param_items' => $route_param_items
        ];
        $file_string = view('api.api_route', $param)->__toString();

        echo "\napi route string:\n" . $file_string . "\n";
        $file_string = self::replaceTags($file_string);

        Storage::disk('local')->put('/Code/Route/api.php', $file_string);
    }


    //替换文件字符
    private function replaceTags($file_string)
    {
        $file_string = str_replace("<html>", "<?php", $file_string);
        $file_string = str_replace("</html>", "", $file_string);
        return $file_string;
    }


}
