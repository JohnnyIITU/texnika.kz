<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    public static function getLabelById($id){
        return self::findOrFail($id)->value;
    }
}
