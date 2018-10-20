<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Task;
use App\Lab;

use Session;

class TaskController extends Controller
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
    public function index($id)
    {
      $lab = Lab::findOrFail($id);
      $tasks = Task::all();
      return view('tasks.index')->with('lab', $lab)->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $lab = Lab::findOrFail($id);
      return view('tasks.create')->with('lab', $lab);
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
        'lab' => 'required',
        'name' => 'required',
        'marks' => 'required|numeric'
      ]);

      $task = new Task;
      $task->lab_id = $request->lab;
      $task->name = $request->name;
      $task->marks = $request->marks;

      if(isset($request->half)){
        $date = new Carbon($request->half_marks_date);
        $date = $date->toDateTimeString();
        $task->half_marks = $date;
      }

      if(isset($request->full)){
        $date = new Carbon($request->full_expiry_date);
        $date = $date->toDateTimeString();
        $task->full_marks = $date;
      }

      $task->save();

      return redirect()->route('task.index', $request->lab);
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
    public function edit($lab_id, $task_id)
    {
        $task = Task::findOrFail($task_id);
        $lab = Lab::findOrFail($lab_id);
        return view('tasks.edit')->with('task', $task)->with('lab', $lab);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $task = Task::findOrFail($request->task_id);
      $lab = Lab::findOrFail($request->lab);

      $request->validate([
        'lab' => 'required',
        'name' => 'required',
        'marks' => 'required|numeric'
      ]);

      $task->lab_id = $request->lab;
      $task->name = $request->name;
      $task->marks = $request->marks;

      if(isset($request->half)){
        $date = new Carbon($request->half_marks_date);
        $date = $date->toDateTimeString();
        $task->half_marks = $date;
      }

      if(isset($request->full)){
        $date = new Carbon($request->full_expiry_date);
        $date = $date->toDateTimeString();
        $task->full_marks = $date;
      }

      $task->save();

      Session::flash('success', 'Task has been updated.');
      return redirect()->route('task.edit', [$task->lab_id, $task->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lab_id, $task_id)
    {
        $task = Task::findOrFail($task_id);
        $task->delete();

        Session::flash('success', 'Task has been deleted.');

        return redirect()->route('task.index', $task->lab_id);
    }
}
