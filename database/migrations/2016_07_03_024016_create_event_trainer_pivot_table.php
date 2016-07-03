<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTrainerPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_trainer', function (Blueprint $table) {
            $table->integer('event_id')->unsigned()->index();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->integer('trainer_id')->unsigned()->index();
            $table->foreign('trainer_id')->references('id')->on('trainers')->onDelete('cascade');
            $table->primary(['event_id', 'trainer_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_trainer');
    }
}
