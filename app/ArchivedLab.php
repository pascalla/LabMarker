<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchivedLab extends Model
{
  /**
  * The table associated with the model.
  *
  * @var string
  */
  protected $table = 'archived_labs';


  // get list of tasks for the archived lab
  public function getTasks(){
    return $this->hasMany('App\ArchivedTask');
  }

  //
  public function getTotalMarks(){
    $total = 0;
    foreach($this->getTasks()->get() as $task){
      $total += $task->marks;
    }
    return $total;
  }
}
