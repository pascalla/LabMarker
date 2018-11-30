<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'lecturer_id', 'course_code', 'year'
  ];

  // Get list of Enrolled students in Lab
  public function enrolledStudents(){
    return $this->belongsToMany('App\User', 'enrollments')->where('unenrollment_date', null)->orderBy('surname')->orderBy('firstname')->orderBy('identifier');
  }

  public function removeMarker($student){
    if($student->hasPermissionTo('marker ' . $this->course_code)) {
      $student->revokePermissionTo('marker ' . $this->course_code);
    }

    $permissions = $student->getAllPermissions();

    if($permissions->count() == 0){
      $student->removeRole('marker');
    }
  }

  // get list of tasks for the lab
  public function getTasks(){
    return $this->hasMany('App\Task');
  }

  // get list of tasks for the lab
  public function getGroups(){
    return $this->hasMany('App\Group');
  }

  public function getTotalMarks(){
    $total = 0;
    foreach($this->getTasks()->get() as $task){
      $total += $task->marks;
    }

    return $total;
  }
}
