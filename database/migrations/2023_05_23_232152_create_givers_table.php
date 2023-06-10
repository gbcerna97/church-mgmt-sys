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
