@extends('admin.dashboard')

@section('navbar', 'Pengusul')

@section('content')
    <div class="mb-4 text-start text-lg">
        <a href="{{ route('registrations.list') }}"
            class="inline-flex items-start px-2 py-1 text-blue-600 hover:bg-blue-100 rounded-lg">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
    </div>

    <h2 class="text-lg font-semibold mb-4">List Pendaftar Beasiswa {{ $data['scholarship']->name }}</h2>
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
                @foreach ($data['user'] as $item)
                    <tr class="text-start">
                        <td class="py-0.5 px-0.5 border-r text-center">{{ $loop->index + 1 }}</td>
                        <td class="py-2 px-2 border-r">{{ $item->name }}</td>
                        <td class="py-2 px-2 border-r">{{ $item->nim }}</td>
                        <td class="py-2 px-2 border-r">{{ $item->prodi }}</td>
                        <td class="py-1 px-1 border-r text-center">
                            <a href="{{ route('admin.scholarship.detail', ['user_id' => $item->id, 'scholarship_id' => $data['scholarship']->id]) }}"
                                class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-700">
                                Detail</a>
                        </td>
                        <td class="py-1 px-1 border-r text-center">
                            @if ($item->scholarships->contains($data['scholarship']->id))
                                @php
                                    $statusFile = $item->scholarships->where('id', $data['scholarship']->id)->first()->pivot->status_file;
                                @endphp

                                @if ($statusFile === null)
                                    Belum Diverifikasi
                                @elseif ($statusFile == true)
                                    <span class="px-1 py-1 rounded text-green-500 bg-green-100">Lengkap</span>
                                @else
                                    <span class="px-1 py-1 rounded text-red-500 bg-red-100">Tidak Lengkap</span>
                                @endif
                            @else
                                Tidak Mendaftar
                            @endif
                        </td>

                        <td class="py-1 px-1 text-center">
                            <a href="{{ route('admin.scholarship.pdf', ['user_id' => $item->id, 'scholarship_id' => $data['scholarship']->id]) }}"
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
