@extends('admin.dashboard')

@section('navbar', 'Upload Khusus')

@section('content')
    <div class="pb-3"><a href="{{ route('khusus.index') }}" class="btn btn-secondary">
            << Kembali</a>
    </div>
    <form action="{{ route('khusus.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-4">
        @csrf
        <div class="col-span-1">
            <div class="mb-4">
                <label for="name" class="mb-1 ml-1 block text-sm font-medium text-gray-600">Nama Beasiswa</label>
                <input type="text"
                    class="w-full px-3 py-2 placeholder-gray-400 border-solid border-1 border-neutral-200 rounded-md focus:border-sky-500 text-sm"
                    name="name" id="name" placeholder="Nama Beasiswa" required>
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
                <label for="list_student_file" class="mb-1 ml-1 block text-sm font-medium text-gray-600">Upload daftar
                    mahasiswa</label>
                <input type="file" name="list_student_file" id="list_student_file">
            </div>
        </div>
        <div class="col-span-1">
            <div class="mb-4">
                <label for="value" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Nominal</label>
                <input type="text"
                    class="w-full px-3 py-2 placeholder-gray-400 border-solid border-1 border-neutral-200 rounded-md  focus:border-sky-500 text-sm"
                    name="value" id="value" placeholder="Nominal">
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
                <label for="start_scholarship" class="block text-sm font-medium text-gray-600 mb-1">
                    Mulai Beasiswa
                </label>
                <input type="date" id="start_scholarship" name="start_scholarship"
                    class="block w-full px-3 py-2 border-1 border-gray-300 rounded-md focus:ring-1 outline-none focus:ring-sky-500 text-sm">
            </div>
            <div class="mb-4">
                <label for="end_scholarship" class="block text-sm font-medium text-gray-600 mb-1">
                    Akhir Beasiswa
                </label>
                <input type="date" id="end_scholarship" name="end_scholarship"
                    class="block w-full px-3 py-2 border-1 border-gray-300 rounded-md focus:ring-1 focus:ring-sky-500 text-sm">
            </div>
            <div class="mb-4 text-start col-span-2">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded" name="simpan"
                    type="submit">SIMPAN</button>
            </div>
        </div>
    </form>
@endsection