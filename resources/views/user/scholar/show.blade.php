@extends('user.dashboard')

@section('content')
    <div class="container mx-auto p-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('pendaftaran.store', $scholarship->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-blue-500 p-6 text-white">
                    <h2 class="text-2xl font-bold">Detail Beasiswa: {{ $scholarship->name }}</h2>
                </div>
                <div class="p-6 space-y-4">
                    <h5 class="text-xl font-semibold text-gray-800 mb-2">Pendaftaran Beasiswa
                        {{ $scholarship->scholarship->name }}</h5>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <p class="text-gray-600 mb-2"><strong>Durasi Beasiswa:</strong> {{ $scholarship->duration }} Bulan
                        </p>
                        <p class="text-gray-600 mb-2"><strong>Mulai Pendaftaran:</strong>
                            {{ \Carbon\Carbon::parse($scholarship->start_registration_at)->format('d M Y') }}</p>
                        <p class="text-gray-600 mb-2"><strong>Akhir Pendaftaran:</strong>
                            {{ \Carbon\Carbon::parse($scholarship->end_registration_at)->format('d M Y') }}</p>
                        <p class="text-gray-600 mb-2"><strong>Minimal IPK:</strong>
                            {{ number_format($scholarship->min_ipk, 2) }}</p>
                    </div>
                    <div class="mt-4">
                        <h5 class="text-lg font-semibold text-gray-800">Berkas yang Diperlukan</h5>
                        <p class="text-gray-600">Upload file PDF <span class="text-pink-500">*</span></p>
                        <div class="mt-2">
                            <label for="supervisor_approval_file" class="block text-sm font-medium text-gray-700">Surat Izin
                                Dosen Wali</label>
                            <input type="file"
                                class="mt-1 block w-full border text-base border-gray-300 px-2 py-2 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                id="supervisor_approval_file" name="supervisor_approval_file" required>
                            @error('supervisor_approval_file')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <ul class="space-y-4 mt-4">
                            @foreach ($fileRequirements as $file_requirement)
                                <div>
                                    <label for="file_requirement_{{ $file_requirement->id }}"
                                        class="block text-sm font-medium text-gray-700">{{ $file_requirement->name }}</label>
                                    <input type="file"
                                        class="mt-1 block w-full text-base border border-gray-300 px-2 py-2 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        id="file_requirement_{{ $file_requirement->id }}"
                                        name="file_requirements[{{ $file_requirement->id }}]" required>
                                    @error('file_requirements.' . $file_requirement->id)
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </ul>
                    </div>
                    <input type="hidden" name="scholarship_data_id" value="{{ $scholarship->id }}">
                </div>
            </div>
            <div class="flex space-x-4 mt-6">
                <button
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="daftar" type="submit">Daftar</button>
                <a href="{{ route('pendaftaran.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">Kembali</a>
            </div>
        </form>
    </div>
@endsection
