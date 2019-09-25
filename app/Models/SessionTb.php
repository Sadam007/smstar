<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionTb extends Model
{
    protected $fillable = ['user_id','sessionCode','session','status','sessYear','startDate','endDate'];


    public function user() {
        return $this->belongsTo('App\User');
    }

    public function students() {
        return $this->hasMany('App\Models\StudentTb');
    }

}
