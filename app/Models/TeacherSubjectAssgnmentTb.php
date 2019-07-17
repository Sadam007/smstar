<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherSubjectAssgnmentTb extends Model
{
    
    protected $primaryKey  =  'teach_assign_id';
    protected $fillable    =  ['deg_admin_id','subject_code','examcode','teacher_id','department_id','is_assigned'];

    public function degAdmin(){
    	return $this->belongsTo('App\Models\DegreeAdminTb');
    }

    public function subject(){
    	return $this->belongsTo('App\Models\SubjectTb');
    }

    public function examcode(){
    	return $this->belongsTo('App\Models\ExamCodeTb');
    }

    public function teacher(){
    	return $this->belongsTo('App\TeacherTb');
    }


}
