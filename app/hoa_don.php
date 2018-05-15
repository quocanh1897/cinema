<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hoa_don extends Model
{
    protected $table = "hoa_don";

    public function su_dung_dich_vu(){
        return $this->hasMany('App\su_dung_dich_vu','mahoadon','mahoadon');
    }

    public function hoa_don_khuyen_mai(){
        return $this->hasMany('App\hoa_don_khuyen_mai','mahoadon','mahoadon');
    }

    public function ve(){
        return $this->hasMany('App\ve','mahoadon','mahoadon');
    }

    public function nhan_vien(){
        return $this->hasMany('App\nhan_vien','matk_nv','mahoadon');
    }

    public function khach_hang(){
        return $this->hasMany('App\khach_hang','matk_kh','mahoadon');
    }
}
