<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToStudentdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('studentdetails', function (Blueprint $table) {
            $table->string('Qualifications',400)->change();
            $table->string('Certificates',200);
            $table->string('Volunteership',300);
            $table->string('Linkedin',150);
            $table->string('Github',150);
            $table->string('Backlogs',300);
            $table->string('Current_Backlogs',200);
            $table->string('Experience',300);
            $table->string('Graduation',200);
            $table->string('Post_Graduation',200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('studentdetails', function (Blueprint $table) {
            $table->string('Qualifications',200)->change();
            $table->dropColumn('Certificates');
            $table->dropColumn('Volunteership');
            $table->dropColumn('Linkedin');
            $table->dropColumn('Github');
            $table->dropColumn('Backlogs');
            $table->dropColumn('Current_Backlogs');
            $table->dropColumn('Experience');
            $table->dropColumn('Graduation');
            $table->dropColumn('Post_Graduation');
        });
    }
}
