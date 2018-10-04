<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class TaskProgress extends Model
{

  use SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id', 'task_id', 'status',
  ];

  /**
  * The table associated with the model.
  *
  * @var string
  */
  protected $table = 'tasks_progress';
}
