<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class FieldDoc
{
    private $collection_name = "field";       //mongodb的collection名称

    private $admin_id;          //管理员id
    private $field_type_id;          //字段分类id
    private $name;       //字段名称
    private $field_base_name;          //字段数据库字段名
    private $field_value_display_company_name;          //单位字段数据库字段名
    private $field_value_type = '0';          //填写方式 0:表单填写 1:长文本填写 2:下拉菜单
    private $field_value_tip;          //输入框中的提示内容
    private $default_value;          //默认值
    private $field_value_display_value;          //下拉菜单内容
    private $field_value_display_company1;          //下拉菜单(主单位)
    private $field_value_display_company2;          //下拉菜单(副单位)
    private $field_value_display_company_value;          //主副单位换算值
    private $is_chart_display = '0';          //是否可以在折线图中统计
    private $is_array_chart_display = '0';          //是否允许选择是否在折线图统计
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}