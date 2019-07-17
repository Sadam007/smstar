<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherExamCenterAssignmentTb extends Model
{
    protected $primaryKey = 'teach_center_id';
    protected $fillable   = ['examcode','subcode','ccode','examiner_id','sec_user_id','is_assigned'];


    public function exams(){
    	return $this->belongTo('App\Models\ExamCodeTb');
    }
}
