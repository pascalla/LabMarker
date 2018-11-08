<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    public function show($lab_id, $user_id){
      $user = User::findOrFail($user_id);

      $lab = Lab::findOrFail($lab_id);

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
