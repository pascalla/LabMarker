<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Enrollment;
use App\Student;
use App\Task;
use App\TaskProgress;
use App\Lab;

class StudentController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('student.index')->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $student = new Student;
      $student->student_number = $request->student_number;
      $student->name = $request->student_name;
      $student->save();

      return redirect()->route('student.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studentData = array();
        $student = Student::findOrFail($id);
        $enrolled = Enrollment::where('student_id', $student->id)->get();
        //$enrolled = Enrollment::where('student_id', $student->id)->join('labs', 'labs.id', '=', 'enrollments.lab_id')->get(array('labs.id', 'labs.course_code'));
        foreach($enrolled as $lab){
          $tasks = Task::where('lab_id', $lab->lab_id)->get();
          $labInfo = Lab::where('id', $lab->lab_id)->get()->first();
          $studentData[] = array(
            'tasks' => $tasks,
            'lab' => $labInfo,
          );
        }

        return view('student.show')->with('student', $student)->with('studentData', $studentData);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
