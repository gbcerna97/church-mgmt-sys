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
        Schema::create('givers', function (Blueprint $table) {
            $table->id();
            $table->string('giver_name')->nullable();
            $table->date('date');
            $table->float('tithe')->nullable();
            $table->float('offering')->nullable();
            $table->float('mission')->nullable();
            $table->float('sanctuary')->nullable();
            $table->float('love_gift')->nullable();
            $table->float('dance_ministry')->nullable();
            $table->boolean('is_cash')->nullable()->default(false);
            $table->boolean('is_cheque')->nullable()->default(false);
            $table->float('total')->nullable();
            $table->unsignedBigInteger('counting_services_id')->nullable();
            $table->foreign('counting_services_id')->references('id')->on('counting_services')->onDelete('cascade');
            $table->integer('cc_1000')->nullable()->default(0);
            $table->integer('cc_500')->nullable()->default(0);
            $table->integer('cc_200')->nullable()->default(0);
            $table->integer('cc_100')->nullable()->default(0);
            $table->integer('cc_50')->nullable()->default(0);
            $table->integer('cc_20')->nullable()->default(0);
            $table->integer('cc_10')->nullable()->default(0);
            $table->integer('cc_5')->nullable()->default(0);
            $table->integer('cc_1')->nullable()->default(0);
            $table->float('cc_0_25')->nullable()->default(0);
            $table->float('cc_0_1')->nullable()->default(0);
            $table->float('cc_0_05')->nullable()->default(0);
            $table->float('cc_0_01')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('givers');
    }
};
