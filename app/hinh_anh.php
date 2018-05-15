<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hinh_anh extends Model
{
    protected $table = "hinh_anh";

    public function rap_chieu(){
        return $this->belongsTo('App\rap_chieu','marap','marap');
    }
}
