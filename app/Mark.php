<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    public $timestamps = false;
    public static function getMarkById($id){
        return Mark::findOrFail($id)->value;
    }
}
