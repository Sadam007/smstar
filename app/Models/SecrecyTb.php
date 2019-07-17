<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SecrecyTb extends Authenticatable
{
   use Notifiable;
   protected $primaryKey = 'sec_user_id';
    
	protected $fillable = ['user_id','username','password','status'];

	protected $hidden = [
        'password', 'remember_token',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
