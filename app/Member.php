<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $fillable = ['user_id'];

    public function meeting(){
    	return $this->belongsTo('App\Meeting');

    }

   
}
