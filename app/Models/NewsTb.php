<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsTb extends Model
{
    protected $primaryKey  = 'news_id';
    protected $fillable    = ['title','body','attachment','published_on','is_active','user_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
