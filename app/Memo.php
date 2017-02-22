<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    //
    protected $fillable = ['receiver_type' , 'subject'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function memoBody(){
    	return $this->hasMany('App\MemoBody');
    }

    public function memoReceipient(){
    	return $this->hasMany('App\MemoReceipient');
    }

}
