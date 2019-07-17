<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DegreeAdminAssgnmentTb extends Model
{
    protected $primaryKey  = 'admin_assign_id';

    protected $fillable = ['specialuser_id','department_id','degree_id','degree_admin_id','is_assigned'];


    public function specialuser() {
        return $this->belongsTo('App\Models\SpecialUserTb');
    }

    public function college(){
    	return $this->belongsTo('App\Models\CollegeTb');
    }

    public function degree(){
    	return $this->belongs('App\Models\DegreeTb');
    }

    public function degreeadmin(){
    	return $this->belongsTo('App\Models\DegreeAdminTb');
    }

}
