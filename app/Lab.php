<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\ArchivedLab;

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

  public function archiveLab(){
    // Create new Archived Lab
    $archived_lab = new ArchivedLab;
    $archived_lab->lecturer_id = $this->lecturer_id;
    $archived_lab->course_code = $this->course_code;
    $archived_lab->year = $this->year;
    $archived_lab->save();

    $tasks = $this->getTasks()->get();
    foreach($tasks as $task){
      $task->archive($archived_lab);
    }

    return $archived_lab;
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
