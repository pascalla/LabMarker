<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lab;
use App\Group;
use App\User;
use App\GroupMember;
use App\TaskProgress;
use App\Task;
use Session;

class GroupController extends Controller
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
        $groups = Group::where('lab_id', $lab->id)->get();
        return view('group.index')->with('lab', $lab)->with('groups', $groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lab_id)
    {
        $lab = Lab::findOrFail($lab_id);
        $students = $lab->enrolledStudents()->get();
        foreach($students as $student){
          $dropdown[$student->identifier] = $student->getDropDownName();
        }

        return view('group.create')->with('lab', $lab)->with('students', $dropdown);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $errors = array();

      $group = new Group;
      $group->name = $request->name;
      $group->lab_id = $request->lab;
      $group->save();

      $lab = Lab::findOrFail($request->lab);

      $studentsIdentifier = $request->input()["members"];

      foreach($studentsIdentifier as $studentIdentifier){
        $student = User::where('identifier', $studentIdentifier)->first();

        if(!$student){
          $errors[] = "Could not find student " . $studentIdentifier;
          continue;
        }

        if(!$student->isEnrolled($lab)) {
          $errors[] = $studentIdentifier ." is not enrolled in this lab.";
          continue;
        }

        $groupMember = new GroupMember;
        $groupMember->user_id = $student->id;
        $groupMember->group_id = $group->id;
        $groupMember->save();
      }

      Session::flash('success', 'You have created a new group, there was ' . count($errors) . ' errors creating the group.');
      return redirect()->route('group.index', $lab->id)->withErrors($errors);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($lab_id, $group_id)
    {
      $group = Group::findOrFail($group_id);
      $lab = Lab::findOrFail($lab_id);
      $tasks = $lab->getTasks()->get();
      $students = $group->getMembers()->get();
      $studentsProgress = array();

      foreach($students as $student){
        $progress = collect([]);

        foreach($tasks as $task) {
          if($student->checkTaskProgress($task)){
            $progress->push($student->getTaskProgress($task)->first());
          } else {
            $taskProgress = new TaskProgress;
            $taskProgress->user_id = $student->id;
            $taskProgress->lab_id = $lab->id;
            $taskProgress->task_id = $task->id;
            $taskProgress->status = 0;
            $progress->push($taskProgress);
          }
        }
        $studentsProgress[$student->identifier] = $progress;
      }


      return view('group.show')->with('group', $group)->with('lab', $lab)->with('students', $students)->with('tasks', $tasks)->with('studentsProgress', $studentsProgress);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($lab_id, $group_id)
    {
        $lab = Lab::findOrFail($lab_id);
        $group = Group::findOrFail($group_id);

        return view('group.edit')->with('lab', $lab)->with('group', $group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lab_id, $group_id)
    {
        $lab = Lab::findOrFail($lab_id);
        $group = Group::findOrFail($request->group_id);
        $group->name = $request->name;
        $group->save();

        Session::flash('success', 'You have successfully updated the group details.');
        return redirect()->route('group.edit', [$lab->id, $group->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lab_id, $group_id)
    {
        $group = Group::findOrFail($group_id);
        foreach($group->getMembers()->get() as $member){
          $member->delete();
        }
        $group->delete();

        return redirect()->route('group.index', [$lab_id, $group_id]);
    }
}
