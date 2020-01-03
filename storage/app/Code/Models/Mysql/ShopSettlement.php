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

class ShopSettlement extends Model
{
    use SoftDeletes;
    protected $table ='t_shop_settlement';
    public $timestamps = true;
    protected $dates = ['deleted_at'];
}


