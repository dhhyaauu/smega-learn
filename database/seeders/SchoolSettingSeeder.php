<?php

namespace Database\Seeders;

use App\Models\SchoolSetting;
use Illuminate\Database\Seeder;

class SchoolSettingSeeder extends Seeder
{
    public function run(): void
    {
        // firstOrCreate — aman dijalankan berulang kali
        // Koordinat: Desa Gemuruh, Kec. Bawang, Kab. Banjarnegara, Jawa Tengah
        // Perlu dikonfirmasi tim sebelum production jika lokasi berubah
        SchoolSetting::firstOrCreate([], [
            'school_name'     => 'SMEGA',
            'latitude'        => -7.401933,
            'longitude'       => 109.644434,
            'radius_meters'   => 100,   // PERLU DIKONFIRMASI: sesuaikan dengan luas area sekolah
            'check_in_start'  => '06:30:00',
            'check_in_end'    => '08:00:00',
            'late_limit'      => '09:00:00',
            'check_out_start' => '14:00:00',
            'check_out_end'   => '17:00:00',
        ]);
    }
}
