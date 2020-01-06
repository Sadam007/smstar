<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function sessions() {
        return $this->hasMany('App\Models\SessionTb');
    }

    public function colleges() {
        return $this->hasMany('App\Models\CollegeTb');
    }

    public function degrees() {
        return $this->hasMany('App\Models\DegreeTb');
    }

    public function specialusers() {
        return $this->hasMany('App\Models\SpecialUserTb');
    }

    /*public function staffs() {
        return $this->hasMany('App\StaffTb');
    }*/

    public function districts() {
        return $this->hasMany('App\Models\DistrictTb');
    }

    public function certificates() {
        return $this->hasMany('App\Models\CertificateTb');
    }

    public function degreesInColleges(){
        return $this->hasMany('App\Models\DegreesInCollegeTb');
    }

    public function subjects(){
        return $this->hasMany('App\Models\SubjectTb');
    }

    public function exams(){
        return $this->hasMany('App\Models\ExamCodeTb');
    }

    public function centrecodes(){
        return $this->hasMany('App\Models\CentreCodeTb');
    }

    public function secusers(){
        return $this->hasMany('App\Models\SecrecyTb');
    }
}
