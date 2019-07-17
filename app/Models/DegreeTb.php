<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DegreeTb extends Model
{
    
    protected $fillable = ['user_id','M_Title','Det1','DegCode'];

	public function user() {
        return $this->belongsTo('App\User');
    }

    public function degreesInColleges() {
        return $this->hasMany('App\Models\DegreesInCollegeTb');
    }

    public function students() {
        return $this->hasMany('App\Models\StudentTb');
    }

    public function degreeAdminsAssignments() {
        return $this->hasMany('App\Models\DegreeAdminAssgnmentTb');
    }  

}
