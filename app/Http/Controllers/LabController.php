<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Enrollment;
use App\Student;

use App\User;
use App\Lab;
use App\Task;
use Auth;

class LabController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:cosi');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $labs = Lab::all();
        return view('lab.index')->with('labs', $labs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lab.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $lab = new Lab;
        $lab->course_code = $request->course_code;
        $lab->lecturer_id = $user->id;
        $lab->save();


        return redirect()->route('lab.show', $lab->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        $lab = Lab::findOrFail($id);
        $markers = User::permission('marker ' . $lab->course_code)->get();

        $tasks = Task::where('lab_id', $lab->id)->get();

        $students = Enrollment::where('lab_id', $lab->id)->join('users', 'identifier', '=', 'users.id')->get(array('students.identifier'));

        return view('lab.show')->with('lab', $lab)->with('markers', $markers)->with('tasks', $tasks)->with('students', $students);
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
