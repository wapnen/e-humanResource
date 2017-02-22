<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    //make this model mass assignable
	protected $fillable = ['venue', 'type', 'duration'];

    //define relationship with user
    public function user(){
    	 return $this->belongsTo('App\User');
    }

    //define relationship with facility days
    public function facilityDays(){
    	return	$this->hasMany('App\FacilityDay');
    }

    public function department(){
         return $this->belongsTo('App\department');
    }
}
