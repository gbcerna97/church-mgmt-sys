<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cash_counts', function (Blueprint $table) {
            $table->integer('cc_1000')->nullable()->default(0)->change();
            $table->integer('cc_500')->nullable()->default(0)->change();
            $table->integer('cc_200')->nullable()->default(0)->change();
            $table->integer('cc_100')->nullable()->default(0)->change();
            $table->integer('cc_50')->nullable()->default(0)->change();
            $table->integer('cc_20')->nullable()->default(0)->change();
            $table->integer('cc_10')->nullable()->default(0)->change();
            $table->integer('cc_5')->nullable()->default(0)->change();
            $table->integer('cc_1')->nullable()->default(0)->change();
            $table->float('cc_0_25')->nullable()->default(0)->change();
            $table->float('cc_0_1')->nullable()->default(0)->change();
            $table->float('cc_0_05')->nullable()->default(0)->change();
            $table->float('cc_0_01')->nullable()->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cash_counts', function (Blueprint $table) {
            $table->integer('cc_1000')->nullable()->change();
            $table->integer('cc_500')->nullable()->change();
            $table->integer('cc_200')->nullable()->change();
            $table->integer('cc_100')->nullable()->change();
            $table->integer('cc_50')->nullable()->change();
            $table->integer('cc_20')->nullable()->change();
            $table->integer('cc_10')->nullable()->change();
            $table->integer('cc_5')->nullable()->change();
            $table->integer('cc_1')->nullable()->change();
            $table->float('cc_0_25')->nullable()->change();
            $table->float('cc_0_1')->nullable()->change();
            $table->float('cc_0_05')->nullable()->change();
            $table->float('cc_0_01')->nullable()->change();
        });
    }
};
