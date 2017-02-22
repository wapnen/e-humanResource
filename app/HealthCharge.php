<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthCharge extends Model
{
    //
    protected $fillable = ['patient_name' , 'folder_no' , 'account_type', 'account_code' , 'phone' ,  'total'];

    public function healthService(){
    	return $this->hasMany('App\HealthService');
    }
}
