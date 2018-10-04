<?php

use Illuminate\Database\Seeder;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Student;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $lecturer = new User;
        // $lecturer->name = "Monika";
        // $lecturer->email = "monika@swansea.ac.uk";
        // $lecturer->password = Hash::make('sexy');
        // $lecturer->save();
        //
        // $lecturer->assignRole('overseer');

        // $marker = new User;
        // $marker->name = "Marker Dennis";
        // $marker->email = "marker2@swansea.ac.uk";
        // $marker->password = Hash::make('changeme123');
        // $marker->save();
        //
        // $marker->assignRole('marker');

        $student = new Student;
        $student->student_number = 42069;
        $student->name = "Boshua Jackman";
        $student->save();

    }
}
