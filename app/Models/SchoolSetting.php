<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolSetting extends Model
{
    protected $fillable = [
        'school_name',
        'latitude',
        'longitude',
        'radius_meters',
        'check_in_start',
        'check_in_end',
        'late_limit',
        'check_out_start',
        'check_out_end',
    ];

    protected function casts(): array
    {
        return [
            'latitude'      => 'float',
            'longitude'     => 'float',
            'radius_meters' => 'integer',
        ];
    }

    /**
     * Ambil satu-satunya baris setting (singleton pattern).
     * Koordinat: Desa Gemuruh, Kec. Bawang, Kab. Banjarnegara, Jawa Tengah
     * Ubah koordinat melalui seeder atau langsung di database — tidak perlu edit kode.
     */
    public static function current(): self
    {
        return static::firstOrCreate([], [
            'school_name'     => 'SMEGA',
            'latitude'        => -7.401933,
            'longitude'       => 109.644434,
            'radius_meters'   => 100,   // PERLU DIKONFIRMASI: sesuaikan luas area sekolah
            'check_in_start'  => '06:30:00',
            'check_in_end'    => '08:00:00',
            'late_limit'      => '09:00:00',
            'check_out_start' => '14:00:00',
            'check_out_end'   => '17:00:00',
        ]);
    }
}
