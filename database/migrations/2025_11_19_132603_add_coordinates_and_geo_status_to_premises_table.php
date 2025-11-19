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
        Schema::table('premises', function (Blueprint $table) {
            $table->decimal('latitude', 10, 6)->nullable()->after('province_id');
            $table->decimal('longitude', 10, 6)->nullable()->after('latitude');
            $table->string('geocode_status')->default('unknown')->after('longitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('premises', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
            $table->dropColumn('geocode_status');
        });
    }
};
