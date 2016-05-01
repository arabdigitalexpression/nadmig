<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url_id');
            $table->integer('space_id')->unsigned();
            $table->foreign('space_id')->references('id')->on('spaces');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->string('facilitator_name');
            $table->string('facilitator_email');
            $table->string('facilitator_phone');
            $table->string('group_name');
            $table->text('apply_agreement');
            $table->string('group_age');
            $table->integer('max_attendees');
            $table->integer('expected_attendees');
            $table->integer('reserved_attendees');
            $table->string('event_type');
            $table->json('dooropen_time');
            $table->json('dooropen_period');
            $table->json('links');
            $table->string('fees');
            $table->string('apply_cost');
            $table->string('apply_deadline');
            $table->string('status');
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
        Schema::drop('reservations');
    }
}
