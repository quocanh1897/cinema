<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phong_chieu extends Model
{
    protected $table = "phong_chieu";

    public function ghe_ngoi(){
        return $this->hasMany('App\ghe_ngoi','maphong','maphong');
    }

    public function rap_chieu(){
        return $this->belongsTo('App\rap_chieu','marap','maphong');
    }

    public function loai_phong(){
        return $this->belongsTo('App\loai_phong','tenloai','maphong');
    }
}
