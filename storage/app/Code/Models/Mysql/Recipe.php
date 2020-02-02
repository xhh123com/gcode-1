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

class Recipe extends Model
{
    use SoftDeletes;
    protected $table ='recipe';
    public $timestamps = true;
    protected $dates = ['deleted_at'];
}


