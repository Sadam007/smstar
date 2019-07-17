<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StaffTb extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['user_id','department_id','username','password','status','password_change_at'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function collegestaff() {
        return $this->belongsTo('App\Models\SpecialUserTb');
    }
    
    public function college() {
        return $this->belongsTo('App\Models\CollegeTb');
    }
}
