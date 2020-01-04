<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;
    public static function getCityById($id){
        return self::findOrFail($id)->value;
    }
}
