<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TaskProgress;
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
    public function index($id)
    {
        return view('taskprogress.index');
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


        $taskProgress = new TaskProgress;
        $taskProgress->user_id= $request->user_id;
        $taskProgress->task_id = $request->task_id;
        $taskProgress->lab_id = $request->lab;
        $taskProgress->status = 1;
        $taskProgress->save();

        return response(['status' => 'success']);
      }


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
