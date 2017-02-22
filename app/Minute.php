<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minute extends Model
{
    //
	protected $fillable = ['filename' , 'meeting_id'];
    public function meeting(){
    	return $this->belongsTo('App\Meeting');
    }
}
