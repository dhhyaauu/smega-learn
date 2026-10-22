<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $classroom = Classroom::where('name', 'XII RPL 1')->first();

        // ---------------------------------------------------------------
        // Akun demo utama
        // ---------------------------------------------------------------
        $user = User::firstOrCreate(
            ['email' => 'siswa@smega.sch.id'],
            [
                'name'     => 'Budi Santoso',
                'password' => Hash::make('password'),
            ]
        );

        $student = Student::firstOrCreate(
            ['user_id' => $user->id],
            [
                'classroom_id' => $classroom?->id,
                'nis'          => '2024001',
                'name'         => 'Budi Santoso',
                'gender'       => 'L',
                'is_active'    => true,
            ]
        );

        // Catatan: riwayat presensi demo tidak dibuat agar halaman /history
        // dimulai dalam kondisi kosong saat pengujian pertama kali.

        // ---------------------------------------------------------------
        // Akun demo kedua (siswa perempuan)
        // ---------------------------------------------------------------
        $user2 = User::firstOrCreate(
            ['email' => 'siti@smega.sch.id'],
            [
                'name'     => 'Siti Rahayu',
                'password' => Hash::make('password'),
            ]
        );

        Student::firstOrCreate(
            ['user_id' => $user2->id],
            [
                'classroom_id' => $classroom?->id,
                'nis'          => '2024002',
                'name'         => 'Siti Rahayu',
                'gender'       => 'P',
                'is_active'    => true,
            ]
        );
    }
}
