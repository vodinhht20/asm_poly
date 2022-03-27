<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMajorsHeadTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('majors_head_teacher', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('major_id');
            $table->unsignedBigInteger('campus_id');
            $table->unsignedBigInteger('teacher');
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
        Schema::dropIfExists('majors_head_teacher');
    }
}
