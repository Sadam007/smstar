<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DegreesInCollegeTb extends Model
{
    protected $fillable = ['user_id','college_id','degree_id','regStart','sets'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function college(){
    	return $this->belongsTo('App\Models\CollegTb');
    }

    public function degrees(){
    	return $this->belongsTo('App\Models\DegreeTb');
    }
}
