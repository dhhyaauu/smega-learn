@extends('layouts.student')

@section('title', 'Izin / Sakit')

@section('content')

    {{-- ============================================================
         JUDUL HALAMAN
    ============================================================ --}}
    <div class="mb-5">
        <h1 class="text-xl font-bold text-slate-800">Izin / Sakit</h1>
        <p class="text-sm text-slate-500">Ajukan ketidakhadiran ke sekolah</p>
    </div>

    {{-- ============================================================
         FORM PENGAJUAN IZIN
         - Action form akan diisi setelah route POST tersedia (Orang 3)
         - Upload surat akan diimplementasikan pada tahap Izin/Sakit
         - Validasi server = tanggung jawab Orang 3
    ============================================================ --}}
    <section class="mb-6">
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
            <h2 class="mb-4 font-semibold text-slate-700">Form Pengajuan</h2>

            {{--
                TODO (Tahap 7 - Izin/Sakit):
                - Ganti action="#" dengan route('student.permission.store')
                - Tambahkan @csrf
                - Tambahkan validasi error dari $errors
                - Tambahkan upload surat (opsional)
            --}}
            <form action="#" method="POST" class="space-y-4" enctype="multipart/form-data">
                {{-- CSRF akan ditambahkan saat route POST tersedia --}}
                {{-- @csrf --}}

                {{-- Jenis izin --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700" for="type">
                        Jenis Ketidakhadiran
                    </label>
                    <select id="type" name="type"
                            class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm
                                   text-slate-800 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                   focus:outline-none">
                        <option value="">— Pilih jenis —</option>
                        <option value="izin">Izin</option>
                        <option value="sakit">Sakit</option>
                    </select>
                </div>

                {{-- Tanggal mulai --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700" for="date_start">
                        Tanggal Mulai
                    </label>
                    <input type="date" id="date_start" name="date_start"
                           min="{{ date('Y-m-d') }}"
                           class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm
                                  text-slate-800 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                  focus:outline-none">
                </div>

                {{-- Tanggal selesai --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700" for="date_end">
                        Tanggal Selesai
                    </label>
                    <input type="date" id="date_end" name="date_end"
                           min="{{ date('Y-m-d') }}"
                           class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm
                                  text-slate-800 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                  focus:outline-none">
                </div>

                {{-- Keterangan --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700" for="reason">
                        Keterangan
                    </label>
                    <textarea id="reason" name="reason" rows="3"
                              placeholder="Jelaskan alasan ketidakhadiran kamu..."
                              class="w-full resize-none rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm
                                     text-slate-800 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                     focus:outline-none"></textarea>
                </div>

                {{-- Upload surat (opsional) --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700" for="file">
                        Surat Keterangan
                        <span class="font-normal text-slate-400">(opsional)</span>
                    </label>
                    <label for="file"
                           class="flex w-full cursor-pointer flex-col items-center justify-center rounded-xl border-2
                                  border-dashed border-slate-300 bg-slate-50 px-4 py-5 text-center
                                  transition hover:border-blue-400 hover:bg-blue-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mb-2 h-6 w-6 text-slate-400" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="16 16 12 12 8 16"/>
                            <line x1="12" y1="12" x2="12" y2="21"/>
                            <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/>
                        </svg>
                        <p class="text-sm text-slate-500">Klik untuk upload foto / PDF surat</p>
                        <p class="mt-0.5 text-xs text-slate-400">JPG, PNG, atau PDF • Maks. 2MB</p>
                        <input type="file" id="file" name="file" accept="image/*,.pdf" class="hidden">
                    </label>
                </div>

                {{-- Tombol kirim — disabled sampai route POST tersedia --}}
                <button type="submit" disabled
                        class="w-full cursor-not-allowed rounded-xl bg-slate-300 px-4 py-3 text-sm font-semibold
                               text-slate-500 transition">
                    Kirim Pengajuan
                    <span class="ml-1 text-xs font-normal">(Menunggu backend)</span>
                </button>

            </form>
        </div>
    </section>

    {{-- ============================================================
         RIWAYAT PENGAJUAN IZIN
         Data $leaveRequests dari controller (tersedia setelah Orang 3 selesai).
    ============================================================ --}}
    <section>
        <h2 class="mb-3 text-sm font-semibold text-slate-500">Riwayat Pengajuan</h2>

        @if(isset($leaveRequests) && $leaveRequests->count() > 0)

            <div class="space-y-2">
                @foreach($leaveRequests as $leave)
                    @php
                        $statusColor = match($leave->status ?? '') {
                            'approved' => 'bg-green-100 text-green-700 border-green-200',
                            'rejected' => 'bg-red-100 text-red-700 border-red-200',
                            default    => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                        };
                        $statusLabel = match($leave->status ?? '') {
                            'approved' => 'Disetujui',
                            'rejected' => 'Ditolak',
                            default    => 'Menunggu',
                        };
                        $typeLabel = match($leave->type ?? '') {
                            'sakit' => 'Sakit',
                            default => 'Izin',
                        };
                    @endphp
                    <div class="flex items-center gap-3 rounded-xl bg-white px-4 py-3 shadow-sm ring-1 ring-slate-200">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-slate-800">{{ $typeLabel }}</p>
                            <p class="mt-0.5 text-xs text-slate-500">
                                {{ \Carbon\Carbon::parse($leave->date_start)->isoFormat('D MMM') }}
                                @if($leave->date_start !== $leave->date_end)
                                    — {{ \Carbon\Carbon::parse($leave->date_end)->isoFormat('D MMM Y') }}
                                @else
                                    {{ \Carbon\Carbon::parse($leave->date_start)->isoFormat('Y') }}
                                @endif
                            </p>
                        </div>
                        <span class="rounded-full border px-2.5 py-0.5 text-xs font-semibold {{ $statusColor }}">
                            {{ $statusLabel }}
                        </span>
                    </div>
                @endforeach
            </div>

        @else

            <div class="flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 bg-white px-6 py-8 text-center">
                <p class="text-sm font-semibold text-slate-600">Belum Ada Pengajuan</p>
                <p class="mt-1 text-xs text-slate-400">
                    @if(!isset($leaveRequests))
                        Data tersedia setelah backend terhubung.
                    @else
                        Kamu belum pernah mengajukan izin atau sakit.
                    @endif
                </p>
            </div>

        @endif
    </section>

@endsection
