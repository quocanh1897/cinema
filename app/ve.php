<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ve extends Model
{
    protected $table = "ve";

    public function suat_chieu(){
        return $this->belongsTo('App\suat_chieu','makhunggio','mave');
    }

    public function ghe_ngoi(){
        return $this->belongsTo('App\ghe_ngoi','maghe','mave');
    }

    public function hoa_don(){
        return $this->belongsTo('App\hoa_don','mahoadon','mave');
    }
}
