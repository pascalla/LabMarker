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
        // Generate Overseer
        // Probably should of used factories for this

        $overseer = new User;
        $overseer->name = "Monika";
        $overseer->email = "monika@swansea.ac.uk";
        $overseer->password = Hash::make('pass');
        $overseer->save();
        $overseer->assignRole('overseer');

        // Generate some Markers

        $marker = new User;
        $marker->name = "Marker Dennis";
        $marker->email = "marker1@swansea.ac.uk";
        $marker->password = Hash::make('pass');
        $marker->save();
        $marker->assignRole('marker');

        $marker = new User;
        $marker->name = "Marker George";
        $marker->email = "marker2@swansea.ac.uk";
        $marker->password = Hash::make('pass');
        $marker->save();
        $marker->assignRole('marker');

        // Generate some Lecturers

        $lecturer = new User;
        $lecturer->name = "lecturer Daniel";
        $lecturer->email = "lecturer1@swansea.ac.uk";
        $lecturer->password = Hash::make('pass');
        $lecturer->save();
        $lecturer->assignRole('lecturer');

        $lecturer = new User;
        $lecturer->name = "lecturer Jim";
        $lecturer->email = "lecturer2@swansea.ac.uk";
        $lecturer->password = Hash::make('pass');
        $lecturer->save();
        $lecturer->assignRole('lecturer');

        // Generate some students

        $student = new Student;
        $student->student_number = 123456;
        $student->name = "Boshua Jackman";
        $student->save();

        $student = new Student;
        $student->student_number = 654321;
        $student->name = "James McGill";
        $student->save();

        $student = new Student;
        $student->student_number = 321456;
        $student->name = "George White";
        $student->save();

    }
}
