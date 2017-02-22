<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    //
    protected $fillable = ['type'];

    public function food(){
    	return $this->belongsTo('App\Food');
    }

   
}
