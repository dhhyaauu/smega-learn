<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->string('type');           // izin | sakit
            $table->date('date_start');
            $table->date('date_end');
            $table->text('reason');
            $table->string('file_path')->nullable(); // surat keterangan
            // pending | approved | rejected
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();        // catatan guru/admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
