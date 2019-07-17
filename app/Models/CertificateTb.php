<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateTb extends Model
{
    protected $fillable = ['user_id','name'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
