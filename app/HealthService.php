<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthService extends Model
{
    //
    protected $fillable = ['type' , 'ammount'];

    public function healthCharge(){
    	return $this->belongsTo('App\healthCharge');
    }
}
