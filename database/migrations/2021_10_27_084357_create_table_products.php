<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->string('name')->nullable();
            $table->string('code_subject');
            $table->string('semester');
            $table->string('teacher');
            $table->float('score', 8, 2);
            $table->bigInteger('status')->default(1);
            $table->bigInteger('type_id')->nullable();
            $table->string('url_video')->nullable();
            $table->bigInteger('status_video')->default(0);
            $table->unsignedBigInteger('create_by')->nullable();
            $table->text('descript_short')->nullable();
            $table->text('descript_detail')->nullable();
            $table->string('document_url')->nullable();
            $table->bigInteger('view')->default(1);
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
        Schema::dropIfExists('products');
    }
}
