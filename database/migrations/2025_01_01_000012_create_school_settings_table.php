<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_settings', function (Blueprint $table) {
            $table->id();
            $table->string('school_name')->default('SMEGA');
            $table->decimal('latitude', 10, 7)->default(-7.0);
            $table->decimal('longitude', 10, 7)->default(110.0);
            $table->integer('radius_meters')->default(100);   // radius absensi
            $table->time('check_in_start')->default('06:30:00');
            $table->time('check_in_end')->default('08:00:00');   // lewat ini = terlambat
            $table->time('late_limit')->default('09:00:00');     // lewat ini = tidak bisa absen masuk
            $table->time('check_out_start')->default('14:00:00');
            $table->time('check_out_end')->default('17:00:00');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_settings');
    }
};
