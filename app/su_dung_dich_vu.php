<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class su_dung_dich_vu extends Model
{
    protected $table = "su_dung_dich_vu";

    public function dich_vu(){
        return $this->hasMany('App\dich_vu','madv','');
    }
}
