<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemoReceipient extends Model
{
    //

     public function memo(){
    	return $this->belongsTo('App\Memo');
    }
}
