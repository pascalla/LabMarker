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

  // Status Meanings
  // 0 - Incomplete
  // 1 - Complete Full Marks
  // 2 -- Complete Half Marks
  // 3 -- Complete No Marks

  /**
  * The table associated with the model.
  *
  * @var string
  */
  protected $table = 'tasks_progress';

  // Used for easier icon displaying
  // These relate to classes in foundation icons
  public function getProgressIcon(){
    switch($this->status){
      case '0':
        return 'fi-x red';
      case '1':
        return 'fi-check green';
      case '2':
        return 'fi-check amber';
      case '3':
        return 'fi-check red';
      default:
        return 'fi-x red';
    }
  }
}
