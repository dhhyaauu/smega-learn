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
Schema::create('students', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('nis')->unique();
    $table->string('nisn')->unique();
    $table->string('nama_lengkap');
    $table->enum('jenis_kelamin', ['L', 'P']);
    $table->string('tingkat'); // Kelas 10, 11, 12
    $table->string('jurusan');
    $table->string('kelas');
    $table->string('no_telepon')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
