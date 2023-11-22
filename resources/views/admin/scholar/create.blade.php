@extends('admin.dashboard')

@section('navbar', 'Beasiswa')

@section('content')

    <div class="mb-4 text-start text-lg">
        <a href="{{ route('beasiswa.index') }}"
            class="inline-flex items-start px-2 py-1 text-blue-600 hover:bg-blue-100 rounded-lg">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
        </a>
    </div>
    <form action="{{ route('beasiswa.store') }}" method="POST" class="grid grid-cols-2 gap-4">
        @csrf


        {{-- kiri --}}
        <div class="col-span-1">

            <div class="mb-4">
                <label for="name" class="mb-1 ml-1 block text-sm font-medium text-gray-600">Nama Beasiswa</label>
                <input type="text"
                    class="w-full px-3 py-2 placeholder-gray-400 border-solid border-1 border-neutral-200 rounded-md focus:border-sky-500 text-sm"
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
                <label for="status_scholarship" class="mb-1 ml-1 block text-sm font-medium text-gray-600">
                    Status Beasiswa
                </label>
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



        </div>

        {{-- kanan --}}

        <div class="col-span-1">

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

            <div class="mb-4">
                <label for="start_regis_at" class="block text-sm font-medium text-gray-600 mb-1">
                    Mulai Pendaftaran Beasiswa
                </label>
                <input type="date" id="start_regis_at" name="start_regis_at"
                    class="block w-full px-3 py-2 border-1 border-gray-300 rounded-md focus:ring-1 outline-none focus:ring-sky-500 text-sm"
                    value="{{ old('start_regis_at') }}">
            </div>

            <div class="mb-4">
                <label for="end_regis_at" class="block text-sm font-medium text-gray-600 mb-1">
                    Akhir Pendaftaran Beasiswa
                </label>
                <input type="date" id="end_regis_at" name="end_regis_at"
                    class="block w-full px-3 py-2 border-1 border-gray-300 rounded-md focus:ring-1 focus:ring-sky-500 text-sm"
                    value="{{ old('end_regis_at') }}">
            </div>

            <div class="mb-4">
                <label for="min_ipk" class="block text-sm font-medium text-gray-600 mb-1">
                    Minimal IPK
                </label>
                <input type="text" id="min_ipk" name="min_ipk" placeholder="IPK"
                    class="block w-full px-3 py-2 border-1 border-gray-300 rounded-md focus:ring-1 focus:ring-sky-500 text-sm"
                    value="{{ old('min_ipk') }}">
            </div>

            <div class="mb-4">
                <label for="start_graduation_at" class="mb-1 ml-1 block text-sm font-medium text-gray-600">
                    Mulai Penentuan Kelulusan
                </label>
                <input type="date" id="start_graduation_at" name="start_graduation_at"
                    class="block w-full px-3 py-2 border-1 border-gray-300 rounded-md focus:ring-1 focus:ring-sky-500 text-sm"
                    value="{{ old('start_graduation_at') }}">
            </div>

            <div class="mb-4">
                <label for="end_graduation_at" class="mb-1 ml-1 block text-sm font-medium text-gray-600">
                    Akhir Penentuan Kelulusan
                </label>
                <input type="date" id="end_graduation_at" name="end_graduation_at"
                    class="block w-full px-3 py-2 border-1 border-gray-300 rounded-md focus:ring-1 focus:ring-sky-500 text-sm"
                    value="{{ old('end_graduation_at') }}">
            </div>
        </div>


        {{-- Kuota fakultas --}}
        <div class="mb-4 col-span-2">
            <label class="block text-base font-semibold text-gray-600 mb-2 ml-1">Kuota Fakultas</label>
            <p class="text-sm text-red-400 mb-2 ml-1">
                <span class="text-red-500">*</span> Isi dengan jumlah kuota yang tersedia untuk setiap fakultas.
            </p>
            <hr class="mb-4 border-t border-gray-300 my-2">
            <div class="grid grid-cols-4 gap-4">
                @php
                    $fakultasList = ['MIPA', 'Ekonomi', 'Kedokteran', 'Hukum', 'Teknik', 'Pertanian', 'Kedokteran Hewan', 'Keguruan dan Ilmu Pendidikan', 'Keperawatan', 'Kedokteran Gigi', 'Kelautan dan Perikanan', 'Ilmu Sosial dan Politik', 'Pascasarjana'];
                @endphp

                @foreach ($fakultasList as $fakultas)
                    <div class="m-2">
                        <label for="kuota_fakultas_{{ $loop->index + 1 }}"
                            class="mb-1 ml-1 block text-sm font-medium text-gray-600">{{ $fakultas }}</label>
                        <input type="number" name="kuota[{{ $fakultas }}]"
                            id="kuota_fakultas_{{ $loop->index + 1 }}"
                            class="px-3 py-2 border-1 border-sky-500 rounded-md focus:ring-2 focus:ring-sky-700 appearance-none text-sm"
                            required placeholder="{{ $fakultas }}" value="{{ old('kuota.' . $fakultas) }}">
                    </div>
                @endforeach
            </div>
        </div>





        {{-- Persyaratan --}}
<div class="mb-4 col-span-2">
    <label class="block text-base font-semibold text-gray-600 mb-2 ml-1">Persyaratan</label>
    <hr class="mb-4 border-t-0 border-gray-300 my-2">
    <table class="w-full border-collapse border border-white">
        <thead>
            <tr class="bg-sky-800 text-slate-50">
                <th class="border border-white p-3">Nama Persyaratan</th>
                <th class="border border-white p-3 text-center">Pilih</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($file as $index => $requirement)
                <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-zinc-50' }}">
                    <td class="border border-slate-100 p-3">
                        <div class="overflow-hidden max-w-full">
                            <span class="break-all">{{ $requirement->name }}</span>
                        </div>
                    </td>
                    <td class="border border-slate-100 p-3 text-center">
                        <input class="form-checkbox m-0" type="checkbox" name="requirements[]"
                            value="{{ $requirement->id }}">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>



        {{-- Save Button --}}
        <div class="mb-4 text-start col-span-2">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded" name="simpan"
                type="submit">SIMPAN</button>
        </div>
    </form>
@endsection
