<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    /** Apakah user ini adalah siswa aktif (punya data student). */
    public function isStudent(): bool
    {
        return $this->student()->exists();
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /** Alias sesuai konvensi tim (guru_bk). */
    public function isGuruBK(): bool
    {
        return $this->role === 'guru_bk';
    }

    /** Alias tambahan untuk konsistensi. */
    public function isGuruBk(): bool
    {
        return $this->role === 'guru_bk';
    }

    public function isSiswa(): bool
    {
        return $this->role === 'siswa';
    }
}
