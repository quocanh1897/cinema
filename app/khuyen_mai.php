<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class khuyen_mai extends Model
{
    protected $table = "khuyen_mai";

    public function hoa_don_khuyen_mai(){
        return $this->hasMany('App\hoa_don_khuyen_mai','makm','makm');
    }

    public function rap_khuyen_mai(){
        return $this->hasMany('App\rap_khuyen_mai','makm','makm');
    }
}
