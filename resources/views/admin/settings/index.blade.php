<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Pengaturan Sekolah</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session("success"))
                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                    {{ session("success") }}
                </div>
            @endif

            {{-- Form Lokasi --}}
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Lokasi & Radius GPS</h3>
                <form action="{{ route('admin.settings.location') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Latitude Sekolah</label>
                            <input type="number" name="school_latitude" step="0.000001"
                                   value="{{ $setting->school_latitude }}"
                                   class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                            @error('school_latitude')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Longitude Sekolah</label>
                            <input type="number" name="school_longitude" step="0.000001"
                                   value="{{ $setting->school_longitude }}"
                                   class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                            @error('school_longitude')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Radius Presensi (meter)</label>
                            <input type="number" name="radius_meter" min="10" max="1000"
                                   value="{{ $setting->radius_meter }}"
                                   class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                            @error('radius_meter')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Akurasi GPS Maks (meter)</label>
                            <input type="number" name="max_accuracy" min="5" max="100"
                                   value="{{ $setting->max_accuracy }}"
                                   class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                            @error('max_accuracy')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-lg text-sm">
                        Simpan Lokasi
                    </button>
                </form>
            </div>

            {{-- Form Jadwal --}}
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Jadwal Presensi</h3>
                <form action="{{ route('admin.settings.schedule') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jam Masuk</label>
                            <input type="time" name="jam_masuk"
                                   value="{{ substr($schedule->jam_masuk, 0, 5) }}"
                                   class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Batas Terlambat</label>
                            <input type="time" name="batas_terlambat"
                                   value="{{ substr($schedule->batas_terlambat, 0, 5) }}"
                                   class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jam Pulang</label>
                            <input type="time" name="jam_pulang"
                                   value="{{ substr($schedule->jam_pulang, 0, 5) }}"
                                   class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                        </div>
                    </div>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-5 rounded-lg text-sm">
                        Simpan Jadwal
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
