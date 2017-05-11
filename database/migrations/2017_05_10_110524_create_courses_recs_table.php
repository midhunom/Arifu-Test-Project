<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesRecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses_recs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('course_id');
            $table->date('joined_at');
            $table->string('status', 20)->default('start');

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
        Schema::dropIfExists('courses_recs');
    }
}
