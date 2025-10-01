<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('premises', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('premises_name')->unique();
            $table->string('business_registration_no')->unique();
            $table->string('contact_person');
            $table->string('location')->nullable();
            $table->text('address')->nullable();
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();
            $table->enum('status', ['operational', 'suspended', 'ceased'])->default('operational');
            /*$table->enum('license_status',
                [
                    'Apply for License',
                    'Pending Review',
                    'Reviewed',
                    'Approved',
                    'Rejected',
                    'Expired',
                ])->default('Apply for License');*/
            $table->unsignedBigInteger('premises_owner_id');
            $table->foreign('premises_owner_id')->references('id')->on('premises_owners')->onDelete('cascade');
            $table->unsignedBigInteger('province_id');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            //$table->unsignedBigInteger('prescribed_activity_id')->nullable();
            //$table->foreign('prescribed_activity_id')->references('id')->on('prescribed_activities')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premises');
    }
};
