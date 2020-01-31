<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sliderTb extends Model
{
    
    protected $fillable   =  ['caption','body','link','img','is_active','user_id'];


    public function user(){
    	return $this->belongsTo('App\User');
    }
}
