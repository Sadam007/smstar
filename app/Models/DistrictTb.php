<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistrictTb extends Model
{
    
    protected $fillable = ['user_id','name'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
