<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Reset cached roles and permissions
      app()['cache']->forget('spatie.permission.cache');

      /*
      * create permissions
      */

      // create student related permissions
      Permission::create(['guard_name' => 'cosi', 'name' => 'create student']);

      // create module related permissions
      Permission::create(['guard_name' => 'cosi', 'name' => 'create labs']);
      Permission::create(['guard_name' => 'cosi', 'name' => 'view labs']);

      // create marker related permissions
      Permission::create(['guard_name' => 'cosi', 'name' => 'create marker']);

      // create lecturer related permissions
      Permission::create(['guard_name' => 'cosi', 'name' => 'create lecturer']);

      // create admin permission (how to check if admin)
      Permission::create(['guard_name' => 'cosi', 'name' => 'admin']);

      // create admin related permissions
      Permission::create(['guard_name' => 'cosi', 'name' => 'create admin']);

      /*
      * create roles and assign created permissions
      */
      $role = Role::create(['guard_name' => 'cosi', 'name' => 'student']);

      // marker has no default permissions
      $role = Role::create(['guard_name' => 'cosi', 'name' => 'marker']);

      // lecturer has permission to create modules and add markers
      $role = Role::create(['guard_name' => 'cosi', 'name' => 'lecturer']);
      $role->givePermissionTo(['create labs', 'create marker']);

      // overseer has permission to view modules
      $role = Role::create(['guard_name' => 'cosi', 'name' => 'overseer']);
      $role->givePermissionTo(['view labs']);

      // overseer has permission to view modules
      $role = Role::create(['name' => 'admin']);
      $role->givePermissionTo(Permission::all());
    }
}
