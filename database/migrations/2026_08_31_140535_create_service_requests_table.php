<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_requests', function (Blueprint $table) {

            $table->id();

            // User who requested the service
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Selected service
            $table->enum('service_type', [
                'home_maintenance',
                'property_inspection',
                'digital_rental_agreement',
                'moving_relocation',
                'photography_virtual_tour'
            ]);

            // Optional related property
            $table->foreignId('property_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // User description/details
            $table->text('request_details');

            // Preferred service date
            $table->date('preferred_date')->nullable();

            // Request status
            $table->enum('status', [
                'pending',
                'in_progress',
                'completed',
                'cancelled'
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};