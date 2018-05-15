<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dia_ban extends Model
{
    protected $table = "dia_ban";

    public function rap_chieu(){
        return $this->hasMany('App\rap_chieu','maqh','maqh');
    }
}
