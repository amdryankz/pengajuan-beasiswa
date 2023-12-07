@extends('admin.dashboard')

@section('navbar', 'Upload Khusus')

@section('content')
    <div class="mb-4 text-start bg-white p-4">
        <a href="{{ route('beasiswa-khusus.index') }}"
            class="inline-flex items-start px-2 py-1 mb-4 text-blue-600 hover:bg-blue-100 rounded-lg">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>

        <form action="{{ route('beasiswa-khusus.store') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-2 gap-4">
            @csrf
            <div class="col-span-1">
                <div class="mb-4">
                    <label for="scholarships_id" class="mb-1 ml-1 block text-sm font-medium text-gray-600">Pilih
                        Beasiswa</label>
                    <select
                        class="form-select w-full px-3 py-2 border-1 border-solid border-neutral-200 rounded-md focus:border-sky-500 outline-none text-sm"
                        name="scholarships_id" id="scholarships_id">
                        <option value="" disabled selected class="text-gray-600 hidden">Nama Beasiswa</option>
                        @foreach ($data as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="donors_id" class="mb-1 ml-1 block text-sm font-medium text-gray-600">Nama
                        Donatur</label>
                    <select
                        class="form-select w-full px-3 py-2 border-1 border-solid border-neutral-200 rounded-md focus:border-sky-500 outline-none text-sm"
                        name="donors_id" id="donors_id" disabled>
                        <option value="" class="text-gray-600 hidden">Donatur</option>
                    </select>
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
                    <label for="duration" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Durasi</label>
                    <select
                        class="form-select w-full px-3 py-2 border-1 border-solid border-neutral-200 rounded-md focus:border-sky-500 outline-none text-sm"
                        name="duration" id="duration">
                        <option value="" disabled selected class="text-gray-600 hidden">Durasi Beasiswa
                        </option>
                        @for ($i = 1; $i <= 48; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-6 relative">
                    <label for="list_student_file" class="block text-sm font-medium text-gray-600 mb-1 ml-1">Upload Daftar
                        Mahasiswa</label>
                    <div class="flex items-center">
                        <input type="file" name="list_student_file" id="list_student_file" accept=".xlsx, .xls"
                            class="mt-1 p-2 border rounded-md w-full bg-white cursor-pointer pr-10">
                    </div>
                </div>

            </div>
            <div class="col-span-1">
                <div class="mb-4 flex">
                    <div class="mr-2">
                        <label for="value" class="mb-1 block text-sm font-medium text-gray-600">Nominal</label>
                        <div class="flex items-center">
                            <input type="text"
                                class="block w-full px-3 py-2 border-1 border-gray-300 rounded-md focus:ring-1 focus:ring-sky-500 text-sm"
                                name="value" id="value" placeholder="Nominal">
                            <select
                                class="form-select px-3 py-2 ml-2 border-1 border-solid border-neutral-200 rounded-md focus:border-sky-500 outline-none text-sm"
                                name="status_value" id="status_value">
                                <option value="" disabled selected class="text-gray-600 hidden">Per</option>
                                <option value="Bulan">Bulan</option>
                                <option value="Tahun">Tahun</option>
                            </select>
                        </div>
                    </div>
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

            </div>
            <div class="mb-4 text-start col-span-2">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded" name="simpan"
                    type="submit">SIMPAN</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('scholarships_id').addEventListener('change', function() {
            var scholarshipId = this.value;
            var donorSelect = document.getElementById('donors_id');
            donorSelect.innerHTML = '';
            @foreach ($data as $item)
                if ({{ $item->id }} == scholarshipId) {
                    var option = document.createElement('option');
                    option.value = '{{ $item->donors->id }}';
                    option.text = '{{ $item->donors->name }}';
                    donorSelect.add(option);
                }
            @endforeach
        });
    </script>
@endsection
