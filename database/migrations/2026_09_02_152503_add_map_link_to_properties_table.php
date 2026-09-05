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
    Schema::table('properties', function (Blueprint $table) {
        $table->string('map_link')->nullable()->after('address');
    });
}

public function down(): void
{
    Schema::table('properties', function (Blueprint $table) {
        $table->dropColumn('map_link');
    });
}
};
