<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nis',
        'nisn',
        'nama_lengkap',
        'jenis_kelamin',
        'tingkat',
        'jurusan',
        'kelas',
        'no_telepon',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function todayAttendance()
    {
        return $this->hasOne(Attendance::class)
            ->whereDate('attendance_date', today());
    }
}
