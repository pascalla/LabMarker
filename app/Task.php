<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\ArchivedTaskProgress;
use App\ArchivedTask;
use App\TaskProgress;

class Task extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'lab_id', 'name', 'half_marks', 'full_marks', 'marks'
  ];

  public function archive($archived_lab){
    // archive the task
    $archived_task = new ArchivedTask;
    $archived_task->archived_lab_id = $archived_lab->id;
    $archived_task->name = $this->name;
    $archived_task->marks = $this->marks;
    $archived_task->half_marks = $this->half_marks;
    $archived_task->full_marks = $this->full_marks;
    $archived_task->save();

    // archive all progress for this task
    $progress = TaskProgress::where('task_id', $this->id)->get();
    foreach($progress as $task_progress){
      // Create new archived progress with archived lab/task
      $archived_progress = new ArchivedTaskProgress;
      $archived_progress->user_id = $task_progress->user_id;
      $archived_progress->archived_lab_id = $archived_lab->id;
      $archived_progress->archived_task_id = $archived_task->id;
      $archived_progress->status = $task_progress->status;
      $archived_progress->marks = $task_progress->marks;
      $archived_progress->save();

      // Delete old progress to reduce duplicate data
      $task_progress->delete();
    }
  }

}
