<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CenterCodesTb extends Model
{
    protected $primaryKey  = 'ccode_id';
    protected $fillable		 = ['user_id','ccode','examcode','cname'];
}
