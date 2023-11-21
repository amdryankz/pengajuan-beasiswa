@extends('admin.dashboard')

@section('navbar', 'Pengusul')

@section('content')
    <h2 class="text-lg font-semibold mb-4">List Pendaftar Beasiswa</h2>
    <div class="table-responsive">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <table class="min-w-full bg-white border border-gray-300 text-sm">
            <thead>
                <tr class="border-b-2 bg-sky-800 text-white text-start">
                    <th class="py-2 px-2 border-r">No</th>
                    <th class="py-2 px-2 border-r">Nama</th>
                    <th class="py-2 px-2 border-r">NIM</th>
                    <th class="py-2 px-2 border-r">Prodi</th>
                    <th class="py-2 px-2 border-r">Nama Beasiswa</th>
                    <th class="py-2 px-2 border-r">Detail</th>
                    <th class="py-2 px-2 border-r">Status</th>
                    <th class="py-2 px-2">infromasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr class="text-start">
                        <td class="py-2 px-2 border-r">{{ $loop->index + 1 }}</td>
                        <td class="py-2 px-2 border-r">{{ $item['user']->name }}</td>
                        <td class="py-2 px-2 border-r">{{ $item['user']->nim }}</td>
                        <td class="py-2 px-2 border-r">{{ $item['user']->prodi }}</td>
                        <td class="py-2 px-2 border-r">{{ $item['scholarship']->name }}</td>
                        <td class="py-2 px-2 border-r">
                            <a href="{{ route('admin.scholarship.detail', ['user_id' => $item['user']->id, 'scholarship_id' => $item['scholarship']->id]) }}"
                                class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-700">Detail</a>
                        </td>
                        <td class="py-2 px-2 border-r">
                            @if ($item['user']->scholarships->contains($item['scholarship']->id))
                                @php
                                    $statusFile = $item['user']->scholarships->where('id', $item['scholarship']->id)->first()->pivot->status_file;
                                @endphp

                                @if ($statusFile === null)
                                    Belum Diverifikasi
                                @elseif ($statusFile == true)
                                    Lengkap
                                @else
                                    Tidak Lengkap
                                @endif
                            @else
                                Tidak Mendaftar
                            @endif
                        </td>
                        <td class="py-2 px-2"><a
                                href="{{ route('admin.scholarship.pdf', ['user_id' => $item['user']->id, 'scholarship_id' => $item['scholarship']->id]) }}"
                                target="_blank">download</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
