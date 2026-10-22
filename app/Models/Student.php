<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'classroom_id',
        'nis',
        'nisn',
        'nama_lengkap',
        'name',
        'jenis_kelamin',
        'gender',
        'tingkat',
        'jurusan',
        'kelas',
        'no_telepon',
        'phone',
        'photo',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function leaveRequests(): HasMany
    {
        return $this->hasMany(LeaveRequest::class);
    }

    /** Presensi hari ini. Mendukung kedua field date yang mungkin dipakai. */
    public function todayAttendance()
    {
        return $this->attendances()
            ->where(function ($q) {
                $q->whereDate('date', today())
                  ->orWhereDate('attendance_date', today());
            })
            ->first();
    }
}
