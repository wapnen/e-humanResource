<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacilityDay extends Model
{
    //make variables mass assignable 
    protected $fillable = ['date' , 'time'];

    //define relationship with facility model

    public function facility(){
    	return 	$this->belongsTo('App\Facility' );
    }

}
