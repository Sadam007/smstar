<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StduentCertificatesTb extends Model
{
    protected $fillable = ['regno','metric','metricGroup','metricRollNo','metricYear','metricObtMarks','metricTotMarks','metricInstitute','metricBoard','fsc','fscGroup','fscRollNo','fscYear','fscObtMarks','fscTotMarks','fscInstitute','fscBoard','bsc','bscGroup','bscRollNo','bscYear','bscObtMarks','bscTotMarks','bscInstitute','bscBoard'];


    public function student(){
    	return $this->belongsTo('App\Models\StudentTb');
    }
    
}
