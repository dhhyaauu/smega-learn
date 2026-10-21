@extends('layouts.student')

@section('title', 'Absensi')

@section('content')

    {{-- ============================================================
         JUDUL HALAMAN
    ============================================================ --}}
    <div class="mb-5">
        <h1 class="text-xl font-bold text-slate-800">Absensi</h1>
        <p class="text-sm text-slate-500">
            {{ \Carbon\Carbon::now('Asia/Jakarta')->isoFormat('dddd, D MMMM Y') }}
        </p>
    </div>

    {{-- ============================================================
         PLACEHOLDER — FITUR BELUM DIKERJAKAN
         Kamera, GPS, dan logika absensi akan dikerjakan pada Tahap berikutnya.
         Backend validasi radius & penyimpanan foto = tanggung jawab Orang 3.
    ============================================================ --}}
    <div class="flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 bg-white px-6 py-12 text-center">

        {{-- Ikon placeholder kamera --}}
        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                <circle cx="12" cy="13" r="4"/>
            </svg>
        </div>

        <h2 class="mb-2 font-semibold text-slate-700">Fitur Absensi</h2>
        <p class="mb-1 text-sm text-slate-500">
            Halaman ini akan memuat kamera selfie dan GPS.
        </p>
        <p class="text-xs text-slate-400">
            Dikerjakan pada Tahap 3 (Kamera) dan Tahap 4 (GPS).
        </p>

        {{-- Daftar yang akan tersedia --}}
        <ul class="mt-6 w-full space-y-2 text-left text-sm text-slate-600">
            <li class="flex items-center gap-2 rounded-lg bg-slate-50 px-3 py-2">
                <span class="text-slate-400">📸</span>
                <span>Kamera selfie langsung dari browser</span>
                <span class="ml-auto rounded-full bg-slate-200 px-2 py-0.5 text-xs text-slate-500">Tahap 3</span>
            </li>
            <li class="flex items-center gap-2 rounded-lg bg-slate-50 px-3 py-2">
                <span class="text-slate-400">📍</span>
                <span>Deteksi lokasi GPS otomatis</span>
                <span class="ml-auto rounded-full bg-slate-200 px-2 py-0.5 text-xs text-slate-500">Tahap 4</span>
            </li>
            <li class="flex items-center gap-2 rounded-lg bg-slate-50 px-3 py-2">
                <span class="text-slate-400">✅</span>
                <span>Absen datang &amp; absen pulang</span>
                <span class="ml-auto rounded-full bg-slate-200 px-2 py-0.5 text-xs text-slate-500">Tahap 5</span>
            </li>
        </ul>

    </div>

@endsection
