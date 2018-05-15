<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class khung_gio extends Model
{
    protected $table = "khung_gio";

    public function suat_chieu(){
        return $this->hasMany('App\suat_chieu','makhunggio','makhunggio');
    }
}
