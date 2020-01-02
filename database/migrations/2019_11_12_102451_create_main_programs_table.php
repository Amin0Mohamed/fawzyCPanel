<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_programs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('program_id');
            $table->string('session_number');
            $table->string('session_name');
            $table->string('location');
            $table->string('presenters');
            $table->string('start_time');
            $table->string('end_time');

            $table->foreign('program_id')
                ->references('id')
                ->on('programs')
                ->onDelete('cascade');
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
        Schema::dropIfExists('main_programs');
    }
}
