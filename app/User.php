<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;
use App\Enrollment;
use App\ArchivedEnrollment;

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
      return $this->belongsToMany('App\ArchivedLab', 'archived_enrollments');
    }

    // Get Collection of labs that this user is enrolled in (present)
    public function enrolledLabs(){
      return $this->belongsToMany('App\Lab', 'enrollments');
    }


    // Check if user is enrolled in in lab.
    public function isEnrolled($lab){
      return $this->enrolledLabs()->get()->contains($lab);
    }

    // Returns Task Progress object of given task for user
    public function getTaskProgress($task){
      return $this->hasMany('App\TaskProgress')->where('task_id', $task->id)->get();
    }

    // Returns Archived Task Progress object of given task for user
    public function getArchivedTaskProgress($task){
      return $this->hasMany('App\ArchivedTaskProgress')->where('archived_task_id', $task->id)->get();
    }

    // Returns Collection of groups
    public function joinedGroups(){
      return $this->belongsToMany('App\Group', 'group_members');
    }

    // Check if user is in group
    public function inGroup($group){
      return $this->joinedGroups()->get()->contains($group);
    }

    // Check Task Progress of given Task for User
    public function checkTaskProgress($task){
      //return $this->belongsToMany('App\TaskProgress', 'tasks_progress')->pluck('tasks_progress.task_id')->contains($task->id);
      return $this->hasMany('App\TaskProgress')->where('task_id', $task->id)->pluck('tasks_progress.task_id')->contains($task->id);
    }

    // Check Archived Task Progress of given Task for User
    public function checkArchivedTaskProgress($task){
      //return $this->belongsToMany('App\TaskProgress', 'tasks_progress')->pluck('tasks_progress.task_id')->contains($task->id);
      return $this->hasMany('App\ArchivedTaskProgress')->where('archived_task_id', $task->id)->pluck('archived_tasks_progress.archived_task_id')->contains($task->id);
    }

    // Unenrolls student from a lab
    public function unenrollLab($lab, $archived_lab){
      // get enrollment
      $enrollment = Enrollment::where('user_id', $this->id)->where('lab_id', $lab->id)->first();
      // create archived enrollment
      $archived_enrollment = new ArchivedEnrollment;
      $archived_enrollment->user_id = $this->id;
      $archived_enrollment->archived_lab_id = $archived_lab->id;
      $archived_enrollment->unenrollment_date = Carbon::now();
      $archived_enrollment->save();

      // archive tasks

      // delete old enrollment, no need for duplicate data
      $enrollment->delete();
    }
}
