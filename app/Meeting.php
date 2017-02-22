<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    //
            protected $fillable = ['title', 'type', 'venue', 'date' , 'time'];  

            //define relationships 

            public function member(){
            	return $this->hasMany('App\Member');
            }

            public function minute(){
            	return $this->hasOne('App\Minute');
            }

            public function user(){
            	return $this->belongsTo('App\User');
            }

}
