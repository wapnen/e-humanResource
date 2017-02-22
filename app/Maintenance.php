<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    //


	protected $fillable = ['facility_name', 'location', 'phone' , 'type' , 'subtype' , 'description'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function department(){
    	return $this->belongsTo('App\Department');
    }
}
