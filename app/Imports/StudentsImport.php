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
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class StudentsImport implements ToModel, WithHeadingRow, SkipsOnError, WithBatchInserts, WithChunkReading
{
    use SkipsErrors;

    public int $importedCount = 0;
    public int $skippedCount  = 0;

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }

public function model(array $row): \Illuminate\Database\Eloquent\Model|array|null
    {
        // Skip baris kosong
        if (empty($row['nis']) || empty($row['email'])) {
            return null;
        }

        // Normalisasi: ambil no telepon dengan berbagai kemungkinan key
        $noTelepon = $row['no_telepon']
            ?? $row['no__telepon']
            ?? $row['no_telepon_']
            ?? $row['notelepon']
            ?? null;

        // Skip duplikat
        if (User::where('email', $row['email'])->exists()) {
            $this->skippedCount++;
            return null;
        }
        if (Student::where('nis', (string) $row['nis'])->exists()) {
            $this->skippedCount++;
            return null;
        }

        // Buat akun user
        $user = User::create([
            'name'      => $row['nama_lengkap'],
            'email'     => $row['email'],
            'password'  => Hash::make((string) $row['nis'], ['rounds' => 4]),
            'role'      => 'siswa',
            'is_active' => true,
        ]);

        $this->importedCount++;

        return new Student([
            'user_id'       => $user->id,
            'nis'           => (string) $row['nis'],
            'nisn'          => (string) $row['nisn'],
            'nama_lengkap'  => $row['nama_lengkap'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tingkat'       => $row['tingkat'],
            'jurusan'       => $row['jurusan'],
            'kelas'         => $row['kelas'],
            'no_telepon'    => $noTelepon ? (string) $noTelepon : null,
        ]);
    }
}
