<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    //
    protected $fillable =['phone', 'purpose', 'delivery_date' , 'delivery_time' , 'people'];

    public function foodType(){
		return $this->hasMany('App\FoodType');
	}

	 public function user(){
    	return $this->belongsTo('App\User');
    }

    
}


	