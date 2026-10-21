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
Schema::create('classrooms', function (Blueprint $table) {
    $table->id();
    $table->string('nama_kelas')->unique(); // 10 AKL 1, 11 MPLB 2, dst
    $table->string('tingkat'); // Kelas 10, 11, 12
    $table->string('jurusan'); // AKL, MPLB, TJKT, dst
    $table->integer('kapasitas')->default(36);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
