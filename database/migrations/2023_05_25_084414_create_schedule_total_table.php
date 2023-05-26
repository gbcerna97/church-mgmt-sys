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
        Schema::create('schedule_totals', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('church_id');
            $table->float('tithe');
            $table->float('offering');
            $table->float('mission');
            $table->float('sanctuary');
            $table->float('love_gift');
            $table->float('dance_ministry');
            $table->float('total_cash');
            $table->float('total_cheque');
            $table->float('grand_total');
            $table->timestamps();

            $table->foreign('church_id')->references('id')->on('church');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_totals');
    }
};
