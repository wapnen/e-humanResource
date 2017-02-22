<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //


public function user(){
	return $this->hasMany('App\User' , 'department_id', 'id');
}

public function facilities(){
	return $this->hasMany('App\Facility' , 'department_id', 'id');
}

public function maintenance(){
	return $this->hasMany('App\Maintenance');
}

public function transport(){
	return $this->hasMany('App\Transport');
}

public function purchase(){
	return $this->hasMany('App\Purchase');
}

public function announcement(){
	return $this->hasMany('App\Announcement');
}

}
