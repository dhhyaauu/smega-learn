<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_id')->constrained()->cascadeOnDelete();
            $table->string('type');       // check_in | check_out
            $table->string('photo_path'); // path file di storage
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_photos');
    }
};
