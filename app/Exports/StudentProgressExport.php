<?php

namespace App\Exports;

use App\User;
use App\TaskProgress;
use App\Task;
use App\Lab;
use App\Dynamic;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StudentProgressExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function __construct($lab_id)
    {
        $this->lab_id = $lab_id;
    }

    public function view(): View
    {
      $collection = collect([]);

      $lab = Lab::findOrFail($this->lab_id);
      $tasks = $lab->getTasks()->get();
      $totalMarks = $lab->getTotalMarks();
      $students = $lab->enrolledStudents()->get();



      foreach($students as $student){
        $studentProgress = new Dynamic;
        $studentProgress->identifier = $student->identifier;
        $studentProgress->firstname = $student->firstname;
        $studentProgress->surname = $student->surname;
        $marks = 0;
        $totalMarks = 0;

        foreach($tasks as $task){
          $totalMarks += $task->marks;
          if($student->checkTaskProgress($task)){
            $taskProgress = $student->getTaskProgress($task)->first();
            $studentProgress->{$task->name} = $taskProgress->marks;
            $marks += $taskProgress->marks;
          } else {
            $studentProgress->{$task->name} = 0;
          }
        }

        $studentProgress->totalMarks = $marks;
        $studentProgress->totalMarksPercentage = ($marks/$totalMarks)*100;

        $collection->push($studentProgress);
      }


      return view('exports.studentprogress', [
          'tasks' => $tasks,
          'studentProgress' => $collection,
      ]);
    }

}
