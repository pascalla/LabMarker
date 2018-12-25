<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\UsersTemplateExport;

use App\Lab;
use App\User;
use App\TaskProgress;
use App\Task;
use Session;
use App\Imports\UsersImport;
use Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lab_id)
    {

      $lab = Lab::findOrFail($lab_id);
      $groups = $lab->getGroups()->get();

      $students = $lab->enrolledStudents()->get();

      return view('student.index')->with('lab', $lab)->with('students', $students)->with('groups', $groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'students' => 'required|mimes:xlsx,csv',
      ]);

      $errors = array();
      $userCount = 0;
      $users = (new UsersImport)->toCollection($request->file('students'))[0];
      foreach($users as $user){

        if(User::where('identifier', $user[0])->first()){
          $errors[] = "A user with the id of " . $user[0] . " already exists.";
          continue;
        }

        $student = new User;
        $student->identifier = $user[0];
        $student->firstname = $user[1];
        $student->surname = $user[2];
        $student->save();

        $userCount++;
      }

      Session::flash('success', 'You have created ' . $userCount .' student accounts with ' . count($errors) . ' errors');
      return redirect()->route('student.create')->withErrors($errors);
    }

    public function template(){
      return Excel::download(new UsersTemplateExport, 'template.xlsx');
    }

    public function show($lab_id, $user_id){
      $user = User::findOrFail($user_id);
      $lab = Lab::findOrFail($lab_id);

      // make sure student is enrolled
      if(!$user->isEnrolled($lab)){
        return redirect()->route('student.index', $lab_id);
      }

      // get labs
      $tasks = $lab->getTasks()->get();

      $progress = collect([]);

      foreach($tasks as $task){
        // If task has been completed (aka database entry, push it to array)
        if($user->checkTaskProgress($task)){
          $progress->push($user->getTaskProgress($task)->first());
        // else create a new task progress with status 0 and push to array
        } else {
          $taskProgress = new TaskProgress;
          $taskProgress->user_id = $user->id;
          $taskProgress->lab_id = $lab->id;
          $taskProgress->task_id = $task->id;
          $taskProgress->status = 0;
          $progress->push($taskProgress);
        }

      }

      return view('student.show')->with('lab', $lab)->with('user', $user)->with('progress', $progress)->with('tasks', $tasks);
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
