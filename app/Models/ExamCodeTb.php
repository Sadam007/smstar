<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamCodeTb extends Model
{
    protected $primaryKey = 'exam_id';

    protected $fillable = ['user_id','examcode','description','type','session','is_active','is_odd'];


    public function user() {
        return $this->belongsTo('App\User');
    }

    public function subjectAssignment(){
        return $this->hasMany('App\Models\TeacherSubjectAssgnmentTb');
    }

    public function examcenters(){
    	return $this->hasMany('App\Models\TeacherExamCenterAssignmentTb');
    }
}
