<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identifier', 'firstname', 'surname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    // Get name for dropdown
    public function getDropDownName(){
      return $this->surname . ', ' . $this->firstname . ' (' . $this->identifier . ')';
    }

    // Get Collection of labs that this user has enrolled in (past and present)
    public function enrolledLabs(){
      return $this->belongsToMany('App\Lab', 'enrollments');
    }

    // Check if user is enrolled in in lab.
    public function isEnrolled($lab){
      return $this->enrolledLabs()->where('deleted_at', null)->get()->contains($lab);
    }
}
