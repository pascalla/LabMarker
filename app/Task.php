<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
