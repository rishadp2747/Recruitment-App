<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrlFieldToCompanydetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companydetails', function (Blueprint $table) {
            $table->dropColumn('Description');
            $table->string('URL',200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companydetails', function (Blueprint $table) {
            $table->string('Description',500);
            $table->dropColumn('URL');
        });
    }
}
