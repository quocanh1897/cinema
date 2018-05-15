<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phim extends Model
{
    protected $table = "phim";

    public function phien_ban(){
        return $this->hasMany('App\phien_ban','maphim','maphim');
    }

    public function the_loai(){
        return $this->hasMany('App\the_loai','maphim','maphim');
    }

    public function dien_vien(){
        return $this->hasMany('App\dien_vien','maphim','maphim');
    }

    public function suat_chieu(){
        return $this->hasMany('App\suat_chieu','maphim','maphim');
    }
}
