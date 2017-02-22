<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseCheque extends Model
{
    //
    protected $fillable = ['name' , 'ammount' , 'reciept'];

    public function purchase(){
    	return $this->belongsTo('App\Purchase');
    }
    
}
