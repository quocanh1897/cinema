<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rap_khuyen_mai extends Model
{
    protected $table = "rap_khuyen_mai";

    public function rap_chieu(){
        return $this->hasMany('App\rap_chieu','marap','makm');
    }

    public function khuyen_mai(){
        return $this->belongsTo('App\khuyen_mai','makm','makm');
    }
}
