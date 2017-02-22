<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //

    protected $fillable = ['delivery_site'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function department(){
    	return $this->belongsTo('App\Department');
    }
    public function item(){
    	return $this->hasMany('App\Purchase');
    }

    public function purchaseCheque(){
    	return $this->hasOne('App\PurchaseCheque');
    }
}
