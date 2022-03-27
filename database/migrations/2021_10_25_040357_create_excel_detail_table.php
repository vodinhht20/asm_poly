<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcelDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excel_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('excel_id');
            $table->string('name');
            $table->unsignedBigInteger('subject_id');
            $table->string('teacher');
            $table->integer('is_send')->default(0);
            $table->string('reason')->nullable();
            $table->float('score',8,2);
            $table->unsignedBigInteger('semester_id');
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
        Schema::dropIfExists('excel_detail');
    }
}
