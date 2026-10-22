@extends('layouts.student')

@section('title', 'Izin / Sakit')

@section('content')

<div class="mb-5">
    <h1 class="text-xl font-bold text-slate-800">Izin / Sakit</h1>
    <p class="text-sm text-slate-500">Ajukan ketidakhadiran ke sekolah</p>
</div>

{{-- ============================================================
     FORM PENGAJUAN
============================================================ --}}
<section class="mb-6">
    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
        <h2 class="mb-4 font-semibold text-slate-700">Form Pengajuan</h2>

        @if ($errors->any())
            <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <p class="font-semibold mb-1">Periksa kembali form:</p>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('student.permission.store') }}"
            enctype="multipart/form-data"
            class="space-y-4"
            x-data="permissionForm()"
        >
            @csrf

            {{-- Jenis --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-slate-700" for="type">
                    Jenis Ketidakhadiran <span class="text-red-500">*</span>
                </label>
                <select id="type" name="type" x-model="type" required
                        class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm
                               text-slate-800 shadow-sm transition focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20 focus:outline-none
                               @error('type') border-red-400 @enderror">
                    <option value="">— Pilih jenis —</option>
                    <option value="izin"  {{ old('type') === 'izin'  ? 'selected' : '' }}>Izin</option>
                    <option value="sakit" {{ old('type') === 'sakit' ? 'selected' : '' }}>Sakit</option>
                </select>
            </div>

            {{-- Tanggal --}}
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700" for="date_start">
                        Tanggal Mulai <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="date_start" name="date_start"
                           value="{{ old('date_start') }}"
                           min="{{ now()->toDateString() }}"
                           x-model="dateStart"
                           required
                           class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm
                                  text-slate-800 shadow-sm transition focus:border-blue-500
                                  focus:ring-2 focus:ring-blue-500/20 focus:outline-none
                                  @error('date_start') border-red-400 @enderror">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700" for="date_end">
                        Tanggal Selesai <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="date_end" name="date_end"
                           value="{{ old('date_end') }}"
                           :min="dateStart || '{{ now()->toDateString() }}'"
                           required
                           class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm
                                  text-slate-800 shadow-sm transition focus:border-blue-500
                                  focus:ring-2 focus:ring-blue-500/20 focus:outline-none
                                  @error('date_end') border-red-400 @enderror">
                </div>
            </div>

            {{-- Keterangan --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-slate-700" for="reason">
                    Keterangan <span class="text-red-500">*</span>
                </label>
                <textarea id="reason" name="reason" rows="3" required
                          minlength="10" maxlength="500"
                          x-model="reason"
                          placeholder="Jelaskan alasan ketidakhadiran kamu (minimal 10 karakter)..."
                          class="w-full resize-none rounded-xl border border-slate-300 bg-white px-3 py-2.5
                                 text-sm text-slate-800 shadow-sm transition focus:border-blue-500
                                 focus:ring-2 focus:ring-blue-500/20 focus:outline-none
                                 @error('reason') border-red-400 @enderror">{{ old('reason') }}</textarea>
                <p class="mt-1 text-right text-xs text-slate-400">
                    <span x-text="reason.length"></span>/500
                </p>
            </div>

            {{-- Upload surat --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-slate-700" for="file">
                    Surat Keterangan
                    <span class="font-normal text-slate-400">(opsional)</span>
                </label>
                <label for="file"
                       class="flex w-full cursor-pointer flex-col items-center justify-center
                              rounded-xl border-2 border-dashed border-slate-300 bg-slate-50
                              px-4 py-4 text-center transition hover:border-blue-400 hover:bg-blue-50"
                       :class="fileName ? 'border-green-400 bg-green-50' : ''">
                    <template x-if="!fileName">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-1.5 h-6 w-6 text-slate-400"
                                 fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <polyline points="16 16 12 12 8 16"/>
                                <line x1="12" y1="12" x2="12" y2="21"/>
                                <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/>
                            </svg>
                            <p class="text-sm text-slate-500">Klik untuk upload foto / PDF surat</p>
                            <p class="mt-0.5 text-xs text-slate-400">JPG, PNG, atau PDF • Maks. 2MB</p>
                        </div>
                    </template>
                    <template x-if="fileName">
                        <div class="flex items-center gap-2 text-sm text-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                 stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <span x-text="fileName" class="truncate max-w-[200px]"></span>
                        </div>
                    </template>
                    <input type="file" id="file" name="file"
                           accept="image/jpeg,image/png,.pdf"
                           class="hidden"
                           @change="fileName = $event.target.files[0]?.name ?? ''">
                </label>
            </div>

            {{-- Submit --}}
            <button type="submit"
                    :disabled="!type || !dateStart || reason.length < 10"
                    class="w-full rounded-xl py-3 text-sm font-semibold text-white shadow-sm
                           transition active:scale-95 disabled:cursor-not-allowed disabled:opacity-50"
                    :class="type === 'sakit'
                        ? 'bg-purple-600 hover:bg-purple-700'
                        : 'bg-blue-600 hover:bg-blue-700'">
                Kirim Pengajuan
            </button>
        </form>
    </div>
</section>

{{-- ============================================================
     RIWAYAT PENGAJUAN
============================================================ --}}
<section>
    <h2 class="mb-3 text-sm font-semibold text-slate-500">Riwayat Pengajuan</h2>

    @if($leaveRequests->count() > 0)
        <div class="space-y-2">
            @foreach($leaveRequests as $leave)
                @php
                    $statusCfg = match($leave->status) {
                        'approved' => ['bg' => 'bg-green-100',  'text' => 'text-green-700',  'border' => 'border-green-200',  'label' => 'Disetujui'],
                        'rejected' => ['bg' => 'bg-red-100',    'text' => 'text-red-700',    'border' => 'border-red-200',    'label' => 'Ditolak'],
                        default    => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'border' => 'border-yellow-200', 'label' => 'Menunggu'],
                    };
                    $typeLabel = $leave->type === 'sakit' ? 'Sakit' : 'Izin';
                    $typeColor = $leave->type === 'sakit' ? 'text-purple-600' : 'text-blue-600';
                @endphp

                <div class="rounded-xl bg-white px-4 py-3 shadow-sm ring-1 ring-slate-200">
                    <div class="flex items-start justify-between gap-2">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-semibold {{ $typeColor }}">{{ $typeLabel }}</span>
                                <span class="text-slate-300">·</span>
                                <span class="text-xs text-slate-500">
                                    {{ $leave->date_start->isoFormat('D MMM') }}
                                    @if($leave->date_start->ne($leave->date_end))
                                        – {{ $leave->date_end->isoFormat('D MMM Y') }}
                                    @else
                                        {{ $leave->date_start->isoFormat('Y') }}
                                    @endif
                                </span>
                            </div>
                            <p class="mt-1 text-xs text-slate-500 line-clamp-2">{{ $leave->reason }}</p>
                            @if($leave->notes && $leave->status !== 'pending')
                                <p class="mt-1 text-xs text-slate-600 italic">
                                    Catatan: {{ $leave->notes }}
                                </p>
                            @endif
                        </div>
                        <span class="shrink-0 rounded-full border px-2.5 py-0.5 text-xs font-semibold
                                     {{ $statusCfg['bg'] }} {{ $statusCfg['text'] }} {{ $statusCfg['border'] }}">
                            {{ $statusCfg['label'] }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

    @else
        <div class="flex flex-col items-center justify-center rounded-2xl border-2 border-dashed
                    border-slate-200 bg-white px-6 py-8 text-center">
            <p class="text-sm font-semibold text-slate-600">Belum Ada Pengajuan</p>
            <p class="mt-1 text-xs text-slate-400">Kamu belum pernah mengajukan izin atau sakit.</p>
        </div>
    @endif
</section>

@endsection

@push('scripts')
<script>
function permissionForm() {
    return {
        type:      '{{ old('type', '') }}',
        dateStart: '{{ old('date_start', '') }}',
        reason:    `{{ old('reason', '') }}`,
        fileName:  '',
    };
}
</script>
@endpush
