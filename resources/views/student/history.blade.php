@extends('layouts.student')

@section('title', 'Riwayat Absensi')

@section('content')

    {{-- ============================================================
         JUDUL HALAMAN
    ============================================================ --}}
    <div class="mb-5 flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Riwayat Absensi</h1>
            <p class="text-sm text-slate-500">Catatan kehadiranmu di sekolah</p>
        </div>
        {{-- Filter bulan — akan difungsikan pada Tahap Riwayat --}}
        <div class="rounded-lg bg-white px-3 py-2 text-sm font-medium text-slate-600 shadow-sm ring-1 ring-slate-200">
            {{ \Carbon\Carbon::now('Asia/Jakarta')->isoFormat('MMMM Y') }}
        </div>
    </div>

    {{-- ============================================================
         PLACEHOLDER REKAP SINGKAT
         Struktur siap menerima data dari controller (Orang 3).
    ============================================================ --}}
    <div class="mb-5 grid grid-cols-4 gap-2">
        @foreach([
            ['label' => 'Hadir',     'color' => 'text-green-600',  'value' => $summary['hadir']     ?? '—'],
            ['label' => 'Terlambat', 'color' => 'text-yellow-500', 'value' => $summary['terlambat'] ?? '—'],
            ['label' => 'Izin',      'color' => 'text-blue-500',   'value' => $summary['izin']      ?? '—'],
            ['label' => 'Alpa',      'color' => 'text-red-500',    'value' => $summary['alpa']      ?? '—'],
        ] as $item)
            <div class="flex flex-col items-center rounded-xl bg-white p-3 text-center shadow-sm ring-1 ring-slate-200">
                <span class="text-xl font-bold {{ $item['color'] }}">{{ $item['value'] }}</span>
                <span class="mt-0.5 text-xs text-slate-500">{{ $item['label'] }}</span>
            </div>
        @endforeach
    </div>

    {{-- ============================================================
         DAFTAR RIWAYAT
         Menampilkan data $attendances dari controller jika tersedia,
         atau placeholder jika belum ada data / backend belum terhubung.
    ============================================================ --}}
    @if(isset($attendances) && $attendances->count() > 0)

        <div class="space-y-2">
            @foreach($attendances as $attendance)
                @php
                    $statusColor = match($attendance->status ?? '') {
                        'hadir'    => 'bg-green-100 text-green-700 border-green-200',
                        'terlambat'=> 'bg-yellow-100 text-yellow-700 border-yellow-200',
                        'izin'     => 'bg-blue-100 text-blue-700 border-blue-200',
                        'sakit'    => 'bg-purple-100 text-purple-700 border-purple-200',
                        'alpa'     => 'bg-red-100 text-red-700 border-red-200',
                        default    => 'bg-slate-100 text-slate-600 border-slate-200',
                    };
                    $statusLabel = match($attendance->status ?? '') {
                        'hadir'    => 'Hadir',
                        'terlambat'=> 'Terlambat',
                        'izin'     => 'Izin',
                        'sakit'    => 'Sakit',
                        'alpa'     => 'Alpa',
                        default    => '—',
                    };
                @endphp
                <div class="flex items-center gap-3 rounded-xl bg-white px-4 py-3 shadow-sm ring-1 ring-slate-200">
                    {{-- Tanggal --}}
                    <div class="flex w-10 flex-col items-center rounded-lg bg-slate-50 py-1.5 text-center">
                        <span class="text-xs font-medium text-slate-500">
                            {{ \Carbon\Carbon::parse($attendance->date)->isoFormat('MMM') }}
                        </span>
                        <span class="text-lg font-bold leading-none text-slate-800">
                            {{ \Carbon\Carbon::parse($attendance->date)->format('d') }}
                        </span>
                    </div>
                    {{-- Info presensi --}}
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-slate-800">
                            {{ \Carbon\Carbon::parse($attendance->date)->isoFormat('dddd') }}
                        </p>
                        <div class="mt-0.5 flex items-center gap-2 text-xs text-slate-500">
                            <span>
                                Masuk:
                                <strong>{{ $attendance->check_in_time ? \Carbon\Carbon::parse($attendance->check_in_time)->format('H:i') : '—' }}</strong>
                            </span>
                            <span>·</span>
                            <span>
                                Pulang:
                                <strong>{{ $attendance->check_out_time ? \Carbon\Carbon::parse($attendance->check_out_time)->format('H:i') : '—' }}</strong>
                            </span>
                        </div>
                    </div>
                    {{-- Badge status --}}
                    <span class="rounded-full border px-2.5 py-0.5 text-xs font-semibold {{ $statusColor }}">
                        {{ $statusLabel }}
                    </span>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if(method_exists($attendances, 'links'))
            <div class="mt-4">
                {{ $attendances->links() }}
            </div>
        @endif

    @else

        {{-- STATE KOSONG --}}
        <div class="flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 bg-white px-6 py-12 text-center">
            <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-slate-400" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
            </div>
            <p class="font-semibold text-slate-700">Belum Ada Riwayat</p>
            <p class="mt-1 text-sm text-slate-500">
                @if(!isset($attendances))
                    Data riwayat tersedia setelah backend terhubung.
                @else
                    Belum ada data presensi untuk bulan ini.
                @endif
            </p>
        </div>

    @endif

@endsection
