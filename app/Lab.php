<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lab extends Model
{
  use SoftDeletes;

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
    return $this->belongsToMany('App\User', 'enrollments')->where('enrollments.deleted_at', null)->orderBy('surname')->orderBy('firstname')->orderBy('identifier');
  }

  // get list of tasks for the lab
  public function getTasks(){
    return $this->hasMany('App\Task');
  }

  public function getTotalMarks(){
    $total = 0;
    foreach($this->getTasks()->get() as $task){
      $total += $task->marks;
    }

    return $total;
  }
}
