<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cash_counts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('church_id');
            $table->integer('cc_1000')->nullable();
            $table->integer('cc_500')->nullable();
            $table->integer('cc_200')->nullable();
            $table->integer('cc_100')->nullable();
            $table->integer('cc_50')->nullable();
            $table->integer('cc_20')->nullable();
            $table->integer('cc_10')->nullable();
            $table->integer('cc_5')->nullable();
            $table->integer('cc_1')->nullable();
            $table->float('cc_0_25')->nullable();
            $table->float('cc_0_1')->nullable();
            $table->float('cc_0_05')->nullable();
            $table->float('cc_0_01')->nullable();
            $table->float('total')->nullable();
            $table->timestamps();

            $table->foreign('church_id')->references('id')->on('church');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_counts');
    }
};
