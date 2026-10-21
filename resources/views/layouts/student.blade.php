<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#1d4ed8">
    <title>@yield('title', 'Beranda') — SMEGA Learn</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex h-full min-h-screen flex-col bg-slate-50 text-slate-800 antialiased">

    {{-- ========================================================
         HEADER
         Ditampilkan di semua halaman siswa.
         Nama siswa & kelas akan diisi oleh controller (Orang 3/4).
    ========================================================= --}}
    <header class="sticky top-0 z-30 border-b border-slate-200 bg-white shadow-sm">
        <div class="mx-auto flex max-w-lg items-center justify-between px-4 py-3">
            {{-- Identitas aplikasi --}}
            <div class="flex items-center gap-2.5">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-600 text-sm font-bold text-white">
                    S
                </div>
                <div>
                    <p class="text-sm font-bold leading-none text-slate-800">SMEGA Learn</p>
                    <p class="text-xs leading-none text-slate-500">Sistem Presensi</p>
                </div>
            </div>

            {{-- Info siswa (diisi dari session/auth oleh Orang 4) --}}
            <div class="flex items-center gap-2">
                @auth
                    <div class="text-right">
                        <p class="text-sm font-semibold leading-none text-slate-800">{{ Auth::user()->name }}</p>
                        {{-- Nama kelas akan tersedia setelah relasi Student dibuat oleh Orang 4 --}}
                        <p class="mt-0.5 text-xs leading-none text-slate-500">
                            {{ Auth::user()->student->classroom->name ?? 'Siswa' }}
                        </p>
                    </div>
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-sm font-bold text-blue-700">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @else
                    {{-- Placeholder saat auth belum tersedia (development) --}}
                    <div class="text-right">
                        <p class="text-sm font-semibold leading-none text-slate-800">Siswa</p>
                        <p class="mt-0.5 text-xs leading-none text-slate-500">Belum login</p>
                    </div>
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-200 text-sm font-bold text-slate-500">
                        ?
                    </div>
                @endauth
            </div>
        </div>
    </header>

    {{-- ========================================================
         KONTEN UTAMA
         Diberi padding bawah agar tidak tertutup bottom nav
    ========================================================= --}}
    <main class="mx-auto w-full max-w-lg flex-1 px-4 py-5 pb-24">

        {{-- Flash message: sukses --}}
        @if (session('success'))
            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                x-init="setTimeout(() => show = false, 4000)"
                class="mb-4 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800"
            >
                <span class="mt-0.5 text-base">✅</span>
                <p>{{ session('success') }}</p>
                <button @click="show = false" class="ml-auto shrink-0 text-green-600 hover:text-green-800">✕</button>
            </div>
        @endif

        {{-- Flash message: error --}}
        @if (session('error'))
            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                x-init="setTimeout(() => show = false, 5000)"
                class="mb-4 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800"
            >
                <span class="mt-0.5 text-base">❌</span>
                <p>{{ session('error') }}</p>
                <button @click="show = false" class="ml-auto shrink-0 text-red-600 hover:text-red-800">✕</button>
            </div>
        @endif

        {{-- Flash message: info/peringatan --}}
        @if (session('warning'))
            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                x-init="setTimeout(() => show = false, 5000)"
                class="mb-4 flex items-start gap-3 rounded-xl border border-yellow-200 bg-yellow-50 px-4 py-3 text-sm text-yellow-800"
            >
                <span class="mt-0.5 text-base">⚠️</span>
                <p>{{ session('warning') }}</p>
                <button @click="show = false" class="ml-auto shrink-0 text-yellow-600 hover:text-yellow-800">✕</button>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- ========================================================
         BOTTOM NAVIGATION
         Navigasi utama siswa — fixed di bagian bawah layar.
         Cocok untuk penggunaan satu tangan di HP.
    ========================================================= --}}
    <nav class="fixed inset-x-0 bottom-0 z-30 border-t border-slate-200 bg-white shadow-lg"
         style="padding-bottom: env(safe-area-inset-bottom);">
        <div class="mx-auto flex max-w-lg items-stretch">

            {{-- Dashboard --}}
            <a href="{{ route('student.dashboard') }}"
               class="flex flex-1 flex-col items-center justify-center gap-1 py-3 text-xs font-medium transition-colors
                      {{ request()->routeIs('student.dashboard')
                            ? 'text-blue-600'
                            : 'text-slate-500 hover:text-slate-800' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                     fill="{{ request()->routeIs('student.dashboard') ? 'currentColor' : 'none' }}"
                     stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                <span>Beranda</span>
            </a>

            {{-- Absensi — tombol aksi utama, lebih menonjol --}}
            <a href="{{ route('student.attendance') }}"
               class="flex flex-1 flex-col items-center justify-center gap-1 py-3 text-xs font-medium transition-colors
                      {{ request()->routeIs('student.attendance*')
                            ? 'text-blue-600'
                            : 'text-slate-500 hover:text-slate-800' }}">
                {{-- Ikon kamera dengan latar biru jika aktif --}}
                <span class="flex h-8 w-8 items-center justify-center rounded-full
                             {{ request()->routeIs('student.attendance*')
                                    ? 'bg-blue-600 text-white shadow-md'
                                    : 'bg-slate-100 text-slate-500' }}
                             transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                        <circle cx="12" cy="13" r="4"/>
                    </svg>
                </span>
                <span class="-mt-0.5">Absensi</span>
            </a>

            {{-- Riwayat --}}
            <a href="{{ route('student.history') }}"
               class="flex flex-1 flex-col items-center justify-center gap-1 py-3 text-xs font-medium transition-colors
                      {{ request()->routeIs('student.history')
                            ? 'text-blue-600'
                            : 'text-slate-500 hover:text-slate-800' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                     fill="{{ request()->routeIs('student.history') ? 'currentColor' : 'none' }}"
                     stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                    <polyline points="10 9 9 9 8 9"/>
                </svg>
                <span>Riwayat</span>
            </a>

            {{-- Izin --}}
            <a href="{{ route('student.permission') }}"
               class="flex flex-1 flex-col items-center justify-center gap-1 py-3 text-xs font-medium transition-colors
                      {{ request()->routeIs('student.permission*')
                            ? 'text-blue-600'
                            : 'text-slate-500 hover:text-slate-800' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                     fill="{{ request()->routeIs('student.permission*') ? 'currentColor' : 'none' }}"
                     stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 11l3 3L22 4"/>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                </svg>
                <span>Izin</span>
            </a>

        </div>
    </nav>

</body>
</html>
