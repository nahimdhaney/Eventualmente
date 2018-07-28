<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    //
        public function setLocationAttribute($value) {
        $this->attributes['latitud'] = DB::raw("POINT($value)");
    }
 
}
