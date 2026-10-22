<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendancePhoto;
use App\Models\SchoolSetting;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(): View
    {
        $student      = Auth::user()->student()->with('classroom')->first();
        $setting      = SchoolSetting::current();
        $today        = $student?->attendances()->whereDate('date', today())->first();
        $bypassRadius = app()->environment('local');

        return view('student.attendance', compact('student', 'setting', 'today', 'bypassRadius'));
    }

    /* ------------------------------------------------------------------ */
    /*  CHECK-IN                                                            */
    /* ------------------------------------------------------------------ */
    public function checkIn(Request $request): JsonResponse
    {
        $student = Auth::user()->student;

        if (! $student) {
            return response()->json(['message' => 'Data siswa tidak ditemukan.'], 403);
        }

        // Cegah absen ganda
        $existing = $student->attendances()->whereDate('date', today())->first();
        if ($existing?->hasCheckedIn()) {
            return response()->json(['message' => 'Kamu sudah melakukan absen masuk hari ini.'], 422);
        }

        $request->validate([
            'latitude'  => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'photo'     => ['required', 'string'],
        ]);

        $setting = SchoolSetting::current();
        $now     = Carbon::now('Asia/Jakarta');

        // Validasi jam
        $start = Carbon::createFromTimeString($setting->check_in_start, 'Asia/Jakarta');
        $limit = Carbon::createFromTimeString($setting->late_limit, 'Asia/Jakarta');

        if ($now->lt($start)) {
            return response()->json([
                'message'    => 'Belum waktunya absen masuk. Absen dibuka pukul ' . $start->format('H:i') . '.',
                'error_type' => 'too_early',
            ], 422);
        }

        if ($now->gt($limit)) {
            return response()->json([
                'message'    => 'Waktu absen masuk sudah ditutup pukul ' . $limit->format('H:i') . '.',
                'error_type' => 'too_late',
            ], 422);
        }

        // Hitung jarak — selalu dilakukan agar koordinat tetap tersimpan
        $distance = $this->haversineDistance(
            $request->latitude, $request->longitude,
            $setting->latitude, $setting->longitude
        );

        // Validasi radius dilewati saat APP_ENV=local (mode pengujian lokal).
        // Di production (APP_ENV=production), validasi ini tetap aktif.
        $bypassRadius = app()->environment('local');

        if (! $bypassRadius && $distance > $setting->radius_meters) {
            return response()->json([
                'message' => sprintf(
                    'Lokasi kamu berada %d meter dari sekolah, di luar radius yang diizinkan (%d meter).',
                    (int) round($distance),
                    $setting->radius_meters
                ),
                'error_type'      => 'out_of_radius',
                'distance_meters' => (int) round($distance),
                'radius_meters'   => $setting->radius_meters,
            ], 422);
        }

        // Tentukan status hadir atau terlambat
        $lateAt = Carbon::createFromTimeString($setting->check_in_end, 'Asia/Jakarta');
        $status = $now->gt($lateAt) ? 'terlambat' : 'hadir';

        $attendance = Attendance::updateOrCreate(
            ['student_id' => $student->id, 'date' => today()],
            [
                'check_in_time'      => $now->format('H:i:s'),
                'status'             => $status,
                'check_in_latitude'  => $request->latitude,
                'check_in_longitude' => $request->longitude,
            ]
        );

        $photoPath = $this->storeBase64Photo($request->photo, 'attendance/checkin');
        if ($photoPath) {
            AttendancePhoto::create([
                'attendance_id' => $attendance->id,
                'type'          => 'check_in',
                'photo_path'    => $photoPath,
            ]);
        }

        $message = $status === 'hadir'
            ? 'Absen masuk berhasil! Selamat belajar 📚'
            : 'Absen masuk tercatat. Kamu terlambat hari ini.';

        return response()->json([
            'message'       => $message,
            'status'        => $status,
            'check_in'      => $now->format('H:i'),
            // Info debug: hanya dikirim di mode lokal, diabaikan di production
            'bypass_radius' => $bypassRadius,
            'distance_meters' => (int) round($distance),
        ]);
    }

    /* ------------------------------------------------------------------ */
    /*  CHECK-OUT                                                           */
    /* ------------------------------------------------------------------ */
    public function checkOut(Request $request): JsonResponse
    {
        $student = Auth::user()->student;

        if (! $student) {
            return response()->json(['message' => 'Data siswa tidak ditemukan.'], 403);
        }

        $attendance = $student->attendances()->whereDate('date', today())->first();

        if (! $attendance || ! $attendance->hasCheckedIn()) {
            return response()->json(['message' => 'Kamu belum melakukan absen masuk hari ini.'], 422);
        }

        if ($attendance->hasCheckedOut()) {
            return response()->json(['message' => 'Kamu sudah melakukan absen pulang hari ini.'], 422);
        }

        $request->validate([
            'latitude'  => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'photo'     => ['required', 'string'],
        ]);

        $setting = SchoolSetting::current();
        $now     = Carbon::now('Asia/Jakarta');

        // Validasi jam pulang
        $checkOutStart = Carbon::createFromTimeString($setting->check_out_start, 'Asia/Jakarta');
        if ($now->lt($checkOutStart)) {
            return response()->json([
                'message'    => 'Belum waktunya absen pulang. Absen pulang dibuka pukul ' . $checkOutStart->format('H:i') . '.',
                'error_type' => 'too_early',
            ], 422);
        }

        // Hitung jarak — selalu dilakukan agar koordinat tetap tersimpan
        $distance = $this->haversineDistance(
            $request->latitude, $request->longitude,
            $setting->latitude, $setting->longitude
        );

        // Bypass radius di APP_ENV=local, sama seperti check-in
        $bypassRadius = app()->environment('local');

        if (! $bypassRadius && $distance > $setting->radius_meters) {
            return response()->json([
                'message' => sprintf(
                    'Lokasi kamu berada %d meter dari sekolah, di luar radius yang diizinkan (%d meter).',
                    (int) round($distance),
                    $setting->radius_meters
                ),
                'error_type'      => 'out_of_radius',
                'distance_meters' => (int) round($distance),
                'radius_meters'   => $setting->radius_meters,
            ], 422);
        }

        $attendance->update([
            'check_out_time'      => $now->format('H:i:s'),
            'check_out_latitude'  => $request->latitude,
            'check_out_longitude' => $request->longitude,
        ]);

        $photoPath = $this->storeBase64Photo($request->photo, 'attendance/checkout');
        if ($photoPath) {
            AttendancePhoto::create([
                'attendance_id' => $attendance->id,
                'type'          => 'check_out',
                'photo_path'    => $photoPath,
            ]);
        }

        return response()->json([
            'message'         => 'Absen pulang berhasil! Hati-hati di jalan 🏠',
            'check_out'       => $now->format('H:i'),
            'bypass_radius'   => $bypassRadius,
            'distance_meters' => (int) round($distance),
        ]);
    }

    /* ------------------------------------------------------------------ */
    /*  HELPERS                                                             */
    /* ------------------------------------------------------------------ */

    private function haversineDistance(
        float $lat1, float $lon1,
        float $lat2, float $lon2
    ): float {
        $earthRadius = 6371000;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) ** 2
           + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) ** 2;

        return $earthRadius * 2 * asin(sqrt($a));
    }

    private function storeBase64Photo(string $base64, string $folder): ?string
    {
        if (! preg_match('/^data:image\/(\w+);base64,/', $base64, $matches)) {
            return null;
        }

        $ext     = strtolower($matches[1]);
        $allowed = ['jpeg', 'jpg', 'png', 'webp'];
        if (! in_array($ext, $allowed, true)) {
            return null;
        }

        $data     = base64_decode(substr($base64, strpos($base64, ',') + 1));
        $filename = $folder . '/' . now()->format('Ymd_His') . '_' . uniqid() . '.' . $ext;

        Storage::disk('local')->put($filename, $data);

        return $filename;
    }
}
