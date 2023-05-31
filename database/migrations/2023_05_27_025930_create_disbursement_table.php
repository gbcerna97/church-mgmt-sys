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
        Schema::create('disbursements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_id');
            $table->date('date');
            $table->string('account_name')->nullable();
            $table->string('released_to');
            $table->string('particulars');
            $table->float('unit_price');
            $table->string('fund_source')->nullable();
            $table->timestamps();

            $table->foreign('request_id')->references('id')->on('disbursement_requests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disbursements');
    }
};
