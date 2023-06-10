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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_number')->nullable();
            $table->unsignedBigInteger('dis_id')->nullable();
            $table->foreign('dis_id')->references('id')->on('disbursements')->onDelete('cascade');
            $table->unsignedBigInteger('allowance_id')->nullable();
            $table->foreign('allowance_id')->references('id')->on('weekly_allowance')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
