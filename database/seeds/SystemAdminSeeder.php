<?php

use Illuminate\Database\Seeder;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SystemAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new User;
      $user->identifier = "921340";
      $user->firstname = "Joshua";
      $user->surname = "Blackman";
      $user->save();
      $user->assignRole('admin');

      $user = new User;
      $user->identifier = "s.w.powell";
      $user->firstname = "Stewart";
      $user->surname = "Powell";
      $user->save();
      $user->assignRole('admin');
    }
}
