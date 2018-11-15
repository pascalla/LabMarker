<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\StudentProgressExport;

use App\TaskProgress;
use App\Task;
use App\User;
use App\Lab;
use Carbon;
use Validator;

class TaskProgressController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct()
    {
        $this->middleware('auth:cosi');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lab_id)
    {
        $lab = Lab::findOrFail($lab_id);
        $tasks = $lab->getTasks()->get();
        $totalMarks = $lab->getTotalMarks();
        $students = $lab->enrolledStudents()->get();
        $studentProgress = array();


        foreach($students as $user) {
          $progress = collect([]);
          $marks = 0;

          foreach($tasks as $task){
            // If task has been completed (aka database entry, push it to array)
            if($user->checkTaskProgress($task)){
              $taskProgress = $user->getTaskProgress($task)->first();
              $progress->push($taskProgress);
              $marks += $taskProgress->marks;
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

          $studentProgress[] = array('student' => $user, 'progress' => $progress, 'marks' => $marks);
        }


        return view('taskprogress.index')->with('lab', $lab)->with('tasks', $tasks)->with('studentProgress', $studentProgress)->with('totalMarks', $totalMarks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'user_id' => 'required',
        'task_id' => 'required',
        'lab' => 'required',
        'status' => 'status'
      ]);

      if ($validator->fails()) {
        $errors = $validator->errors();
        return $errors->toJson();
      } else {
        $task = Task::findOrFail($request->task_id);

        // Check if we there are deadlines in place
        if(isset($task->full_marks) || isset($task->half_marks)){
          // If we are within the full marks deadline and its set give em full marks!
          if(time() < strtotime($task->full_marks) && isset($task->full_marks)){
            $marks = $task->marks;
            $status = 1;
          // If they didn't make full marks, but half marks, give em half marks!
          } else if(time() < strtotime($task->half_marks) && isset($task->half_marks)){
            $marks = $task->marks/2;
            $status = 2;
          // Otherwise they missed the deadline :( give em 0
          } else {
            $marks = 0;
            $status = 3;
          }
        }

        // If there was no deadlines, full marks for everyone!
        $marks = $task->marks;
        $status = 1;

        $taskProgress = new TaskProgress;
        $taskProgress->user_id= $request->user_id;
        $taskProgress->task_id = $request->task_id;
        $taskProgress->lab_id = $request->lab;
        $taskProgress->marks = $marks;
        $taskProgress->status = $status;

        $taskProgress->save();

        return response(['status' => 'success']);
      }


    }

    public function download($lab_id){
      return (new StudentProgressExport($lab_id))->download('studentprogress.xlsx');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
