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
        $markers = User::role('marker')->get();
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

      foreach($studentsIdentifier as $studentIdentifier){
        $student = User::where('identifier', $studentIdentifier)->first();
        $student->assignRole('marker');
        $student->givePermissionTo('marker ' . $lab->course_code);
      }

      Session::flash('success', 'Successfully added markers');

      return redirect()->route('marker.create', $request->lab);
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
    public function destroy($id)
    {
        //
    }


    public function assignLabMarker(Request $request){

    }
}
