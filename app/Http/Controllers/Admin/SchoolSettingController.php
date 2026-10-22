<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller untuk mengatur lokasi GPS dan jam presensi sekolah.
 *
 * Catatan untuk Orang 4:
 * Controller ini khusus untuk pengaturan GPS dan jam.
 * Silakan tambahkan pengaturan lain (nama sekolah, dll) sesuai kebutuhan,
 * atau pindahkan ke controller admin Anda sendiri.
 */
class SchoolSettingController extends Controller
{
    public function edit(): View
    {
        $setting = SchoolSetting::current();

        return view('admin.settings.gps', compact('setting'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'latitude'        => ['required', 'numeric', 'between:-90,90'],
            'longitude'       => ['required', 'numeric', 'between:-180,180'],
            'radius_meters'   => ['required', 'integer', 'min:10', 'max:5000'],
            'check_in_start'  => ['required', 'date_format:H:i'],
            'check_in_end'    => ['required', 'date_format:H:i'],
            'late_limit'      => ['required', 'date_format:H:i'],
            'check_out_start' => ['required', 'date_format:H:i'],
            'check_out_end'   => ['required', 'date_format:H:i'],
        ], [
            'latitude.required'      => 'Latitude wajib diisi.',
            'latitude.between'       => 'Latitude harus antara -90 sampai 90.',
            'longitude.required'     => 'Longitude wajib diisi.',
            'longitude.between'      => 'Longitude harus antara -180 sampai 180.',
            'radius_meters.required' => 'Radius wajib diisi.',
            'radius_meters.min'      => 'Radius minimal 10 meter.',
            'radius_meters.max'      => 'Radius maksimal 5000 meter.',
            'check_in_start.required'  => 'Jam buka absen masuk wajib diisi.',
            'check_in_end.required'    => 'Jam batas terlambat wajib diisi.',
            'late_limit.required'      => 'Jam tutup absen masuk wajib diisi.',
            'check_out_start.required' => 'Jam buka absen pulang wajib diisi.',
            'check_out_end.required'   => 'Jam tutup absen pulang wajib diisi.',
        ]);

        // Update langsung — absensi langsung pakai koordinat terbaru
        SchoolSetting::current()->update($validated);

        return back()->with('success', 'Pengaturan lokasi dan jam presensi berhasil disimpan.');
    }
}
