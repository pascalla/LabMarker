<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lab;
use App\Group;
use App\User;
use App\GroupMember;

use Session;

class GroupMemberController extends Controller
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
    public function create($lab_id, $group_id)
    {
        $lab = Lab::findOrFail($lab_id);
        $group = Group::where([
          ['lab_id', '=', $lab->id],
          ['id', '=', $group_id]
        ])->first();

        if(!$group){
          abort(404);
        }

        $students = $lab->enrolledStudents()->get();
        $dropdown = array();
        foreach($students as $student){
          $dropdown[$student->identifier] = $student->getDropDownName();
        }
        return view('group.create')->with('lab', $lab)->with('group', $group)->with('students', $dropdown);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $lab_id, $group_id)
    {
      $errors = array();
      $members = 0;
      $group = Group::findOrFail($group_id);
      $lab = Lab::findOrFail($lab_id);

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

        // @// TODO: Check if already in the group
        if($student->inGroup($group)){
          $errors[] = $studentIdentifier . " is already in this group.";
          continue;
        }

        $groupMember = new GroupMember;
        $groupMember->user_id = $student->id;
        $groupMember->group_id = $group->id;
        $groupMember->save();

        $members++;
      }

      Session::flash('success', 'You have added ' . $members . ' new members to the group, there was ' . count($errors) . ' errors creating the group.');
      return redirect()->route('groupmember.create', [$lab->id, $group->id])->withErrors($errors);
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
    public function destroy($lab_id, $group_id, $student_id)
    {
        $member = GroupMember::where([
          ['group_id', '=', $group_id],
          ['user_id', '=', $student_id]
        ])->first();

        $member->delete();

        Session::flash('success', 'Student has been deleted from the lab');

        return redirect()->route('group.index', $lab_id);
    }
}
