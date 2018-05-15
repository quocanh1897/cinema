<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loai_phong extends Model
{
    protected $table = "loai_phong";

    public function phong_chieu(){
        return $this->hasMany('App\phong_chieu','tenloai','tenloai');
    }
}
