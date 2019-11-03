<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    public static function getLabelById($id){
        return self::findOrFail($id)->value;
    }
}
