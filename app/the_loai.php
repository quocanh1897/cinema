<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class the_loai extends Model
{
    protected $table = "the_loai";

    public function phim(){
        return $this->belongsTo('App\phim','maphim','maphim');
    }
}
