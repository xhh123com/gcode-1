<?php


/**
* Created by PhpStorm.
* User: TerryQi
* Date: 2019/10/23
* Time: 12:17
*/

namespace App\MongoDB\Models;


use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class CollectionDoctorVideo extends Model
{
    use SoftDeletes;
    protected $collection = 'collection_doctor_video';
    public $timestamps = true;
    protected $dates = ['deleted_at'];
}


