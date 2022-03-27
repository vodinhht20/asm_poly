<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableExcelDetailsChangeSubjectIdCollumnName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('excel_details', function (Blueprint $table) {
            $table->renameColumn('subject_id', 'subject_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('excel_details', function (Blueprint $table) {
            $table->dropColumn('subject_code');
        });
    }
}
