<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\SchoolSetting;
use App\Services\GeolocationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function checkIn(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'required|file|mimes:jpg,jpeg,png|max:2048' // max 2MB
        ]);

        $user = auth()->user();
        $today = Carbon::today('Asia/Jakarta');

        // 1. Cek apakah sudah absen datang hari ini
        $existing = Attendance::where('student_id', $user->id)
            ->whereDate('attendance_date', $today)
            ->first();

        if ($existing) {
            return back()->with('error', 'Kamu sudah melakukan absen datang hari ini.');
        }

        // 2. Ambil pengaturan sekolah (koordinat & radius)
        $settings = SchoolSetting::first();
        $distance = GeolocationService::calculateDistance(
            $request->latitude, $request->longitude,
            $settings->latitude, $settings->longitude
        );

        // 3. Validasi Radius GPS
        if ($distance > $settings->radius) {
            return back()->with('error', 'Ditolak: Kamu berada di luar radius sekolah (' . round($distance) . ' meter).');
        }

        // 4. Simpan foto ke Storage Private
        $photoPath = $request->file('photo')->store('photos/check_in', 'private');

        // 5. Cek Keterlambatan
        $now = Carbon::now('Asia/Jakarta');
        $status = $now->format('H:i:s') > $settings->entry_time ? 'Terlambat' : 'Hadir';

        // 6. Simpan Data dengan Transaction agar aman
        DB::transaction(function () use ($user, $today, $now, $request, $distance, $photoPath, $status) {
            Attendance::create([
                'student_id' => $user->id,
                'attendance_date' => $today,
                'check_in_at' => $now,
                'check_in_latitude' => $request->latitude,
                'check_in_longitude' => $request->longitude,
                'check_in_distance' => $distance,
                'check_in_photo_path' => $photoPath,
                'check_in_status' => $status,
            ]);
        });

        return redirect()->route('student.dashboard')->with('success', 'Absen datang berhasil disimpan!');
    }

    public function checkOut(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'required|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = auth()->user();
        $today = Carbon::today('Asia/Jakarta');

        // 1. Cari data absen datang hari ini
        $attendance = Attendance::where('student_id', $user->id)
            ->whereDate('attendance_date', $today)
            ->first();

        if (!$attendance) {
            return back()->with('error', 'Ditolak: Kamu belum melakukan absen datang hari ini.');
        }

        if ($attendance->check_out_at) {
            return back()->with('error', 'Kamu sudah melakukan absen pulang.');
        }

        // 2. Validasi Jarak (Sama seperti check in)
        $settings = SchoolSetting::first();
        $distance = GeolocationService::calculateDistance(
            $request->latitude, $request->longitude,
            $settings->latitude, $settings->longitude
        );

        if ($distance > $settings->radius) {
            return back()->with('error', 'Ditolak: Kamu berada di luar area sekolah saat absen pulang.');
        }

        // 3. Simpan foto pulang ke Private Storage
        $photoPath = $request->file('photo')->store('photos/check_out', 'private');

        // 4. Update data absen
        $attendance->update([
            'check_out_at' => Carbon::now('Asia/Jakarta'),
            'check_out_latitude' => $request->latitude,
            'check_out_longitude' => $request->longitude,
            'check_out_distance' => $distance,
            'check_out_photo_path' => $photoPath,
            'check_out_status' => 'Pulang',
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Absen pulang berhasil!');
    }
}