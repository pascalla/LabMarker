<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivedTaskProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('archived_tasks_progress', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id');
          $table->integer('archived_lab_id');
          $table->integer('archived_task_id');
          $table->boolean('status');
          $table->float('marks');
          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archived_tasks_progress');
    }
}
