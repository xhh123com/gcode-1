<?php

/**
* Created by PhpStorm.
* User: HappyQi
* Date: 2017/9/28
* Time: 10:19
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyCheckOrder extends Model
{
    use SoftDeletes;
    protected $table ='t_daily_check_order';
    public $timestamps = true;
    protected $dates = ['deleted_at'];
}


