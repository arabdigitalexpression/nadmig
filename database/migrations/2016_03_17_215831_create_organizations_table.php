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
            $table->string('name_en');
            $table->string('logo');
            $table->string('slug')->unique();
            $table->string('address');
            $table->string('governorate');
            $table->string('email');
            $table->string('phone_number');
            $table->text('excerpt');
            $table->text('description');
            $table->text('links'); // json
            $table->text('min_time_before_usage_to_edit'); // json
            $table->text('change_fees'); // json
            $table->text('min_to_cancel'); // json
            $table->text('cancel_fees'); // json
            $table->text('max_to_confirm'); // json
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
