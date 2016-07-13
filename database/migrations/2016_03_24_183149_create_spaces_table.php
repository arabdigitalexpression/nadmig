<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spaces', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('manager_id');
            $table->unsignedInteger('organization_id');
            $table->foreign('manager_id')->references('id')->on('users');
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('address');
            $table->string('governorate');
            $table->string('email');
            $table->string('phone_number');
            $table->string('logo');
            $table->text('excerpt');
            $table->text('description');
            $table->text('links'); // json
            $table->string('in_return_key');
            $table->integer('in_return');
            $table->string('status');
            $table->text('working_week_days'); // json
            $table->text('working_hours_days'); // json
            $table->string('space_type');
            $table->text('space_equipment'); // json
            $table->text('agreement_text');
            $table->integer('capacity');
            $table->string('smoking');
            $table->text('min_type_for_reservation'); // json
            $table->text('max_type_for_reservation'); // json
            $table->text('min_time_before_reservation'); // json
            $table->text('max_time_before_reservation'); // json
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
        Schema::drop('spaces');
    }
}
