<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DegreeAdminTb extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'degree_admin_id';

    protected $fillable   = ['create_user_id','department_id','username','password','status'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function specialUser() {
        return $this->belongsTo('App\Models\SpecialUserTb');
    }

    public function college() {
        return $this->belongsTo('App\Models\CollegeTb');
    }

    public function degreeAdminsAssignment(){
        return $this->hasMany('App\Models\DegreeAdminAssgnmentTb');
    }

    public function subjectAssignment(){
        return $this->hasMany('App\Models\TeacherSubjectAssgnmentTb');
    }
    
}
