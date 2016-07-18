<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsagePeriodColume extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spaces', function (Blueprint $table) {
            $table->string('usage_period_key')->after('in_return');
            $table->string('usage_period')->after('usage_period_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spaces', function (Blueprint $table) {
            $table->dropColumn('usage_period_key');
            $table->dropColumn('usage_period');
        });
    }
}
