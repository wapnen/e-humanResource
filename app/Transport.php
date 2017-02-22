<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    //

    protected $fillable = ['purpose' , 'destination', 'flight_no' , 'vehicle' , 'country' , 'no_of_passengers' , 'qty_goods' , 'departure_date' , 'departure_time', 'return_date', 'return_time' , 'type_of_service'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function department(){
    	return $this->belongsTo('App\Department');
    }
}
