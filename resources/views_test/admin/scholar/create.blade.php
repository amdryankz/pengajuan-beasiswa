@extends('admin.dashboard')

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
    <form action="{{ route('beasiswa.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Nama Beasiswa</label>
            <input type="text"
                class="w-full px-3 py-2 placeholder-gray-400 border rounded-md focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm"
                name="name" id="name" placeholder="Nama Beasiswa" value="{{ Session::get('name') }}">
        </div>

        <div class="mb-4">
            <label for="year" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Tahun</label>
            <select class="form-select" name="year" id="year">
                <option>-- Pilih --</option>
                @foreach ($tahunArray as $tahun)
                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="status_scholarship" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Status Beasiswa</label>
            <select class="form-select" name="status_scholarship" id="status_scholarship">
                <option>-- Pilih --</option>
                <option>Umum</option>
                <option>Khusus</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="donors_id" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Pilih Donatur</label>
            <select class="form-select" name="donors_id" id="donors_id">
                <option>-- Pilih --</option>
                @foreach ($data as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="value" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Nominal</label>
            <input type="text" class="form-input border" name="value" id="value" placeholder="Nominal"
                value="{{ Session::get('value') }}">
        </div>
        <div class="mb-4">
            <label for="status_value" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Per</label>
            <select class="form-select" name="status_value" id="status_value">
                <option>-- Pilih --</option>
                <option>Bulan</option>
                <option>Tahun</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="duration" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Durasi</label>
            <select class="form-select" name="duration" id="duration">
                <option>-- Pilih --</option>
                @for ($i = 1; $i <= 48; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="mb-4">
            <label for="start_regis_at" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Mulai Pendaftaran Beasiswa</label>
            <input type="date" id="start_regis_at" name="start_regis_at" class="form-input">
        </div>
        <div class="mb-4">
            <label for="end_regis_at" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Akhir Pendaftaran Beasiswa</label>
            <input type="date" id="end_regis_at" name="end_regis_at" class="form-input">
        </div>
        <div class="mb-4">
            <label for="min_ipk" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Minimal IPK</label>
            <input type="text" class="form-input border" name="min_ipk" id="min_ipk" placeholder="IPK"
                value="{{ Session::get('min_ipk') }}">
        </div>
        <div class="mb-4">
            <label for="start_graduation_at" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Mulai Penentuan
                Kelulusan</label>
            <input type="date" id="start_graduation_at" name="start_graduation_at" class="form-input">
        </div>
        <div class="mb-4">
            <label for="end_graduation_at" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Akhir Penentuan Kelulusan</label>
            <input type="date" id="end_graduation_at" name="end_graduation_at" class="form-input">
        </div>
        <div class="mb-4">
            <label class="mb-1  ml-1 block text-sm font-medium text-gray-600">Kuota Fakultas</label>
            <input type="number" name="kuota[MIPA]" id="kuota_fakultas_1" class="form-input border" required>
            <input type="number" name="kuota[Ekonomi]" id="kuota_fakultas_2" class="form-input border" required>
        </div>
        <div class="mb-4">
            <label class="mb-1  ml-1 block text-sm font-medium text-gray-600">Persyaratan</label>
            @foreach ($file as $requirement)
                <div class="flex items-center">
                    <input class="form-checkbox" type="checkbox" name="requirements[]" value="{{ $requirement->id }}">
                    <span class="ml-2">{{ $requirement->name }}</span>
                </div>
            @endforeach
        </div>

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded" name="simpan"
            type="submit">SIMPAN</button>
    </form>
@endsection
