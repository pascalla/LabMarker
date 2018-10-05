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
      $user->name = "Joshua Blackman";
      $user->email = "jhawsh@gmail.com";
      $user->password = Hash::make('changeme123');
      $user->save();

      $user->assignRole('system-admin');

      $user = new User;
      $user->name = "Stewart Powell";
      $user->email = "stewart.powell@technocamps.com";
      $user->password = Hash::make('password');
      $user->save();

      $user->assignRole('system-admin');
    }
}
