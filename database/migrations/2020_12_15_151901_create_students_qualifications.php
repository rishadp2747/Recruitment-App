<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsQualifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_qualifications', function (Blueprint $table) {
            $table->id();
            $table->string('course',100);
            $table->string('cgpa',50);
            $table->string('board',200);
            $table->string('institution',200);
            $table->date('join');
            $table->date('pass');
            $table->integer('cbacklogs');
            $table->integer('hbacklogs');
            $table->unsignedBigInteger('qualification');
            $table->foreign('qualification')->references('id')->on('qualifications');
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
        Schema::dropIfExists('students_qualifications');
    }
}
