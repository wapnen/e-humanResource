<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{

     protected $fillable = ['outstanding_leave', 'days_taken', 'leave_due', 'days_approved', 'from', 'to', 'resumption_date', 'money_entitled' , 'leave_contact','hometown', 'house_no', 'contact_name', 'address'];

     public function user(){
     	return $this->hasMany('App\Leave');
     }
}
