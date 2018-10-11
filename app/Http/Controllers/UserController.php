<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\User;

use Session;

class UserController extends Controller
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
    public function index()
    {
        $usersGrouped = array();
        $roles = \Spatie\Permission\Models\Role::all()->reverse();
        foreach($roles as $role){
          $users = User::role($role)->get(); // Returns only users with the role 'writer'
          $usersGrouped[$role->name] = $users;
        }

        return view('user.index')->with('users', $usersGrouped);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->identifier = $request->identifier;
        $user->save();


        // Permission handling
        switch($request->role){
          case 'Marker':
            $user->assignRole('marker');
            break;
          case 'Lecturer':
            $user->assignRole('lecturer');
            break;
          case 'Overseer':
            $user->assignRole('overseer');
            break;
          case 'Admin':
            $user->assignRole('admin');
            break;
          default:
            $user->assignRole('student')
            break;
        }

        Session::flash('success', 'You have created the user account \'' . $user->name . '\'');

        return redirect()->route('user.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = User::findOrFail($id);
      return view('user.show')->with('user', $user);
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
