<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNew2FieldsToStudentdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('studentdetails', function (Blueprint $table) {
            $table->dropColumn('Backlogs');
            $table->dropColumn('Current_Backlogs');
            $table->string('Gender',20);
            $table->string('Asap_Skills',300);
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
            $table->string('Backlogs',300);
            $table->string('Current_Backlogs',200);
            $table->dropColumn('Gender');
            $table->dropColumn('Asap_Skills');
        });
    }
}
