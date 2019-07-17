<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StudentTb extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'student_id';
    protected $fillable = ['regno','department_id','session_id','degree_id','stdName','stdfName','dob','domicile','photo','address','email','contact','password','is_active'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function college(){
    	return $this->belongsTo('App\Models\CollegTb');
    }

    public function session(){
    	return $this->belongsTo('App\Models\SessionTb');
    }

    public function studentCertificates() {
        return $this->hasMany('App\Models\StduentCertificatesTb');
    }

    public function degree() {
        return $this->belongsTo('App\Models\DegreeTb');
    }

}
