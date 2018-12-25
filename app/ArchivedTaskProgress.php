<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchivedTaskProgress extends Model
{
  /**
  * The table associated with the model.
  *
  * @var string
  */
  protected $table = 'archived_tasks_progress';

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
