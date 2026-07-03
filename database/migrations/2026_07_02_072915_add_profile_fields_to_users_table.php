
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('whatsapp')->nullable()->after('phone');
            $table->string('city')->nullable()->after('whatsapp');
            $table->text('address')->nullable()->after('city');
            $table->text('bio')->nullable()->after('address');
            $table->string('profile_picture')->nullable()->after('bio');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone','whatsapp','city','address','bio','profile_picture']);
        });
    }
};
