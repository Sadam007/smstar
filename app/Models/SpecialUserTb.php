<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class SpecialUserTb extends Authenticatable
{
    use Notifiable;
    
	protected $fillable = ['user_id','department_id','username','password','status'];

	protected $hidden = [
        'password', 'remember_token',
    ];

	public function user() {
        return $this->belongsTo('App\User');
    }

    public function college() {
        return $this->belongsTo('App\Models\CollegeTb');
    }

    public function staffusers()
    {
        return $this->hasMany('App\Models\StaffTb');
    }

    public function degreeAdmins()
    {
        return $this->hasMany('App\Models\DegreeAdminTb');
    }

     public function degreeAdminsAsssignments()
    {
        return $this->hasMany('App\Models\DegreeAdminAssgnmentTb');
    }


}
