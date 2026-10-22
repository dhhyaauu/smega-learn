@extends('layouts.admin')

@section('title', 'Pengaturan Lokasi GPS')

@section('content')

<div class="mb-5">
    <h1 class="text-xl font-bold text-slate-800">Pengaturan Lokasi & Jam Presensi</h1>
    <p class="text-sm text-slate-500">Ubah koordinat sekolah, radius absensi, dan jam presensi</p>
</div>

<form method="POST" action="{{ route('admin.settings.gps.update') }}" class="space-y-6">
    @csrf
    @method('PUT')

    {{-- ============================================================
         LOKASI GPS
    ============================================================ --}}
    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
        <h2 class="mb-4 flex items-center gap-2 font-semibold text-slate-700">
            <span>📍</span> Lokasi Sekolah
        </h2>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label for="latitude" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Latitude <span class="text-red-500">*</span>
                </label>
                <input type="number" id="latitude" name="latitude" step="any" required
                       value="{{ old('latitude', $setting->latitude) }}"
                       class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm font-mono
                              focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
                <p class="mt-1 text-xs text-slate-400">Contoh: -7.401933</p>
            </div>
            <div>
                <label for="longitude" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Longitude <span class="text-red-500">*</span>
                </label>
                <input type="number" id="longitude" name="longitude" step="any" required
                       value="{{ old('longitude', $setting->longitude) }}"
                       class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm font-mono
                              focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
                <p class="mt-1 text-xs text-slate-400">Contoh: 109.644434</p>
            </div>
        </div>

        <div class="mt-3">
            <label for="radius_meters" class="mb-1.5 block text-sm font-medium text-slate-700">
                Radius Absensi (meter) <span class="text-red-500">*</span>
            </label>
            <input type="number" id="radius_meters" name="radius_meters" min="10" max="5000" required
                   value="{{ old('radius_meters', $setting->radius_meters) }}"
                   class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm
                          focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
            <p class="mt-1 text-xs text-slate-400">Siswa harus berada dalam radius ini dari lokasi sekolah untuk absen.</p>
        </div>

        <div class="mt-3 rounded-xl bg-slate-50 px-4 py-2.5 text-xs text-slate-500">
            <p>📍 Alamat acuan: Desa Gemuruh, RT 03/RW 09, Kaliwuluh, Gemuruh, Kec. Bawang, Kab. Banjarnegara, Jawa Tengah, 53471</p>
            <p class="mt-0.5">ℹ️ Koordinat saat ini: <span class="font-mono">{{ $setting->latitude }}, {{ $setting->longitude }}</span> · Radius: <span class="font-mono">{{ $setting->radius_meters }} m</span></p>
        </div>
    </div>

    {{-- ============================================================
         JAM PRESENSI
    ============================================================ --}}
    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
        <h2 class="mb-4 flex items-center gap-2 font-semibold text-slate-700">
            <span>🕐</span> Jam Presensi
        </h2>

        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
            <div>
                <label for="check_in_start" class="mb-1.5 block text-xs font-medium text-slate-600">Buka Absen Masuk</label>
                <input type="time" id="check_in_start" name="check_in_start" required
                       value="{{ old('check_in_start', \Carbon\Carbon::parse($setting->check_in_start)->format('H:i')) }}"
                       class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
            </div>
            <div>
                <label for="check_in_end" class="mb-1.5 block text-xs font-medium text-slate-600">Batas Terlambat</label>
                <input type="time" id="check_in_end" name="check_in_end" required
                       value="{{ old('check_in_end', \Carbon\Carbon::parse($setting->check_in_end)->format('H:i')) }}"
                       class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
            </div>
            <div>
                <label for="late_limit" class="mb-1.5 block text-xs font-medium text-slate-600">Tutup Absen Masuk</label>
                <input type="time" id="late_limit" name="late_limit" required
                       value="{{ old('late_limit', \Carbon\Carbon::parse($setting->late_limit)->format('H:i')) }}"
                       class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
            </div>
            <div>
                <label for="check_out_start" class="mb-1.5 block text-xs font-medium text-slate-600">Buka Absen Pulang</label>
                <input type="time" id="check_out_start" name="check_out_start" required
                       value="{{ old('check_out_start', \Carbon\Carbon::parse($setting->check_out_start)->format('H:i')) }}"
                       class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
            </div>
            <div>
                <label for="check_out_end" class="mb-1.5 block text-xs font-medium text-slate-600">Tutup Absen Pulang</label>
                <input type="time" id="check_out_end" name="check_out_end" required
                       value="{{ old('check_out_end', \Carbon\Carbon::parse($setting->check_out_end)->format('H:i')) }}"
                       class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
            </div>
        </div>
    </div>

    {{-- Submit --}}
    <button type="submit"
            class="w-full rounded-xl bg-blue-600 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 active:scale-95">
        💾 Simpan Pengaturan
    </button>
</form>

@endsection
