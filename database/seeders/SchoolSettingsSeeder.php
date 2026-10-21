<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSettingsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('school_settings')->insertOrIgnore([
            'school_latitude'  => -6.200000,
            'school_longitude' => 106.816666,
            'radius_meter'     => 100,
            'max_accuracy'     => 30,
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);
    }
}
