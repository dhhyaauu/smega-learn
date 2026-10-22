@extends('layouts.student')

@section('title', 'Absensi')

@section('content')

<div class="mb-5">
    <h1 class="text-xl font-bold text-slate-800">Absensi</h1>
    <p class="text-sm text-slate-500">
        {{ \Carbon\Carbon::now('Asia/Jakarta')->isoFormat('dddd, D MMMM Y') }}
    </p>
</div>

{{-- ================================================================
     BANNER MODE PENGUJIAN LOKAL
     Hanya muncul saat APP_ENV=local. Tidak tampil di production.
================================================================ --}}
@if($bypassRadius)
<div class="mb-5 flex items-start gap-3 rounded-xl border border-amber-300 bg-amber-50 px-4 py-3 text-sm text-amber-800">
    <span class="mt-0.5 shrink-0 text-base">🧪</span>
    <div>
        <p class="font-semibold">Mode Pengujian Lokal</p>
        <p class="mt-0.5 text-xs text-amber-700">
            Validasi radius GPS dinonaktifkan (<code class="rounded bg-amber-100 px-1 font-mono">APP_ENV=local</code>).
            Absensi tetap divalidasi waktu, foto, dan duplikasi.
            Mode ini <strong>tidak aktif di production</strong>.
        </p>
    </div>
</div>
@endif

{{-- ================================================================
     INFO JAM SEKOLAH
================================================================ --}}
<div class="mb-5 grid grid-cols-2 gap-2 text-center text-xs">
    <div class="rounded-xl bg-white px-3 py-2.5 ring-1 ring-slate-200">
        <p class="text-slate-400">Absen Masuk</p>
        <p class="mt-0.5 font-semibold text-slate-700">
            {{ \Carbon\Carbon::createFromTimeString($setting->check_in_start)->format('H:i') }}
            –
            {{ \Carbon\Carbon::createFromTimeString($setting->late_limit)->format('H:i') }}
        </p>
    </div>
    <div class="rounded-xl bg-white px-3 py-2.5 ring-1 ring-slate-200">
        <p class="text-slate-400">Absen Pulang</p>
        <p class="mt-0.5 font-semibold text-slate-700">
            {{ \Carbon\Carbon::createFromTimeString($setting->check_out_start)->format('H:i') }}
            –
            {{ \Carbon\Carbon::createFromTimeString($setting->check_out_end)->format('H:i') }}
        </p>
    </div>
</div>

{{-- ================================================================
     STATUS ABSENSI HARI INI (jika sudah absen)
================================================================ --}}
@if($today)
    <div class="mb-5 rounded-2xl bg-white p-4 ring-1 ring-slate-200">
        <p class="mb-2 text-xs font-semibold text-slate-500">Status Hari Ini</p>
        <div class="grid grid-cols-2 gap-3">
            <div class="rounded-xl bg-slate-50 p-3">
                <p class="text-xs text-slate-500">Masuk</p>
                <p class="mt-0.5 text-lg font-bold text-slate-800">
                    {{ $today->check_in_time ? \Carbon\Carbon::parse($today->check_in_time)->format('H:i') : '—' }}
                </p>
            </div>
            <div class="rounded-xl bg-slate-50 p-3">
                <p class="text-xs text-slate-500">Pulang</p>
                <p class="mt-0.5 text-lg font-bold text-slate-800">
                    {{ $today->check_out_time ? \Carbon\Carbon::parse($today->check_out_time)->format('H:i') : '—' }}
                </p>
            </div>
        </div>
    </div>
@endif

{{-- ================================================================
     KOMPONEN ABSENSI UTAMA — Alpine.js
================================================================ --}}
<div
    x-data="attendanceApp()"
    x-init="init()"
    @keydown.escape.window="closeCamera()"
>
    {{-- ---- STEP: IDLE (tombol mulai) ---- --}}
    <div x-show="step === 'idle'" x-transition>

        @php
            $checkedIn  = $today?->hasCheckedIn();
            $checkedOut = $today?->hasCheckedOut();
        @endphp

        @if($checkedIn && $checkedOut)
            {{-- Sudah lengkap --}}
            <div class="flex flex-col items-center rounded-2xl bg-green-50 px-6 py-10 text-center ring-1 ring-green-200">
                <span class="mb-3 text-4xl">✅</span>
                <p class="font-semibold text-green-800">Absensi Hari Ini Sudah Lengkap</p>
                <p class="mt-1 text-sm text-green-600">Masuk & pulang sudah tercatat. Sampai jumpa besok!</p>
            </div>

        @elseif($checkedIn && !$checkedOut)
            {{-- Sudah masuk, belum pulang --}}
            <button @click="startFlow('check_out')"
                    class="flex w-full items-center justify-between rounded-2xl bg-amber-500 px-5 py-4 text-white
                           shadow-md transition active:scale-95">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                    </div>
                    <div class="text-left">
                        <p class="font-bold">Absen Pulang</p>
                        <p class="text-sm text-amber-100">Selfie + GPS diperlukan</p>
                    </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-200" fill="none"
                     stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </button>

        @else
            {{-- Belum absen sama sekali --}}
            <button @click="startFlow('check_in')"
                    class="flex w-full items-center justify-between rounded-2xl bg-blue-600 px-5 py-4 text-white
                           shadow-md transition active:scale-95">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                            <polyline points="10 17 15 12 10 7"/>
                            <line x1="15" y1="12" x2="3" y2="12"/>
                        </svg>
                    </div>
                    <div class="text-left">
                        <p class="font-bold">Absen Masuk</p>
                        <p class="text-sm text-blue-200">Selfie + GPS diperlukan</p>
                    </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-300" fill="none"
                     stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </button>
        @endif
    </div>

    {{-- ---- STEP: GPS ---- --}}
    <div x-show="step === 'gps'" x-transition class="rounded-2xl bg-white p-6 ring-1 ring-slate-200">
        <h2 class="mb-4 font-semibold text-slate-700">📍 Mendeteksi Lokasi</h2>

        <div x-show="gpsStatus === 'loading'" class="flex flex-col items-center py-6 text-center">
            <div class="mb-3 h-10 w-10 animate-spin rounded-full border-4 border-blue-200 border-t-blue-600"></div>
            <p class="text-sm text-slate-600">Sedang mendeteksi lokasi GPS kamu...</p>
            <p class="mt-1 text-xs text-slate-400">Pastikan GPS aktif dan izin lokasi diizinkan.</p>
        </div>

        <div x-show="gpsStatus === 'success'" class="space-y-3">
            <div class="flex items-center gap-2 rounded-xl bg-green-50 px-4 py-3 text-sm text-green-700 ring-1 ring-green-200">
                <span>✅</span>
                <span>Lokasi berhasil terdeteksi</span>
            </div>
            <div class="rounded-xl bg-slate-50 px-4 py-3 text-xs text-slate-600">
                <p>Lat: <span x-text="latitude.toFixed(6)" class="font-mono"></span></p>
                <p>Lng: <span x-text="longitude.toFixed(6)" class="font-mono"></span></p>
                <p>Akurasi: <span x-text="accuracy.toFixed(0) + ' meter'" class="font-mono"></span></p>
            </div>
            @if($bypassRadius)
            <div class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-2.5 text-xs text-amber-700">
                🧪 Validasi radius dilewati (mode lokal) — lokasi tetap dikirim ke server.
            </div>
            @endif
            <button @click="step = 'camera'"
                    class="w-full rounded-xl bg-blue-600 py-3 text-sm font-semibold text-white transition active:scale-95">
                Lanjut ke Kamera →
            </button>
        </div>

        <div x-show="gpsStatus === 'error'" class="space-y-3">
            <div class="rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700 ring-1 ring-red-200">
                <p class="font-semibold">Gagal mendapatkan lokasi</p>
                <p class="mt-1" x-text="gpsError"></p>
            </div>
            <div class="rounded-xl bg-amber-50 px-4 py-3 text-xs text-amber-700">
                <p class="font-semibold mb-1">Cara mengaktifkan lokasi:</p>
                <ol class="list-decimal list-inside space-y-1">
                    <li>Buka pengaturan browser kamu</li>
                    <li>Cari izin lokasi untuk situs ini</li>
                    <li>Ubah ke "Izinkan" lalu muat ulang</li>
                </ol>
            </div>
            <div class="flex gap-2">
                <button @click="requestGPS()"
                        class="flex-1 rounded-xl bg-blue-600 py-2.5 text-sm font-semibold text-white transition active:scale-95">
                    Coba Lagi
                </button>
                <button @click="step = 'idle'"
                        class="flex-1 rounded-xl bg-slate-100 py-2.5 text-sm font-semibold text-slate-700 transition active:scale-95">
                    Batal
                </button>
            </div>
        </div>
    </div>

    {{-- ---- STEP: KAMERA ---- --}}
    <div x-show="step === 'camera'" x-transition class="rounded-2xl bg-white p-4 ring-1 ring-slate-200">
        <div class="mb-3 flex items-center justify-between">
            <h2 class="font-semibold text-slate-700">📸 Ambil Selfie</h2>
            <button @click="closeCamera(); step = 'idle'"
                    class="rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        {{-- Error kamera --}}
        <div x-show="cameraError" class="mb-3 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700 ring-1 ring-red-200">
            <p class="font-semibold">Kamera tidak dapat diakses</p>
            <p class="mt-1" x-text="cameraError"></p>
            <div class="mt-2 text-xs text-red-600">
                <p>Pastikan:</p>
                <ul class="ml-3 list-disc space-y-0.5">
                    <li>Izin kamera sudah diberikan ke browser</li>
                    <li>Tidak ada aplikasi lain yang menggunakan kamera</li>
                    <li>Perangkat memiliki kamera</li>
                </ul>
            </div>
        </div>

        {{-- Live preview --}}
        <div x-show="!capturedPhoto && !cameraError" class="relative overflow-hidden rounded-xl bg-black"
             style="aspect-ratio: 3/4;">
            <video x-ref="video" autoplay playsinline muted
                   class="h-full w-full object-cover scale-x-[-1]"></video>
            {{-- Panduan selfie --}}
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                <div class="h-48 w-36 rounded-full border-2 border-white/50"></div>
            </div>
            <div class="absolute bottom-3 left-0 right-0 text-center">
                <span class="rounded-full bg-black/50 px-3 py-1 text-xs text-white">
                    Posisikan wajah di dalam lingkaran
                </span>
            </div>
        </div>

        {{-- Preview foto yang sudah diambil --}}
        <div x-show="capturedPhoto" class="relative overflow-hidden rounded-xl bg-black"
             style="aspect-ratio: 3/4;">
            <img :src="capturedPhoto" class="h-full w-full object-cover scale-x-[-1]" alt="Foto selfie">
            <div class="absolute bottom-3 left-0 right-0 text-center">
                <span class="rounded-full bg-green-600/80 px-3 py-1 text-xs text-white">
                    Foto berhasil diambil
                </span>
            </div>
        </div>

        {{-- Canvas tersembunyi untuk capture --}}
        <canvas x-ref="canvas" class="hidden"></canvas>

        {{-- Tombol ambil / ulangi / kirim --}}
        <div class="mt-4 space-y-2">
            <template x-if="!capturedPhoto && !cameraError">
                <button @click="capturePhoto()"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-blue-600
                               py-3.5 text-sm font-semibold text-white shadow transition active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                         stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="4"/>
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                    </svg>
                    Ambil Foto
                </button>
            </template>

            <template x-if="capturedPhoto">
                <div class="flex gap-2">
                    <button @click="retakePhoto()"
                            class="flex-1 rounded-xl bg-slate-100 py-3 text-sm font-semibold
                                   text-slate-700 transition active:scale-95">
                        🔄 Ulangi
                    </button>
                    <button @click="submitAttendance()"
                            :disabled="submitting"
                            class="flex-1 rounded-xl py-3 text-sm font-semibold text-white
                                   transition active:scale-95 disabled:opacity-60"
                            :class="flowType === 'check_in' ? 'bg-blue-600' : 'bg-amber-500'">
                        <span x-show="!submitting">
                            <span x-text="flowType === 'check_in' ? '✅ Kirim Absen Masuk' : '✅ Kirim Absen Pulang'"></span>
                        </span>
                        <span x-show="submitting" class="flex items-center justify-center gap-2">
                            <span class="h-4 w-4 animate-spin rounded-full border-2 border-white/30 border-t-white"></span>
                            Mengirim...
                        </span>
                    </button>
                </div>
            </template>

            <template x-if="cameraError">
                <button @click="step = 'idle'"
                        class="w-full rounded-xl bg-slate-100 py-3 text-sm font-semibold text-slate-700 transition active:scale-95">
                    Kembali
                </button>
            </template>
        </div>
    </div>

    {{-- ---- STEP: SUKSES ---- --}}
    <div x-show="step === 'success'" x-transition class="rounded-2xl bg-white px-6 py-10 text-center ring-1 ring-slate-200">
        <div class="mb-4 text-5xl" x-text="flowType === 'check_in' ? '🎉' : '🏠'"></div>
        <h2 class="text-lg font-bold text-slate-800" x-text="successMessage"></h2>
        <p class="mt-2 text-sm text-slate-500" x-text="successTime"></p>
        <button @click="step = 'idle'; window.location.reload()"
                class="mt-6 w-full rounded-xl bg-blue-600 py-3 text-sm font-semibold text-white transition active:scale-95">
            Selesai
        </button>
    </div>

    {{-- ---- STEP: DITOLAK (di luar radius atau kesalahan lain) ---- --}}
    <div x-show="step === 'rejected'" x-transition class="rounded-2xl bg-white p-5 ring-1 ring-slate-200">

        {{-- Di luar radius --}}
        <template x-if="rejectedType === 'out_of_radius'">
            <div class="space-y-3">
                <div class="flex items-start gap-3 rounded-xl bg-red-50 px-4 py-3 ring-1 ring-red-200">
                    <span class="mt-0.5 text-xl">📍</span>
                    <div>
                        <p class="font-semibold text-red-800">Di Luar Radius Sekolah</p>
                        <p class="mt-1 text-sm text-red-600" x-text="rejectedMessage"></p>
                    </div>
                </div>
                {{-- Visualisasi jarak --}}
                <div x-show="rejectedDistance > 0"
                     class="rounded-xl bg-slate-50 px-4 py-3 text-sm text-slate-600 ring-1 ring-slate-200">
                    <div class="flex justify-between">
                        <span>Jarak kamu dari sekolah</span>
                        <span class="font-bold text-red-600" x-text="rejectedDistance + ' meter'"></span>
                    </div>
                    <div class="mt-1.5 h-2 w-full overflow-hidden rounded-full bg-slate-200">
                        <div class="h-full rounded-full bg-red-500 transition-all"
                             :style="'width: ' + Math.min(100, (rejectedRadius / rejectedDistance * 100)).toFixed(0) + '%'">
                        </div>
                    </div>
                    <div class="mt-1 flex justify-between text-xs text-slate-400">
                        <span>Sekolah</span>
                        <span>Radius: <span x-text="rejectedRadius + ' m'"></span></span>
                    </div>
                </div>
                <div class="rounded-xl bg-amber-50 px-4 py-3 text-xs text-amber-700">
                    <p class="font-semibold mb-1">Yang perlu dilakukan:</p>
                    <ul class="list-disc list-inside space-y-1">
                        <li>Pastikan kamu berada di area sekolah</li>
                        <li>Tunggu sebentar agar GPS lebih akurat</li>
                        <li>Nonaktifkan WiFi sementara untuk GPS yang lebih presisi</li>
                    </ul>
                </div>
                <div class="flex gap-2">
                    <button @click="startFlow(flowType)"
                            class="flex-1 rounded-xl bg-blue-600 py-2.5 text-sm font-semibold text-white transition active:scale-95">
                        🔄 Coba Lagi
                    </button>
                    <button @click="step = 'idle'"
                            class="flex-1 rounded-xl bg-slate-100 py-2.5 text-sm font-semibold text-slate-700 transition active:scale-95">
                        Batal
                    </button>
                </div>
            </div>
        </template>

        {{-- Error lain (jam, dll.) --}}
        <template x-if="rejectedType !== 'out_of_radius'">
            <div class="space-y-3">
                <div class="rounded-xl bg-amber-50 px-4 py-3 ring-1 ring-amber-200">
                    <p class="font-semibold text-amber-800">Absensi Tidak Dapat Dilakukan</p>
                    <p class="mt-1 text-sm text-amber-700" x-text="rejectedMessage"></p>
                </div>
                <button @click="step = 'idle'"
                        class="w-full rounded-xl bg-slate-100 py-3 text-sm font-semibold text-slate-700 transition active:scale-95">
                    Kembali
                </button>
            </div>
        </template>

    </div>

</div>{{-- end x-data --}}

@endsection

@push('scripts')
<script>
function attendanceApp() {
    return {
        step:           'idle',   // idle | gps | camera | success | rejected
        flowType:       null,     // check_in | check_out

        // GPS state
        gpsStatus:  'loading',    // loading | success | error
        gpsError:   '',
        latitude:   0,
        longitude:  0,
        accuracy:   0,

        // Camera state
        stream:         null,
        capturedPhoto:  null,
        cameraError:    '',

        // Submit state
        submitting:     false,
        successMessage: '',
        successTime:    '',

        // Rejected state
        rejectedMessage:  '',
        rejectedType:     '',  // out_of_radius | too_early | too_late | other
        rejectedDistance: 0,
        rejectedRadius:   0,

        init() {
            // Alpine sudah siap
        },

        /* ---- GPS ---- */
        startFlow(type) {
            this.flowType      = type;
            this.step          = 'gps';
            this.gpsStatus     = 'loading';
            this.gpsError      = '';
            this.capturedPhoto = null;
            this.requestGPS();
        },

        requestGPS() {
            this.gpsStatus = 'loading';
            if (! ('geolocation' in navigator)) {
                this.gpsStatus = 'error';
                this.gpsError  = 'Browser ini tidak mendukung GPS. Gunakan browser yang lebih baru.';
                return;
            }

            navigator.geolocation.getCurrentPosition(
                (pos) => {
                    this.latitude  = pos.coords.latitude;
                    this.longitude = pos.coords.longitude;
                    this.accuracy  = pos.coords.accuracy;
                    this.gpsStatus = 'success';
                },
                (err) => {
                    // GPS browser gagal — jangan tampilkan "di luar radius"
                    this.latitude  = 0;
                    this.longitude = 0;
                    this.gpsStatus = 'error';
                    switch (err.code) {
                        case 1:
                            this.gpsError = 'Izin lokasi ditolak. Silakan izinkan akses lokasi di pengaturan browser, lalu coba lagi.';
                            break;
                        case 2:
                            this.gpsError = 'Lokasi tidak tersedia. Pastikan GPS perangkat aktif dan coba lagi.';
                            break;
                        case 3:
                            this.gpsError = 'Permintaan lokasi habis waktu. Pastikan GPS aktif dan koneksi internet tersedia.';
                            break;
                        default:
                            this.gpsError = 'Terjadi kesalahan saat mengambil lokasi: ' + err.message;
                    }
                },
                { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 }
            );
        },

        /* ---- CAMERA ---- */
        async openCamera() {
            this.cameraError   = '';
            this.capturedPhoto = null;

            if (! navigator.mediaDevices || ! navigator.mediaDevices.getUserMedia) {
                this.cameraError = 'Browser ini tidak mendukung akses kamera. Gunakan Chrome, Firefox, atau Safari versi terbaru.';
                return;
            }

            try {
                this.stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: 'user',
                        width:  { ideal: 640 },
                        height: { ideal: 480 },
                    },
                    audio: false,
                });

                await this.$nextTick();
                const video = this.$refs.video;
                if (video) {
                    video.srcObject = this.stream;
                }
            } catch (err) {
                this.stream = null;
                if (err.name === 'NotAllowedError' || err.name === 'PermissionDeniedError') {
                    this.cameraError = 'Izin kamera ditolak. Silakan izinkan akses kamera di pengaturan browser kamu.';
                } else if (err.name === 'NotFoundError' || err.name === 'DevicesNotFoundError') {
                    this.cameraError = 'Kamera tidak ditemukan. Pastikan perangkat memiliki kamera yang terhubung.';
                } else if (err.name === 'NotReadableError') {
                    this.cameraError = 'Kamera sedang digunakan oleh aplikasi lain. Tutup aplikasi lain dan coba lagi.';
                } else {
                    this.cameraError = 'Gagal mengakses kamera: ' + err.message;
                }
            }
        },

        closeCamera() {
            if (this.stream) {
                this.stream.getTracks().forEach(t => t.stop());
                this.stream = null;
            }
        },

        capturePhoto() {
            const video  = this.$refs.video;
            const canvas = this.$refs.canvas;
            if (! video || ! canvas) return;

            canvas.width  = video.videoWidth  || 640;
            canvas.height = video.videoHeight || 480;

            const ctx = canvas.getContext('2d');
            ctx.translate(canvas.width, 0);
            ctx.scale(-1, 1);
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            this.capturedPhoto = canvas.toDataURL('image/jpeg', 0.85);
            this.closeCamera();
        },

        retakePhoto() {
            this.capturedPhoto = null;
            this.openCamera();
        },

        /* ---- SUBMIT ---- */
        async submitAttendance() {
            if (this.submitting) return;
            this.submitting = true;

            const url = this.flowType === 'check_in'
                ? '{{ route('student.attendance.checkin') }}'
                : '{{ route('student.attendance.checkout') }}';

            try {
                const resp = await fetch(url, {
                    method:  'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        latitude:  this.latitude,
                        longitude: this.longitude,
                        photo:     this.capturedPhoto,
                    }),
                });

                const data = await resp.json();

                if (resp.ok) {
                    // Berhasil
                    this.step           = 'success';
                    this.successMessage = data.message;
                    this.successTime    = this.flowType === 'check_in'
                        ? 'Tercatat masuk pukul ' + (data.check_in ?? '')
                        : 'Tercatat pulang pukul ' + (data.check_out ?? '');
                    // Tampilkan info jarak jika tersedia (mode lokal)
                    if (data.bypass_radius && data.distance_meters > 0) {
                        this.successTime += ` · Jarak dari sekolah: ${data.distance_meters} m`;
                    }
                    this.submitting = false;
                } else {
                    // Gagal — bedakan jenis error
                    this.submitting       = false;
                    this.rejectedMessage  = data.message ?? 'Terjadi kesalahan.';
                    this.rejectedType     = data.error_type ?? 'other';
                    this.rejectedDistance = data.distance_meters ?? 0;
                    this.rejectedRadius   = data.radius_meters   ?? 0;
                    this.closeCamera();
                    this.step = 'rejected';
                }
            } catch {
                this.submitting = false;
                this.rejectedMessage = 'Koneksi terputus. Periksa internet kamu dan coba lagi.';
                this.rejectedType    = 'other';
                this.closeCamera();
                this.step = 'rejected';
            }
        },
    };
}

// Buka kamera otomatis saat step berubah ke 'camera'
document.addEventListener('alpine:initialized', () => {
    const el = document.querySelector('[x-data^="attendanceApp"]');
    if (!el) return;
    const app = Alpine.$data(el);
    Alpine.effect(() => {
        if (app.step === 'camera') {
            app.openCamera();
        }
    });
});
</script>
@endpush
