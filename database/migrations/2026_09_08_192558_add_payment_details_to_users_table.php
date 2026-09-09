<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('jazzcash_number')
                  ->nullable()
                  ->after('phone');

            $table->string('easypaisa_number')
                  ->nullable()
                  ->after('jazzcash_number');

            $table->string('bank_name')
                  ->nullable()
                  ->after('easypaisa_number');

            $table->string('bank_account_title')
                  ->nullable()
                  ->after('bank_name');

            $table->string('bank_account_number')
                  ->nullable()
                  ->after('bank_account_title');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'jazzcash_number',
                'easypaisa_number',
                'bank_name',
                'bank_account_title',
                'bank_account_number',
            ]);
        });
    }
};