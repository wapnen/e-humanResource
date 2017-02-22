<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemoBody extends Model
{
    //

    public function memo(){
    	return $this->belongsTo('App\Memo');
    }
}
