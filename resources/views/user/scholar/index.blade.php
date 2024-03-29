@extends('user.dashboard')

@section('content')
    {{-- Bagian 1: List Pendaftaran Beasiswa --}}
    <div class="mt-4">
        <p class="card-title">List Pendaftaran Beasiswa</p>
        <div class="overflow-x-auto border rounded-lg mt-4">
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
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">No</th>
                        <th class="border border-gray-300 px-4 py-2">Nama Beasiswa</th>
                        <th class="border border-gray-300 px-4 py-2">Tahun</th>
                        <th class="border border-gray-300 px-4 py-2">Mulai Pendaftaran Beasiswa</th>
                        <th class="border border-gray-300 px-4 py-2">Akhir Pendaftaran Beasiswa</th>
                        <th class="border border-gray-300 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($data as $item)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $i++ }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->scholarship->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->year }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->start_regis_at->format('d-m-Y') }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->end_regis_at->format('d-m-Y') }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('beasiswa.show', $item->id) }}"
                                    class="bg-yellow-500 text-white px-2 py-1 rounded">Daftar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Bagian 2: History Pendaftaran Beasiswa --}}
    <div class="mt-8">
        <p class="card-title">History Pendaftaran Beasiswa</p>
        <div class="overflow-x-auto border rounded-lg mt-4">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">No</th>
                        <th class="border border-gray-300 px-4 py-2">Nama Beasiswa</th>
                        <th class="border border-gray-300 px-4 py-2">Tahun</th>
                        <th class="border border-gray-300 px-4 py-2">Status Berkas</th>
                        <th class="border border-gray-300 px-4 py-2">Alasan Penolakan Berkas</th>
                        <th class="border border-gray-300 px-4 py-2">Status Beasiswa</th>
                        <th class="border border-gray-300 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($dataUser as $item)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $i++ }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->scholarshipData->scholarship->name }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->scholarshipData->year }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @if ($item->status_file === null)
                                    Diproses
                                @elseif ($item->status_file == false)
                                    Ditolak
                                @elseif ($item->status_file == true)
                                    Lulus Berkas
                                @endif
                            </td>
                            
                            <td class="border border-gray-300 px-4 py-2">
                                @if ($item->status_file == false)
                                    {{ $item->reason_for_rejection }}
                                @else
                                    -
                                @endif
                            </td>

                            <td class="border border-gray-300 px-4 py-2">
                                @if ($item->status_scholar === null && $item->status_file == true)
                                    Diproses
                                @elseif ($item->status_scholar === null)
                                    -
                                @elseif ($item->status_scholar == false)
                                    Tidak Lewat
                                @elseif ($item->status_scholar == true)
                                    Lulus
                                @endif
                            </td>

                            <td class="border border-gray-300 px-4 py-2">
                                @if ($item->status_scholar != true)
                                    {{-- Tampilkan tombol hanya jika status_scholar tidak true --}}
                                    <form onsubmit="return confirm('Yakin mau hapus data ini?')"
                                        action="{{ route('beasiswa.destroy', $item->id) }}" class="inline-block"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 text-white px-2 py-1 rounded" type="submit"
                                            name="submit">
                                            Batal Daftar
                                        </button>
                                    </form>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Bagian 3: History Penerimaan Beasiswa --}}
    <div class="mt-8">
        <p class="card-title">History Penerimaan Beasiswa</p>
        <div class="overflow-x-auto border rounded-lg mt-4">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">No</th>
                        <th class="border border-gray-300 px-4 py-2">Nama Beasiswa</th>
                        <th class="border border-gray-300 px-4 py-2">Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($alumniData as $item)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $i++ }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->scholarship->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->year }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
