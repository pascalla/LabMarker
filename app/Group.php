<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{


  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name',
  ];


  // Get list of members in group
  public function getMembers(){
    return $this->belongsToMany('App\User', 'group_members')->orderBy('surname')->orderBy('firstname')->orderBy('identifier');
  }
}
