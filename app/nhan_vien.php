<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nhan_vien extends Model
{
    protected $table = "nhan_vien";

    public function users(){
        return $this->belongsTo('App\User','id','matk_nv');
    }

    public function rap_chieu(){
        return $this->belongsTo('App\rap_chieu','marap','matk_nv');
    }

    public function nhan_vien(){
        return $this->hasMany('App\nhan_vien','matk_quanly','matk_nv');
    }

    public function hoa_don(){
        return $this->hasMany('App\hoa_don','matk_nv','matk_nv');
    }
}
