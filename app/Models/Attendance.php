<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'date',
        'check_in_time',
        'check_out_time',
        'status',
        'check_in_latitude',
        'check_in_longitude',
        'check_out_latitude',
        'check_out_longitude',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'date'                => 'date',
            'check_in_latitude'   => 'float',
            'check_in_longitude'  => 'float',
            'check_out_latitude'  => 'float',
            'check_out_longitude' => 'float',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(AttendancePhoto::class);
    }

    public function checkInPhoto(): ?AttendancePhoto
    {
        return $this->photos()->where('type', 'check_in')->first();
    }

    public function checkOutPhoto(): ?AttendancePhoto
    {
        return $this->photos()->where('type', 'check_out')->first();
    }

    public function hasCheckedIn(): bool
    {
        return ! is_null($this->check_in_time);
    }

    public function hasCheckedOut(): bool
    {
        return ! is_null($this->check_out_time);
    }
}
