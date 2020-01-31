<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortalStaffModelTb extends Model
{
    

    protected $primaryKey  = 'pstaff_id';
    protected $fillable    =['title','name','email','designation','message','avatar','is_active','user_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
