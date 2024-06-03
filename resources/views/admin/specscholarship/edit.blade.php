@extends('admin.dashboard')

@section('navbar', 'Edit Beasiswa Khusus')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <a href="{{ route('pengelolaan-khusus.index') }}"
            class="inline-flex items-start px-2 py-1 mb-4 text-blue-600 hover:bg-blue-100 rounded-lg">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-3xl font-semibold mb-6">Edit Beasiswa Khusus</h1>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <form action="{{ route('pengelolaan-khusus.update', $scholarship->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Donatur</label>
                        <input type="text" name="name" id="name" value="{{ $scholarship->name }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2">
                    </div>
                    <div class="mb-4">
                        <label for="year" class="block text-sm font-medium text-gray-700">Tahun</label>
                        <input type="text" name="year" id="year" value="{{ $scholarship->year }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2">
                    </div>
                    <div class="mb-4">
                        <label for="amount" class="block text-sm font-medium text-gray-700">Nominal</label>
                        <input type="text" name="amount" id="amount" value="{{ $scholarship->amount }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2">
                    </div>
                    <div class="mb-4">
                        <label for="duration" class="block text-sm font-medium text-gray-700">Durasi</label>
                        <input type="text" name="duration" id="duration" value="{{ $scholarship->duration }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2">
                    </div>
                </form>
            </div>
            <div>
                <form action="{{ route('pengelolaan-khusus.update', $scholarship->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="amount_period" class="block text-sm font-medium text-gray-700">Per</label>
                        <select name="amount_period" id="amount_period"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="Bulan" {{ $scholarship->amount_period == 'Bulan' ? 'selected' : '' }}>Bulan
                            </option>
                            <option value="Tahun" {{ $scholarship->amount_period == 'Tahun' ? 'selected' : '' }}>Tahun
                            </option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="start_scholarship" class="block text-sm font-medium text-gray-700">Mulai
                            Beasiswa</label>
                        <input type="date" name="start_scholarship" id="start_scholarship"
                            value="{{ $scholarship->start_scholarship }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2">
                    </div>
                    <div class="mb-4">
                        <label for="end_scholarship" class="block text-sm font-medium text-gray-700">Akhir Beasiswa</label>
                        <input type="date" name="end_scholarship" id="end_scholarship"
                            value="{{ $scholarship->end_scholarship }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2">
                    </div>
                    <div class="mb-4">
                        <label for="student_list_file" class="block text-sm font-medium text-gray-700">Upload Daftar
                            Mahasiswa</label>
                        <input type="file" name="student_list_file" id="student_list_file" accept=".xlsx, .xls"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
