<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainerReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('events');
            $table->integer('attendees_id')->unsigned();
            $table->foreign('attendees_id')->references('id')->on('attendees');
            $table->integer('trainer_id')->unsigned();
            $table->foreign('trainer_id')->references('id')->on('trainers');
            $table->integer('week');
            $table->text('confidence');
            $table->text('initiative');
            $table->text('respect_and_accept');
            $table->text('team_work');
            $table->text('critical_thinking');
            $table->text('imagination');
            $table->text('open_to_change');
            $table->text('ability_to_understand_the_content');
            $table->text('ability_to_produce_art');
            $table->text('ability_to_thinking');
            $table->text('ability_to_inovate');
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
        Schema::drop('trainer_reports');
    }
}
