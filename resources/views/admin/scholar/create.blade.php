@extends('admin.dashboard')

@section('navbar', 'Beasiswa')

@section('content')
    <div class="grid grid-cols-2 gap-4">
        <!-- Bagian Kiri -->
        <div class="col-span-1">
            <div class="mb-4 text-start text-lg">
                <a href="{{ route('beasiswa.index') }}"
                    class="inline-flex items-start px-2 py-1 text-blue-600 hover:bg-blue-100 rounded-lg">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18">
                        </path>
                    </svg>
                </a>
            </div>

            <form action="{{ route('beasiswa.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="mb-1 ml-1 block text-sm font-medium text-gray-600">Nama Beasiswa</label>
                    <input type="text"
                        class="w-full px-3 py-2 placeholder-gray-400 border-solid border-1 border-neutral-200 rounded-md  focus:border-sky-500 text-sm"
                        name="name" id="name" placeholder="Nama Beasiswa" value="{{ old('name') }}" required>
                </div>

                <div class="mb-4">
                    <label for="year" class="mb-1 ml-1 block text-sm font-medium text-gray-600">Tahun</label>
                    <select
                        class="form-select w-full px-3 py-2 border-1 border-solid border-neutral-200 rounded-md focus:border-sky-500 outline-none text-sm"
                        name="year" id="year" required>
                        <option value="" disabled selected class="text-gray-600 hidden">Tahun</option>
                        @foreach ($tahunArray as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-4">
                    <label for="status_scholarship" class="mb-1 ml-1 block text-sm font-medium text-gray-600">Status
                        Beasiswa</label>
                    <select
                        class="form-select w-full px-3 py-2 border-1 border-solid border-neutral-200 rounded-md focus:border-sky-500 outline-none text-sm"
                        name="status_scholarship" id="status_scholarship">
                        <option value="" disabled selected class="text-gray-600 hidden">Status</option>
                        <option value="Umum">Umum</option>
                        <option value="Khusus">Khusus</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="donors_id" class="mb-1 ml-1 block text-sm font-medium text-gray-600">Pilih Donatur</label>
                    <select
                        class="form-select w-full px-3 py-2 border-1 border-solid border-neutral-200 rounded-md focus:border-sky-500 outline-none text-sm"
                        name="donors_id" id="donors_id">
                        <option value="" disabled selected class="text-gray-600 hidden">Nama Donatur</option>
                        @foreach ($data as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="value" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Nominal</label>
                    <input type="text"
                        class="w-full px-3 py-2 placeholder-gray-400 border-solid border-1 border-neutral-200 rounded-md  focus:border-sky-500 text-sm"
                        name="value" id="value" placeholder="Nominal" value="{{ old('value') }}">
                </div>

                <div class="mb-4">
                    <label for="status_value" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Per</label>
                    <select
                        class="form-select w-full px-3 py-2 border-1 border-solid border-neutral-200 rounded-md focus:border-sky-500 outline-none text-sm"
                        name="status_value" id="status_value">
                        <option value="" disabled selected class="text-gray-600 hidden">Bulan/Tahun</option>
                        <option value="Bulan">Bulan</option>
                        <option value="Tahun">Tahun</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="duration" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Durasi</label>
                    <select
                        class="form-select w-full px-3 py-2 border-1 border-solid border-neutral-200 rounded-md focus:border-sky-500 outline-none text-sm"
                        name="duration" id="duration">
                        <option value="" disabled selected class="text-gray-600 hidden">Durasi Beasiswa</option>
                        @for ($i = 1; $i <= 48; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
        </div>

        <!-- Bagian Kanan -->
        <div class="col-span-1 pt-14 pl-16">

            <div class="mb-4">
                <label for="start_regis_at" class="block text-sm font-medium text-gray-600 mb-1">Mulai Pendaftaran
                    Beasiswa</label>
                <input type="date" id="start_regis_at" name="start_regis_at"
                    class="block w-full px-3 py-2 border-1 border-gray-300 rounded-md focus:ring-1 outline-none focus:ring-sky-500 text-sm"
                    value="{{ old('start_regis_at') }}">
            </div>


            <div class="mb-4">
                <label for="end_regis_at" class="block text-sm font-medium text-gray-600 mb-1">Akhir Pendaftaran
                    Beasiswa</label>
                <input type="date" id="end_regis_at" name="end_regis_at"
                    class="block w-full px-3 py-2 border-1 border-gray-300 rounded-md focus:ring-1 focus:ring-sky-500 text-sm"
                    value="{{ old('end_regis_at') }}">
            </div>


            <div class="mb-4">
                <label for="min_ipk" class="block text-sm font-medium text-gray-600 mb-1">Minimal IPK</label>
                <input type="text" id="min_ipk" name="min_ipk" placeholder="IPK"
                    class="block w-full px-3 py-2 border-1 border-gray-300 rounded-md focus:ring-1 focus:ring-sky-500 text-sm"
                    value="{{ old('min_ipk') }}">
            </div>


            <div class="mb-4">
                <label for="start_graduation_at" class="mb-1 ml-1 block text-sm font-medium text-gray-600">Mulai Penentuan
                    Kelulusan</label>
                <input type="date" id="start_graduation_at" name="start_graduation_at"
                    class="block w-full px-3 py-2 border-1 border-gray-300 rounded-md focus:ring-1 focus:ring-sky-500 text-sm"
                    value="{{ old('start_graduation_at') }}">
            </div>

            <div class="mb-4">
                <label for="end_graduation_at" class="mb-1 ml-1 block text-sm font-medium text-gray-600">Akhir Penentuan
                    Kelulusan</label>
                <input type="date" id="end_graduation_at" name="end_graduation_at"
                    class="block w-full px-3 py-2 border-1 border-gray-300 rounded-md focus:ring-1 focus:ring-sky-500 text-sm"
                    value="{{ old('end_graduation_at') }}">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1 ml-1">Kuota Fakultas</label>
                <div class="flex items-center">

                    <input type="number" name="kuota[MIPA]" id="kuota_fakultas_1"
                        class="w-full px-3 py-2 border-1 border-gray-300 rounded-md focus:ring-1 focus:ring-sky-500 appearance-none text-sm"
                        required placeholder="MIPA" value="{{ old('kuota.MIPA') }}">

                    <input type="number" name="kuota[Ekonomi]" id="kuota_fakultas_2"
                        class="w-full px-3 py-2 border-1 border-gray-300 rounded-md focus:ring-1 focus:ring-sky-500 appearance-none text-sm ml-4"
                        required placeholder="Ekonomi" value="{{ old('kuota.Ekonomi') }}">
                </div>
            </div>


            <div class="mb-4">
                <label class="mb-1 ml-1 block text-sm font-medium text-gray-600">Persyaratan</label>
                <table class="w-full border-collapse border border-gray-400">
                    <thead>
                        <tr>
                            <th class="border border-gray-400 p-3   ">Nama Persyaratan</th>
                            <th class="border border-gray-400 p-3">Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($file as $requirement)
                            <tr>
                                <td class="border border-gray-400 p-3">
                                    <div class="overflow-hidden max-w-full">
                                        <span class="break-all">{{ $requirement->name }}</span>
                                    </div>
                                </td>
                                <td class="border border-gray-400 p-3 flex justify-center items-center">
                                    <input class="form-checkbox" type="checkbox" name="requirements[]"
                                        value="{{ $requirement->id }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>


        <!-- Tombol Simpan -->
        <div class="text-start">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded" name="simpan"
                type="submit">SIMPAN</button>
        </div>
        </form>
    </div>
@endsection
