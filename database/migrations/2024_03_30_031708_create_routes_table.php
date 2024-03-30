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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('starting_point')->nullable()->constrained('destinations')->nullOnDelete();
            $table->foreignId('ending_point')->nullable()->constrained('destinations')->nullOnDelete();
            $table->string('total_time');
            $table->string('total_distance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
