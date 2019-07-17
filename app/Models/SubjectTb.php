<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectTb extends Model
{
    protected $primaryKey = 'subject_id';
    protected $fillable = ['user_id','code','Na','Marks','sname','hours','Pmarks','sname2','degree_id','semester_id','is_active'];


    public function user() {
        return $this->belongsTo('App\User');
    }

    public function subjectAssignment(){
        return $this->hasMany('App\Models\TeacherSubjectAssgnmentTb');
    }
}
