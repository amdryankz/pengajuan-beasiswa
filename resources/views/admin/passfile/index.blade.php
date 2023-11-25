@extends('admin.dashboard')

@section('navbar', 'Kelulusan')

@section('content')
    <div class="mb-4 text-start text-lg">
        <a href="{{ route('passfile.list') }}"
            class="inline-flex items-start px-2 py-1 text-blue-600 hover:bg-blue-100 rounded-lg">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
    </div>
    <h2 class="text-lg font-semibold mb-4">List Kelulusan Berkas Beasiswa - {{ $scholarship->name }}</h2>
    <div class="d-flex">
        <a href="{{ route('passfile.downloadExcel', ['scholarship_id' => $scholarship->id]) }}">Export</a>
    </div>
    <div class="table-responsive">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="min-w-full bg-white border border-gray-300 text-sm">
            <thead>
                <tr class="border-b-2 bg-sky-800 text-white text-start">
                    <th class="py-0.5 px-0.5 border-r text-center">No</th>
                    <th class="py-2 px-2 border-r">Nama</th>
                    <th class="py-2 px-2 border-r">NIM</th>
                    <th class="py-2 px-2 border-r">Prodi</th>
                    <th class="py-2 px-2 border-r">Detail</th>
                    <th class="py-1 px-1 border-r">Status</th>
                    <th class="py-1 px-1">Cetak</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr class="text-start">
                        <td class="py-0.5 px-0.5 border-r text-center">{{ $loop->index + 1 }}</td>
                        <td class="py-2 px-2 border-r">{{ $item['user']->name }}</td>
                        <td class="py-2 px-2 border-r">{{ $item['user']->nim }}</td>
                        <td class="py-2 px-2 border-r">{{ $item['user']->prodi }}</td>
                        <td class="py-1 px-1 border-r text-center">
                            <a href="{{ route('passfile.detail', ['user_id' => $item['user']->id, 'scholarship_id' => $item['scholarship']->id]) }}"
                                class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-700">Detail</a>
                        </td>
                        <td class="py-1 px-1 border-r text-center">
                            @if ($item['user']->scholarships->contains($item['scholarship']->id))
                                @php
                                    $statusScholar = $item['user']->scholarships->where('id', $item['scholarship']->id)->first()->pivot->status_scholar;
                                @endphp

                                @if ($statusScholar === null)
                                    Belum Diverifikasi
                                @elseif ($statusScholar == true)
                                    <span class="px-1 py-1 rounded text-green-500 bg-green-100">Lulus</span>
                                @else
                                    <span class="px-1 py-1 rounded text-red-500 bg-red-100">Tidak Lulus</span>
                                @endif
                            @else
                                Tidak Mendaftar
                            @endif
                        </td>
                        <td class="py-1 px-1 text-center">
                            <a href="{{ route('admin.scholarship.pdf', ['user_id' => $item['user']->id, 'scholarship_id' => $item['scholarship']->id]) }}"
                                target="_blank">
                                <span class="flex items-center justify-center">
                                    <i class="bi bi-file-pdf-fill mr-1"></i>
                                    <span>Cetak PDF</span>
                                </span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
