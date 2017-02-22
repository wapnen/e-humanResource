<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = ['quanity' , 'unit' , 'unit_price', 'description'];

    public function purchase(){
    	return $this->belongsTo('App\Purchase');
    }
}
