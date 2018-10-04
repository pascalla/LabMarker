<?php

namespace App\Observers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\User;

use App\Lab;

class LabObserver
{
    /**
     * Handle the lab "created" event.
     *
     * @param  \App\Lab  $lab
     * @return void
     */
    public function created(Lab $lab)
    {
      // Reset cached roles and permissions
      app()['cache']->forget('spatie.permission.cache');

      // Create roles for module (marker, lecturer)
      Permission::create(['name' => 'marker ' . $lab->course_code]);
      Permission::create(['name' => 'lecturer ' . $lab->course_code]);
      Permission::create(['name' => 'view ' . $lab->course_code]);

      // give lecturer the lecturer permission
      $lecturer = User::findOrFail($lab->lecturer_id);
      $lecturer->givePermissionTo('lecturer ' . $lab->course_code);
      $lecturer->givePermissionTo('view ' . $lab->course_code);
      $lecturer->givePermissionTo('marker ' . $lab->course_code);

    }

    /**
     * Handle the lab "updated" event.
     *
     * @param  \App\Lab  $lab
     * @return void
     */
    public function updated(Lab $lab)
    {
        //
    }

    /**
     * Handle the lab "deleted" event.
     *
     * @param  \App\Lab  $lab
     * @return void
     */
    public function deleted(Lab $lab)
    {
        //
    }

    /**
     * Handle the lab "restored" event.
     *
     * @param  \App\Lab  $lab
     * @return void
     */
    public function restored(Lab $lab)
    {
        //
    }

    /**
     * Handle the lab "force deleted" event.
     *
     * @param  \App\Lab  $lab
     * @return void
     */
    public function forceDeleted(Lab $lab)
    {
        //
    }
}
