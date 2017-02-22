<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Cmgmyr\Messenger\Traits\Messagable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use Messagable;
    
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function facilities(){
        return $this->hasMany('App\Facility' );
    }

    public function applications(){
        return $this->hasMany('App\Application');
    }

    public function department(){
        return $this->belongsTo('App\Department');
    }

    public function food(){
        return $this->hasMany('App\Food');
    }

    public function maintenance(){
        return $this->hasMany('App\Maintenance');
    }

    public function meeting(){
        return $this->hasMany('App\Meeting');
        
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

    public function memo(){
        return $this->hasMany('App\Memo');
    }

}
