<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Master Data Siswa</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Statistik --}}
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-center gap-4">
                <div class="text-4xl font-bold text-blue-600">{{ $totalSiswa }}</div>
                <div>
                    <p class="font-semibold text-blue-800">Total Siswa Terdaftar</p>
                    <p class="text-sm text-blue-600">Data tersimpan di database</p>
                </div>
            </div>

            {{-- Alert sukses --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                    <strong>Berhasil!</strong> {{ session('success') }}
                </div>
            @endif

            {{-- Alert error --}}
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded">
                    <strong>Error:</strong> {{ session('error') }}
                </div>
            @endif

            {{-- Form Upload --}}
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-1">Import Data Siswa dari Excel</h3>
                <p class="text-sm text-gray-500 mb-4">Format kolom: No, NIS, NISN, Nama Lengkap, Jenis Kelamin, Tingkat, Jurusan, Kelas, Email, No. Telepon</p>

                <form action="{{ route('admin.import-excel') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center gap-3">
                        <input type="file" name="file" accept=".xlsx,.xls" required
                               class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg p-2">
                        <button type="submit"
                                class="whitespace-nowrap bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-lg">
                            Upload & Import
                        </button>
                    </div>
                    @error('file')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </form>
            </div>

            {{-- Info password default --}}
            <div class="bg-yellow-50 border border-yellow-300 rounded-lg p-4 text-sm text-yellow-800">
                <strong>Info:</strong> Password default setiap siswa = NIS masing-masing. Siswa bisa ganti password setelah login pertama kali.
            </div>

        </div>
    </div>
</x-app-layout>
