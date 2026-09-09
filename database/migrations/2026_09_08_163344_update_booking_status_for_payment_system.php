<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // MySQL enum ko modify karna
        DB::statement("
            ALTER TABLE bookings 
            MODIFY COLUMN status 
            ENUM(
                'pending',
                'approved',
                'payment_submitted',
                'confirmed',
                'cancelled'
            ) 
            NOT NULL DEFAULT 'pending'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE bookings 
            MODIFY COLUMN status 
            ENUM(
                'pending',
                'confirmed',
                'cancelled'
            ) 
            NOT NULL DEFAULT 'pending'
        ");
    }
};