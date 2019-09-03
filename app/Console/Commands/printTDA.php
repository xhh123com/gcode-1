<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class printTDA extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'printTDA';

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
        //初始化二位数组
        $two_dimensional_array = [[1, 2, 3], [4, 5, 6], [7, 8, 9]];

        self::recursiveTwoDimensionalArray($two_dimensional_array);

    }


    /*
     * 递归循环二位数组并打印
     *
     * By TerryQi
     *
     * 2019-09-03
     *
     * $two_dimensional_array 应为二维数组
     *
     */
    public static function recursiveTwoDimensionalArray($two_dimensional_array)
    {
        echo "current array: " . json_encode($two_dimensional_array) . "\n";
        //当递归至1时，应该输出数组，里面是全部可能性
        if (count($two_dimensional_array) <= 1) {
            echo "\n";
            echo "\n";
            echo "\n";
            echo "result: " . json_encode($two_dimensional_array) . "\n";
            return;
        } else {
            $count = count($two_dimensional_array);     //计算数组长度
            //负责应该将倒数的0、1合并，并生成新数组继续递归
            $item_arr_0 = array_pop($two_dimensional_array);
            echo "pop1 item_arr_0:" . json_encode($item_arr_0) . "\n";
            $item_arr_1 = array_pop($two_dimensional_array);
            echo "pop1 item_arr_1:" . json_encode($item_arr_1) . "\n";
            $merge_array = self::compute_array($item_arr_0, $item_arr_1);           //合并这两个数组的肯能行
            echo "merge_array :" . json_encode($merge_array) . "\n";
            array_push($two_dimensional_array, $merge_array);
            self::recursiveTwoDimensionalArray($two_dimensional_array);
        }
    }

    /*
     * 计算两个数组的全部可能性
     *
     * By TerryQi
     *
     * @param array1、array2
     *
     * @return merge_array（array1与array2合并后的全部元素组合的数组）
     */
    public static function compute_array($array1, $array2)
    {
        $merge_array = [];
        //循环第一个数组
        for ($i = 0; $i < count($array1); $i++) {
            for ($j = 0; $j < count($array2); $j++) {
                array_push($merge_array, strval($array1[$i]) . " " . strval($array2[$j]));
            }
        }
        return $merge_array;
    }


}
