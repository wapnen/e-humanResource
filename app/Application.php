<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
   // protected $fillable = ['request_id', 'user_id', 'requestRow'];

    public function user(){
    	return $this->belongsTo('App\User');
    }


    public function request(){
    	return $this->belongsTo('App\Request');
    }

}
