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
        Schema::create('church_info', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('church_area');
            $table->string('address');
            $table->float('givers_funds')->nullable();
            $table->float('donations_funds')->nullable();
            $table->float('overall_funds')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('church_info');
    }
};
