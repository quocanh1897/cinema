<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rap_chieu extends Model
{
    protected $table = "rap_chieu";

    public function suat_chieu(){
        return $this->hasMany('App\suat_chieu','marap','marap');
    }

    public function hinh_anh(){
        return $this->hasMany('App\hinh_anh','marap','marap');
    }

    public function rap_khuyen_mai(){
        return $this->hasMany('App\rap_khuyen_mai','marap','marap');
    }

    public function ghe_ngoi(){
        return $this->hasMany('App\ghe_ngoi','marap','marap');
    }

    public function phong_chieu(){
        return $this->hasMany('App\phong_chieu','marap','marap');
    }

    public function nhan_vien(){
        return $this->hasMany('App\nhan_vien','marap','marap');
    }

    public function dia_ban(){
        return $this->belongsTo('App\dia_ban','maqh','maqh');
    }
}
