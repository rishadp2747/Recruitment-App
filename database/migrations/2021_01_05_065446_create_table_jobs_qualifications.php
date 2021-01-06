<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableJobsQualifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_qualifications', function (Blueprint $table) {
            $table->id();
            $table->string('Job_Id');
            $table->unsignedBigInteger('qualification')->nullable();
            $table->foreign('qualification')->references('id')->on('qualifications')->nullable();
            $table->string('course',100)->nullable();
            $table->string('specialisation',150)->nullable();
            $table->integer('cbacklogs')->nullable();
            $table->integer('hbacklogs')->nullable();
            $table->string('cgpa',50)->nullable();
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
        Schema::dropIfExists('jobs_qualifications');
    }
}
