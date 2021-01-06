<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteCertainFieldsOnJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeign('jobs_qualification_foreign');
            $table->dropColumn('qualification');
            $table->dropColumn('cbacklogs');
            $table->dropColumn('hbacklogs');
            $table->dropColumn('course');
            $table->dropColumn('cgpa');
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
            $table->integer('cbacklogs')->nullable()->change();
            $table->integer('hbacklogs')->nullable()->change();
            $table->unsignedBigInteger('qualification')->nullable()->change();
            $table->foreign('qualification')->references('id')->on('qualifications')->nullable()->change();
            $table->string('course',100)->nullable()->change();
            $table->string('cgpa',50)->nullable()->change();
        });
    }
}
