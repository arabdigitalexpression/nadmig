<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTrainerIdInSpaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('space_manger_2_reports', function ($table) {
            $table->dropForeign('space_manger_2_reports_trainer_id_foreign');
            $table->dropColumn('trainer_id');
            $table->string('trainers', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('space_manger_2_reports', function (Blueprint $table) {
            $table->dropColumn('trainer_id');
        });
    }
}
