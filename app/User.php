<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;
use App\Enrollment;

class User extends Authenticatable
{
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

    // Get Collection of labs that this user has enrolled in (past)
    public function archivedLabs(){
      return $this->belongsToMany('App\Lab', 'enrollments')->where('unenrollment_date', '!=', null);
    }

    // Get Collection of labs that this user is enrolled in (present)
    public function enrolledLabs(){
      return $this->belongsToMany('App\Lab', 'enrollments')->where('unenrollment_date', null);
    }

    // Get Collection of labs that this user is enrolled in (present)
    public function allLabs(){
      return $this->belongsToMany('App\Lab', 'enrollments');
    }

    // Check if user is enrolled in in lab.
    public function isEnrolled($lab){
      return $this->enrolledLabs()->get()->contains($lab);
    }

    public function getTaskProgress($task){
      return $this->hasMany('App\TaskProgress')->where('task_id', $task->id)->get();
    }

    public function joinedGroups(){
      return $this->belongsToMany('App\Group', 'group_members');
    }

    public function inGroup($group){
      return $this->joinedGroups()->get()->contains($group);
    }

    public function checkTaskProgress($task){
      //return $this->belongsToMany('App\TaskProgress', 'tasks_progress')->pluck('tasks_progress.task_id')->contains($task->id);
      return $this->hasMany('App\TaskProgress')->where('task_id', $task->id)->pluck('tasks_progress.task_id')->contains($task->id);
    }

    public function unenrollLab($lab){
      $enrollment = Enrollment::where('user_id', $this->id)->where('lab_id', $lab->id)->first();
      $enrollment->unenrollment_date = Carbon::now();
      $enrollment->save();
    }
}
