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
Schema::create('attendances', function (Blueprint $table) {
    $table->id();
    $table->foreignId('student_id')->constrained()->onDelete('cascade');
    $table->date('attendance_date');

    // Data Check-In (Absen Datang)
    $table->timestamp('check_in_at')->nullable();
    $table->decimal('check_in_latitude', 10, 8)->nullable();
    $table->decimal('check_in_longitude', 11, 8)->nullable();
    $table->decimal('check_in_accuracy', 8, 2)->nullable();
    $table->decimal('check_in_distance', 8, 2)->nullable(); // jarak dalam meter
    $table->string('check_in_photo_path')->nullable();
    $table->enum('check_in_status', ['tepat_waktu', 'terlambat', 'izin', 'sakit', 'alpa'])->nullable();

    // Data Check-Out (Absen Pulang)
    $table->timestamp('check_out_at')->nullable();
    $table->decimal('check_out_latitude', 10, 8)->nullable();
    $table->decimal('check_out_longitude', 11, 8)->nullable();
    $table->decimal('check_out_accuracy', 8, 2)->nullable();
    $table->decimal('check_out_distance', 8, 2)->nullable();
    $table->string('check_out_photo_path')->nullable();

    $table->timestamps();

    // Mencegah duplikasi: 1 siswa hanya bisa 1 record per hari
    $table->unique(['student_id', 'attendance_date']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
