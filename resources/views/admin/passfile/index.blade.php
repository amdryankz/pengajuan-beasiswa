@extends('admin.dashboard')

@section('navbar', 'Kelulusan')

@section('content')
    <div class="mb-8 text-start text-sm bg-white p-4">
        <a href="{{ route('passfile.list') }}"
            class="inline-flex items-start px-2 py-1 mb-2 text-blue-600 hover:bg-blue-100 rounded-lg">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>

        <div class="container mx-auto table-responsive border-gray-300 pb-4">
            <h2 class="text-lg font-semibold mb-4">List Nama Mahasiswa yang Lulus Berkas -
                {{ $scholarship->scholarship->name }}</h2>

            <div class="mb-10">
                <a href="{{ route('passfile.downloadExcel', ['scholarship_id' => $scholarship->id]) }}"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    Export to Excel <ion-icon name="logo-buffer"></ion-icon>
                </a>
            </div>

            <div class="flex items-center mb-2 md:w-1/2">
                <div class="w-3/4 pr-2">
                    <label for="facultyFilter" class="block text-sm font-medium text-gray-700">Pilih Fakultas:</label>
                    <select id="facultyFilter" name="facultyFilter"
                        class="block w-full p-2 border-1 border-solid border-neutral-200 rounded-md focus:border-sky-500">
                        <option value="">Semua Fakultas</option>
                        @foreach ($facultyList as $faculty)
                            <option value="{{ $faculty }}">{{ $faculty }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table id="myTable" class="min-w-full bg-white border border-gray-300 text-sm">
                <thead>
                    <tr class="border-b-2 bg-sky-800 text-white text-sm">
                        <th class="py-1 px-1 border-r text-center">No</th>
                        <th class="py-1 px-4 border-r">Nama</th>
                        <th class="py-1 px-4 border-r">NPM</th>
                        <th class="py-1 px-4 border-r">Fakultas</th>
                        <th class="py-1 px-4 border-r">Prodi</th>
                        <th class="py-2 px-4 border-r text-center">Detail</th>
                        <th class="py-1 px-4 border-r">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($data as $item)
                        <tr class="text-sm text-start font-normal">
                            <td class="py-1 px-1 border-r text-center">{{ $loop->index + 1 }}</td>
                            <td class="py-1 px-4 border-r">{{ $item['user']->name }}</td>
                            <td class="py-1 px-4 border-r">{{ $item['user']->npm }}</td>
                            <td class="py-1 px-4 border-r font-normal">{{ $item['user']->faculty }}</td>
                            <td class="py-1 px-4 border-r font-normal">{{ $item['user']->major }}</td>
                            <td class="py-2 px-4 border-r text-center">
                                <a href="{{ route('passfile.detail', ['user_id' => $item['user']->id, 'scholarship_id' => $item['scholarship']->id]) }}"
                                    class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-700 font-normal">Detail</a>
                            </td>
                            <td class="py-1 px-1 border-r text-center">
                                @if ($item['user']->scholarships->contains($item['scholarship']->id))
                                    @php
                                        $statusScholar = $item['user']->scholarships
                                            ->where('id', $item['scholarship']->id)
                                            ->first()->pivot->scholarship_status;
                                    @endphp

                                    @if ($statusScholar === null)
                                        Belum Diverifikasi
                                    @elseif ($statusScholar == true)
                                        <span class="px-1 py-1 rounded text-green-500 bg-green-200 font-normal">Lulus</span>
                                    @else
                                        <span class="px-1 py-1 rounded text-red-500 bg-red-200 font-normal">Tidak
                                            Lulus</span>
                                    @endif
                                @else
                                    Tidak Mendaftar
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
