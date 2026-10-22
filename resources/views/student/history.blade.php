@extends('layouts.student')

@section('title', 'Riwayat Absensi')

@section('content')

{{-- ============================================================
     HEADER + FILTER BULAN
============================================================ --}}
<div class="mb-5 flex items-center justify-between gap-3">
    <div>
        <h1 class="text-xl font-bold text-slate-800">Riwayat Absensi</h1>
        <p class="text-sm text-slate-500">Catatan kehadiranmu di sekolah</p>
    </div>

    {{-- Dropdown filter bulan --}}
    <div x-data="{ open: false }" class="relative shrink-0">
        <button @click="open = !open" @click.outside="open = false"
                class="flex items-center gap-1.5 rounded-xl bg-white px-3 py-2 text-sm font-medium
                       text-slate-700 shadow-sm ring-1 ring-slate-200 transition hover:bg-slate-50">
            @php
                $currentLabel = collect($months)->firstWhere('current', true)['label']
                    ?? \Carbon\Carbon::createFromDate($year, $month)->isoFormat('MMMM Y');
            @endphp
            <span>{{ $currentLabel }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition"
                 :class="open ? 'rotate-180' : ''"
                 fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="6 9 12 15 18 9"/>
            </svg>
        </button>

        <div x-show="open" x-transition
             class="absolute right-0 top-11 z-30 w-48 overflow-hidden rounded-xl bg-white
                    shadow-lg ring-1 ring-slate-200">
            @foreach($months as $m)
                <a href="{{ route('student.history', ['year' => $m['year'], 'month' => $m['month']]) }}"
                   class="block px-4 py-2.5 text-sm transition
                          {{ $m['current']
                               ? 'bg-blue-50 font-semibold text-blue-700'
                               : 'text-slate-700 hover:bg-slate-50' }}">
                    {{ $m['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</div>

{{-- ============================================================
     REKAP SINGKAT
============================================================ --}}
@if($summary)
    <div class="mb-5 grid grid-cols-4 gap-2">
        @foreach([
            ['label' => 'Hadir',     'color' => 'text-green-600',  'bg' => 'bg-green-50',  'key' => 'hadir'],
            ['label' => 'Terlambat', 'color' => 'text-yellow-600', 'bg' => 'bg-yellow-50', 'key' => 'terlambat'],
            ['label' => 'Izin',      'color' => 'text-blue-600',   'bg' => 'bg-blue-50',   'key' => 'izin'],
            ['label' => 'Alpa',      'color' => 'text-red-600',    'bg' => 'bg-red-50',    'key' => 'alpa'],
        ] as $item)
            <div class="flex flex-col items-center rounded-xl {{ $item['bg'] }} p-3 text-center ring-1 ring-slate-100">
                <span class="text-xl font-bold {{ $item['color'] }}">{{ $summary[$item['key']] }}</span>
                <span class="mt-0.5 text-xs text-slate-500">{{ $item['label'] }}</span>
            </div>
        @endforeach
    </div>
@endif

{{-- ============================================================
     DAFTAR RIWAYAT
============================================================ --}}
@if($attendances instanceof \Illuminate\Pagination\LengthAwarePaginator && $attendances->count() > 0)

    <div class="space-y-2">
        @foreach($attendances as $att)
            @php
                $cfg = match($att->status) {
                    'hadir'     => ['bg' => 'bg-green-100',  'text' => 'text-green-700',  'border' => 'border-green-200',  'label' => 'Hadir'],
                    'terlambat' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'border' => 'border-yellow-200', 'label' => 'Terlambat'],
                    'izin'      => ['bg' => 'bg-blue-100',   'text' => 'text-blue-700',   'border' => 'border-blue-200',   'label' => 'Izin'],
                    'sakit'     => ['bg' => 'bg-purple-100', 'text' => 'text-purple-700', 'border' => 'border-purple-200', 'label' => 'Sakit'],
                    'alpa'      => ['bg' => 'bg-red-100',    'text' => 'text-red-700',    'border' => 'border-red-200',    'label' => 'Alpa'],
                    default     => ['bg' => 'bg-slate-100',  'text' => 'text-slate-600',  'border' => 'border-slate-200',  'label' => '-'],
                };
            @endphp

            <div class="flex items-center gap-3 rounded-xl bg-white px-4 py-3 shadow-sm ring-1 ring-slate-200">
                {{-- Kotak tanggal --}}
                <div class="flex w-10 shrink-0 flex-col items-center rounded-lg bg-slate-50 py-1.5 text-center ring-1 ring-slate-100">
                    <span class="text-[10px] font-medium uppercase text-slate-400">
                        {{ $att->date->isoFormat('MMM') }}
                    </span>
                    <span class="text-lg font-bold leading-tight text-slate-800">
                        {{ $att->date->format('d') }}
                    </span>
                </div>

                {{-- Detail --}}
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-800">
                        {{ $att->date->isoFormat('dddd') }}
                    </p>
                    <div class="mt-0.5 flex flex-wrap items-center gap-x-2 gap-y-0.5 text-xs text-slate-500">
                        <span>
                            Masuk:
                            <strong class="text-slate-700">
                                {{ $att->check_in_time ? \Carbon\Carbon::parse($att->check_in_time)->format('H:i') : '—' }}
                            </strong>
                        </span>
                        <span class="text-slate-300">·</span>
                        <span>
                            Pulang:
                            <strong class="text-slate-700">
                                {{ $att->check_out_time ? \Carbon\Carbon::parse($att->check_out_time)->format('H:i') : '—' }}
                            </strong>
                        </span>
                    </div>
                </div>

                {{-- Badge status --}}
                <span class="shrink-0 rounded-full border px-2.5 py-0.5 text-xs font-semibold
                             {{ $cfg['bg'] }} {{ $cfg['text'] }} {{ $cfg['border'] }}">
                    {{ $cfg['label'] }}
                </span>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($attendances->hasPages())
        <div class="mt-4">
            {{ $attendances->links() }}
        </div>
    @endif

@elseif($attendances instanceof \Illuminate\Pagination\LengthAwarePaginator && $attendances->count() === 0)

    {{-- STATE KOSONG --}}
    <div class="flex flex-col items-center justify-center rounded-2xl border-2 border-dashed
                border-slate-200 bg-white px-6 py-12 text-center">
        <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-slate-400" fill="none"
                 stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" y1="13" x2="8" y2="13"/>
                <line x1="16" y1="17" x2="8" y2="17"/>
            </svg>
        </div>
        <p class="font-semibold text-slate-700">Belum Ada Data</p>
        <p class="mt-1 text-sm text-slate-500">
            Tidak ada catatan presensi untuk bulan
            {{ \Carbon\Carbon::createFromDate($year, $month)->isoFormat('MMMM Y') }}.
        </p>
    </div>

@else

    {{-- Tidak ada data siswa --}}
    <div class="rounded-2xl border-2 border-dashed border-slate-200 bg-white px-6 py-10 text-center">
        <p class="text-sm text-slate-500">Data riwayat belum tersedia.</p>
    </div>

@endif

@endsection
