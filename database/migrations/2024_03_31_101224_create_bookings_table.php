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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('route_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('service_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('bus_id')->nullable()->constrained()->nullOnDelete();
            $table->string('ticket_number');
            $table->string('booking_id');
            $table->string('status');
            $table->foreignId('boarding_point')->nullable()->constrained('destinations')->nullOnDelete();
            $table->dateTime('boarding_time');
            $table->foreignId('dropping_point')->nullable()->constrained('destinations')->nullOnDelete();
            $table->dateTime('dropping_time');
            $table->integer('total_passangers');
            $table->decimal('total_price', 12, 2);
            $table->decimal('discount', 12, 2);
            $table->decimal('platform_fee', 12, 2);
            $table->decimal('tax', 12, 2);
            $table->string('barcode')->nullable();
            $table->string('billing_email');
            $table->string('billing_phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
