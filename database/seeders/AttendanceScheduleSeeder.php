<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceScheduleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('attendance_schedules')->insertOrIgnore([
            'jam_masuk'       => '07:00:00',
            'batas_terlambat' => '07:15:00',
            'jam_pulang'      => '15:00:00',
            'is_active'       => true,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);
    }
}
