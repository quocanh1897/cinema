<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phien_ban extends Model
{
    protected $table = "phien_ban";

    public function phim(){
        return $this->belongsTo('App\phim','maphim','maphim');
    }
}
