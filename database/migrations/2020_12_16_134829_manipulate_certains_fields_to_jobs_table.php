<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ManipulateCertainsFieldsToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('Salary');
            $table->dropColumn('Min_Qualification');
            $table->dropColumn('Project_Description');
            $table->string('Skills_Required')->nullable()->change();
            $table->integer('Min_Age')->nullable()->change();
            $table->integer('Max_Age')->nullable()->change();
            $table->integer('cbacklogs')->nullable();
            $table->integer('hbacklogs')->nullable();
            $table->unsignedBigInteger('qualification')->nullable();
            $table->foreign('qualification')->references('id')->on('qualifications')->nullable();
            $table->string('course',100)->nullable();
            $table->string('cgpa',50)->nullable();
            $table->date('last_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->double('Salary');
            $table->string('Min_Qualification');
            $table->string('Project_Description');
            $table->dropColumn('cbacklogs');
            $table->dropColumn('hbacklogs');
            $table->dropColumn('qualification');
            $table->dropColumn('course');
            $table->dropColumn('cgpa');
            $table->dropColumn('last_date');
        });
    }
}
