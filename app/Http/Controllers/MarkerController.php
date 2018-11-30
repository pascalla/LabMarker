<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

use App\User;
use App\Auth;
use App\Lab;

class MarkerController extends Controller
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
        $markers = User::permission('marker ' . $lab->course_code)->get();
        return view('marker.index')->with('lab', $lab)->with('markers', $markers);
    }

    /**
     * Show the form for creating a new resource.
     *User::role($role)->get();
     * @return \Illuminate\Http\Response
     */
    public function create($lab_id)
    {
        $lab = Lab::findOrFail($lab_id);
        $students = User::role('student')->get();
        foreach($students as $student){
          $dropdown[$student->identifier] = $student->getDropDownName();
        }
        return view('marker.create')->with('lab', $lab)->with('students', $dropdown);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $lab = Lab::findOrFail($request->lab);
      $studentsIdentifier = $request->input()["students"];
      $errors = array();
      $markers = 0;

      foreach($studentsIdentifier as $studentIdentifier){
        $student = User::where('identifier', $studentIdentifier)->first();
        if($student->isEnrolled($lab)){
          $errors[] = $student->identifier . " is already enrolled as a student so can not be a marker.";
          continue;
        }
        $student->assignRole('marker');
        $student->givePermissionTo('marker ' . $lab->course_code);
        $markers++;
      }

      Session::flash('success', 'Successfully added ' . $markers . '  markers with ' . count($errors) . ' errors.');

      return redirect()->route('marker.create', $request->lab)->withErrors($errors);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
    public function destroy($lab_id, $student_id)
    {
        $lab = Lab::findOrFail($lab_id);
        $student = User::findOrFail($student_id);

        $lab->removeMarker($student);

        Session::flash('success', 'Successfully removed marker ' . $student->getDropDownName());
        return redirect()->route('marker.index', $lab->id);
    }

}
