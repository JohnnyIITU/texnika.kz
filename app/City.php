<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public static function getCityById($id){
        return City::findOrFail($id)->value;
    }
}
