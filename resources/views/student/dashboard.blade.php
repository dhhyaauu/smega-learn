@extends('layouts.student')

@section('title', 'Beranda')

@section('content')

    {{-- ============================================================
         SALAM & TANGGAL
    ============================================================ --}}
    <div class="mb-5">
        <p class="text-xs font-medium uppercase tracking-wider text-slate-400">
            {{ \Carbon\Carbon::now('Asia/Jakarta')->isoFormat('dddd, D MMMM Y') }}
        </p>
        <h1 class="mt-1 text-xl font-bold text-slate-800">
            Halo, {{ Auth::user()->name ?? 'Siswa' }} 👋
        </h1>
        {{-- NIS & kelas dari relasi Student (tersedia setelah Orang 4 buat migration & model) --}}
        @if(isset($student))
            <p class="text-sm text-slate-500">
                {{ $student->nis ?? '' }}
                @if($student->nis && $student->classroom) · @endif
                {{ $student->classroom->name ?? '' }}
            </p>
        @else
            <p class="text-sm text-slate-400 italic">
                {{-- Placeholder: data siswa akan tersedia setelah Orang 4 menyelesaikan migration --}}
                Data siswa belum tersedia
            </p>
        @endif
    </div>

    {{-- ============================================================
         KARTU STATUS PRESENSI HARI INI
         Struktur ini siap menerima data $todayAttendance dari controller.
         Orang 3 akan menyediakan data ini melalui DashboardController / StudentController.
    ============================================================ --}}
    <section class="mb-5">
        @if(isset($todayAttendance))
            {{-- STATE: Data presensi hari ini sudah ada --}}
            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <div class="mb-3 flex items-center justify-between">
                    <h2 class="text-sm font-semibold text-slate-600">Presensi Hari Ini</h2>
                    {{-- Badge status --}}
                    @php
                        $statusColor = match($todayAttendance->status ?? '') {
                            'hadir'    => 'bg-green-100 text-green-700',
                            'terlambat'=> 'bg-yellow-100 text-yellow-700',
                            'izin'     => 'bg-blue-100 text-blue-700',
                            'sakit'    => 'bg-purple-100 text-purple-700',
                            'alpa'     => 'bg-red-100 text-red-700',
                            default    => 'bg-slate-100 text-slate-600',
                        };
                        $statusLabel = match($todayAttendance->status ?? '') {
                            'hadir'    => 'Hadir',
                            'terlambat'=> 'Terlambat',
                            'izin'     => 'Izin',
                            'sakit'    => 'Sakit',
                            'alpa'     => 'Alpa',
                            default    => 'Tidak Diketahui',
                        };
                    @endphp
                    <span class="rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $statusColor }}">
                        {{ $statusLabel }}
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    {{-- Jam Masuk --}}
                    <div class="rounded-xl bg-slate-50 p-3">
                        <p class="text-xs text-slate-500">Masuk</p>
                        <p class="mt-0.5 text-lg font-bold text-slate-800">
                            {{ $todayAttendance->check_in_time
                                ? \Carbon\Carbon::parse($todayAttendance->check_in_time)->format('H:i')
                                : '—' }}
                        </p>
                    </div>
                    {{-- Jam Pulang --}}
                    <div class="rounded-xl bg-slate-50 p-3">
                        <p class="text-xs text-slate-500">Pulang</p>
                        <p class="mt-0.5 text-lg font-bold text-slate-800">
                            {{ $todayAttendance->check_out_time
                                ? \Carbon\Carbon::parse($todayAttendance->check_out_time)->format('H:i')
                                : '—' }}
                        </p>
                    </div>
                </div>
            </div>
        @else
            {{-- STATE: Belum ada presensi hari ini --}}
            <div class="rounded-2xl border-2 border-dashed border-blue-200 bg-blue-50 p-5">
                <div class="flex items-start gap-3">
                    <span class="text-2xl">📋</span>
                    <div>
                        <p class="font-semibold text-blue-800">Belum Absen Hari Ini</p>
                        <p class="mt-0.5 text-sm text-blue-600">
                            Segera lakukan absensi sebelum batas waktu yang ditentukan.
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </section>

    {{-- ============================================================
         TOMBOL AKSI UTAMA
    ============================================================ --}}
    <section class="mb-5">
        <a href="{{ route('student.attendance') }}"
           class="flex w-full items-center justify-between rounded-2xl bg-blue-600 px-5 py-4 text-white shadow-md
                  transition-all active:scale-95 active:shadow-sm">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                        <circle cx="12" cy="13" r="4"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Lakukan Absensi</p>
                    <p class="text-sm text-blue-200">Selfie + GPS diperlukan</p>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-300" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </a>
    </section>

    {{-- ============================================================
         MENU SHORTCUT
    ============================================================ --}}
    <section class="mb-5">
        <h2 class="mb-3 text-sm font-semibold text-slate-500">Menu</h2>
        <div class="grid grid-cols-2 gap-3">

            {{-- Riwayat Absensi --}}
            <a href="{{ route('student.history') }}"
               class="flex flex-col rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-200
                      transition-all active:scale-95">
                <div class="mb-3 flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                </div>
                <p class="font-semibold text-slate-800">Riwayat</p>
                <p class="mt-0.5 text-xs text-slate-500">Catatan kehadiranmu</p>
            </a>

            {{-- Izin / Sakit --}}
            <a href="{{ route('student.permission') }}"
               class="flex flex-col rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-200
                      transition-all active:scale-95">
                <div class="mb-3 flex h-9 w-9 items-center justify-center rounded-xl bg-green-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 11l3 3L22 4"/>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                    </svg>
                </div>
                <p class="font-semibold text-slate-800">Izin / Sakit</p>
                <p class="mt-0.5 text-xs text-slate-500">Ajukan ketidakhadiran</p>
            </a>

        </div>
    </section>

    {{-- ============================================================
         REKAP KEHADIRAN BULAN INI
         Siap menerima data $summary dari controller.
         Orang 3 akan menyediakan variabel ini.
    ============================================================ --}}
    <section>
        <h2 class="mb-3 text-sm font-semibold text-slate-500">Rekap Bulan Ini</h2>
        <div class="grid grid-cols-4 gap-2">

            @php
                // Data dari controller (Orang 3) — gunakan 0 sebagai default jika belum tersedia
                $hadir    = $summary['hadir']     ?? null;
                $terlambat= $summary['terlambat'] ?? null;
                $izin     = $summary['izin']      ?? null;
                $alpa     = $summary['alpa']      ?? null;
            @endphp

            {{-- Hadir --}}
            <div class="flex flex-col items-center rounded-xl bg-white p-3 text-center shadow-sm ring-1 ring-slate-200">
                <span class="text-xl font-bold text-green-600">
                    {{ $hadir ?? '—' }}
                </span>
                <span class="mt-0.5 text-xs text-slate-500">Hadir</span>
            </div>

            {{-- Terlambat --}}
            <div class="flex flex-col items-center rounded-xl bg-white p-3 text-center shadow-sm ring-1 ring-slate-200">
                <span class="text-xl font-bold text-yellow-500">
                    {{ $terlambat ?? '—' }}
                </span>
                <span class="mt-0.5 text-xs text-slate-500">Terlambat</span>
            </div>

            {{-- Izin --}}
            <div class="flex flex-col items-center rounded-xl bg-white p-3 text-center shadow-sm ring-1 ring-slate-200">
                <span class="text-xl font-bold text-blue-500">
                    {{ $izin ?? '—' }}
                </span>
                <span class="mt-0.5 text-xs text-slate-500">Izin</span>
            </div>

            {{-- Alpa --}}
            <div class="flex flex-col items-center rounded-xl bg-white p-3 text-center shadow-sm ring-1 ring-slate-200">
                <span class="text-xl font-bold text-red-500">
                    {{ $alpa ?? '—' }}
                </span>
                <span class="mt-0.5 text-xs text-slate-500">Alpa</span>
            </div>

        </div>

        @if(!isset($summary))
            <p class="mt-2 text-center text-xs text-slate-400 italic">
                {{-- Keterangan jelas bahwa ini placeholder, bukan data nyata --}}
                Data rekap tersedia setelah backend terhubung
            </p>
        @endif
    </section>

@endsection
