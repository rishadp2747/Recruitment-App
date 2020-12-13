<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeQualificationsFieldToBio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('studentdetails', function (Blueprint $table) {
            $table->dropColumn('Qualifications');
            $table->string('Bio',200);
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
            $table->string('Qualifications',400);
            $table->dropColumn('Bio');
        });
    }
}
