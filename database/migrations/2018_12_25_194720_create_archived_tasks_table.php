<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivedTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('archived_tasks', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('archived_lab_id');
          $table->string('name');
          $table->integer('marks');
          $table->date('half_marks')->nullable();
          $table->date('full_marks')->nullable();
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
        Schema::dropIfExists('archived_tasks');
    }
}
