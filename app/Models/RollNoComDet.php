<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RollNoComDet extends Model
{
    protected $primaryKey = 'roll_no_com_det_id';

    protected $fillable   = ['rollno','examcode','subcode','FicRollNo','obt40','obt60','obtPrac','obtTot','resStatus'];
}
