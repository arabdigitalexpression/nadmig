<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendees', function (Blueprint $table) {
           $table->increments('id');
            $table->string('name');
            $table->string('birthday');
            $table->string('type');
            $table->string('address');
            $table->string('city');
            $table->string('phone_number');
            $table->string('email');
            $table->string('school_name');
            $table->string('track');
            $table->text('hear_about_us'); // json
            $table->boolean('media_coverage');
            $table->string('guardian_name');
            $table->string('guardian_phone');
            $table->text('guardian_approval');
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
        Schema::drop('attendees');
    }
}
