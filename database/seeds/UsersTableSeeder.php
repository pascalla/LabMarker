<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Student;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $students = factory(App\User::class, 100)->make();

      $students->each(function($student) {
          $student->assignRole('student');
          $student->save();
      });


      $lecturers = factory(App\User::class, 5)->make();

      $lecturers->each(function($lecturer) {
          $lecturer->assignRole('lecturer');
          $lecturer->save();
      });
    }
}
