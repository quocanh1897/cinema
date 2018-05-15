<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dien_vien extends Model
{
    protected $table = "dien_vien";

    public function phim(){
        return $this->belongsTo('App\phim','maphim','maphim');
    }

}
