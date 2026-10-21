<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class StudentsImport implements ToModel, WithHeadingRow, SkipsOnError, WithBatchInserts, WithChunkReading
{
    use SkipsErrors;

    // Proses 100 baris sekaligus agar tidak timeout untuk 1470 siswa
    public function batchSize(): int
    {
        return 100;
    }

    // Baca file per 100 baris agar hemat memori
    public function chunkSize(): int
    {
        return 100;
    }

    public function model(array $row)
    {
        // Skip baris kosong
        if (empty($row['nis']) || empty($row['email'])) {
            return null;
        }

        // Skip jika email atau NIS sudah ada (mencegah duplikasi saat re-upload)
        if (User::where('email', $row['email'])->exists()) {
            return null;
        }
        if (Student::where('nis', (string) $row['nis'])->exists()) {
            return null;
        }

        // Buat akun user dulu
        $user = User::create([
            'name'      => $row['nama_lengkap'],
            'email'     => $row['email'],
            'password'  => Hash::make((string) $row['nis']), // Password default = NIS
            'role'      => 'siswa',
            'is_active' => true,
        ]);

        // Baru buat data siswa yang terhubung ke user
        return new Student([
            'user_id'       => $user->id,
            'nis'           => (string) $row['nis'],
            'nisn'          => (string) $row['nisn'],
            'nama_lengkap'  => $row['nama_lengkap'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tingkat'       => $row['tingkat'],
            'jurusan'       => $row['jurusan'],
            'kelas'         => $row['kelas'],
            'no_telepon'    => isset($row['no_telepon']) ? (string) $row['no_telepon'] : null,
        ]);
    }
}
