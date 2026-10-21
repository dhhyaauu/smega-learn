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
Schema::create('school_settings', function (Blueprint $table) {
    $table->id();
    $table->decimal('school_latitude', 10, 8); // -7.1234567
    $table->decimal('school_longitude', 11, 8); // 110.1234567
    $table->integer('radius_meter')->default(100); // Radius GPS dalam meter
    $table->integer('max_accuracy')->default(30); // Akurasi GPS maksimal yang diterima
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_settings');
    }
};
