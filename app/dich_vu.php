<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dich_vu extends Model
{
    protected $table = "dich_vu";

    public function su_dung_dich_vu(){
        return $this->hasMany('App\su_dung_dich_vu','madv','madv');
    }
}
