<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CenterCodeTb extends Model
{
    
    protected $table   = 'center_codes_tbs';
    protected $primaryKey = 'ccode_id';

   	protected  $fillable  = ['user_id','ccode','examcode','cname'];

   		public function user(){
   		return $this->belongsTo('App\User');
   	}
}
