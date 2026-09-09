<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {

            $table->id();

            // Kis booking ki payment hai
            $table->foreignId('booking_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Kis user ne payment submit ki
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Payment amount
            $table->decimal('amount', 12, 2);

            // jazzcash / easypaisa / bank
            $table->enum(
                'payment_method',
                ['jazzcash', 'easypaisa', 'bank_transfer']
            );

            // User ki entered transaction ID
            $table->string('transaction_id');

            // Screenshot ka path
            $table->string('payment_proof')->nullable();

            // Payment verification status
            $table->enum(
                'status',
                ['submitted', 'verified', 'rejected']
            )->default('submitted');

            // Kis owner ne verify ki
            $table->foreignId('verified_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            // Kab verify hui
            $table->timestamp('verified_at')->nullable();

            // Reject hone ki reason
            $table->text('rejection_reason')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};