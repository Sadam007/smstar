<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentreCodeTb extends Model
{
   	protected $primaryKey = 'center_id';

   	protected  $fillable  = ['user_id','ccode','examcode','name_of_centre'];


   	public function user(){
   		return $this->belongsTo('App\User');
   	}
}
