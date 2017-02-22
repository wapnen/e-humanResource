<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    //
    protected $fillable = ["title", "body", "expiry_date"];

    public function user(){
    	return $this->belongsTo('App\User');

    }

    public function department(){
    	return $this->belongsTo('App\Department');
    }
}
