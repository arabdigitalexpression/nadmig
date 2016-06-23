<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('manager_id');
            $table->foreign('manager_id')->references('id')->on('users');
            $table->string('name');
            $table->string('logo');
            $table->string('slug')->unique();
            $table->string('geo_location');
            $table->string('email');
            $table->string('phone_number');
            $table->text('excerpt');
            $table->text('description');
            $table->json('links');
            $table->json('min_time_before_usage_to_edit');
            $table->json('change_fees');
            $table->json('min_to_cancel');
            $table->json('cancel_fees');
            $table->json('max_to_confirm');
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
        Schema::drop('organizations');
    }
}