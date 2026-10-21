<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@smkn.sch.id'],
            [
                'name'      => 'Administrator',
                'password'  => Hash::make('admin123'),
                'role'      => 'admin',
                'is_active' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'bk@smkn.sch.id'],
            [
                'name'      => 'Guru BK',
                'password'  => Hash::make('bk123'),
                'role'      => 'guru_bk',
                'is_active' => true,
            ]
        );
    }
}
