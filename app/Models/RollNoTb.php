<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RollNoTb extends Model
{
    protected $primaryKey  = 'roll_no_id';
    protected $fillable    = ['regno','rollno','examcode','part','ccode','colcode','result','resultStatus'];
}
