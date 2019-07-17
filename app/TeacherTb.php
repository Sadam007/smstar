<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TeacherTb extends Authenticatable
{
    use Notifiable;

     protected $fillable = ['department_id','name','mobile','password','is_active'];

    protected $hidden = [
        'password', 'remember_token',
    ];

     public function college() {
        return $this->belongsTo('App\Models\CollegeTb');
    }

    public function subjectAssignment(){
        return $this->hasMany('App\Models\TeacherSubjectAssgnmentTb');
    }
}
