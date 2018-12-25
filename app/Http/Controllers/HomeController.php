<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use App\TaskProgress;
use App\Task;
use App\User;
use App\Lab;
use Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labs = Lab::all();

        $user = Auth::user();

        $studentLabs = array();
        $archivedStudentLabs = array();

        foreach($user->enrolledLabs()->get() as $lab){
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

          $studentLabs[] = array('lab' => $lab, 'tasks' => $tasks, 'progress' => $progress);

        }

        foreach($user->archivedLabs()->get() as $lab){
          $tasks = $lab->getTasks()->get();
          $progress = collect([]);

          foreach($tasks as $task){
            // If task has been completed (aka database entry, push it to array)
            if($user->checkArchivedTaskProgress($task)){
              $progress->push($user->getArchivedTaskProgress($task)->first());
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
          $archivedStudentLabs[] = array('lab' => $lab, 'tasks' => $tasks, 'progress' => $progress);
        }

        return view('home')->with('labs', $labs)->with('studentLabs', $studentLabs)->with('archivedLabs', $archivedStudentLabs);
    }
}
