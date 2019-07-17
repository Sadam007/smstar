<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeTb extends Model
{
    protected $fillable = ['college_id','user_id','name','address','district','regStart'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function specialusers() {
        return $this->hasMany('App\Models\SpecialUserTb');
    }

    public function teachers() {
        return $this->hasMany('App\TeacherTb');
    }

    public function degreesInColleges() {
        return $this->hasMany('App\Models\DegreesInCollegeTb');
    }

    public function students() {
        return $this->hasMany('App\Models\StudentTb');
    }

    public function degreeAdmins() {
        return $this->hasMany('App\Models\DegreeAdminTb');
    }

    public function degreeAdminsAsignments(){
        return $this->hasMany('App\Models\DegreeAdminAssgnmentTb');
    }
}
