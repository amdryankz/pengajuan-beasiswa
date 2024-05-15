@extends('user.dashboard')

@section('content')
    {{-- Bagian 1: List Pendaftaran Beasiswa --}}
    <div class="mb-2">
        <p class=" font-semibold text-base px-2 py-1 {{-- border-b-2 --}}">LIST PENDAFTARAN BEASISWA</p>
        <div class="overflow-x-auto">
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
            <table class="mt-3 min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-blue-500 text-white">
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
                            <td class="border border-gray-300 px-4 py-2">{{ $item->start_registration_at->format('d-m-Y') }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->end_registration_at->format('d-m-Y') }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('pendaftaran.show', $item->id) }}"
                                    class="bg-green-500 text-white px-2 py-1 rounded">Daftar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Bagian 2: History Pendaftaran Beasiswa --}}
    <div class="pt-4">
        <p class=" font-semibold text-base px-2 py-1 {{-- border-b-2 --}}">HISTORY PENDAFTARAN BEASISWA</p>
        <div class="overflow-x-auto">
            <table class="mt-3 min-w-full bg-white border-gray-300">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="border-2 border-slate-200 px-4 py-2">No</th>
                        <th class="border-2 border-slate-200 px-4 py-2">Nama Beasiswa</th>
                        <th class="border-2 border-slate-200 px-4 py-2">Tahun</th>
                        <th class="border-2 border-slate-200 px-4 py-2">Status Berkas</th>
                        <th class="border-2 border-slate-200 px-4 py-2">Alasan Penolakan Berkas</th>
                        <th class="border-2 border-slate-200 px-4 py-2">Status Beasiswa</th>
                        <th class="border-2 border-slate-200 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($dataUser as $item)
                        <tr>
                            <td class="border-2 border-slate-200 px-4 py-2">{{ $i++ }}</td>
                            <td class="border-2 border-slate-200 px-4 py-2">{{ $item->scholarshipData->scholarship->name }}
                            </td>
                            <td class="border-2 border-slate-200 px-4 py-2">{{ $item->scholarshipData->year }}</td>
                            <td class="border-2 border-slate-200 px-4 py-2">
                                @if ($item->file_status === null)
                                    Diproses
                                @elseif ($item->file_status == false)
                                    Ditolak
                                @elseif ($item->file_status == true)
                                    Lulus Berkas
                                @endif
                            </td>

                            <td class="border-2 border-slate-200 px-4 py-2">
                                @if ($item->file_status == false)
                                    {{ $item->rejection_reason }}
                                @else
                                    -
                                @endif
                            </td>

                            <td class="border-2 border-slate-200 px-4 py-2">
                                @if ($item->scholarship_status === null && $item->file_status == true)
                                    Diproses
                                @elseif ($item->scholarship_status === null)
                                    -
                                @elseif ($item->scholarship_status == false)
                                    Tidak Lewat
                                @elseif ($item->scholarship_status == true)
                                    Lulus
                                @endif
                            </td>

                            <td class="border-2 border-slate-200 px-4 py-2">
                                @if ($item->scholarship_status != true)
                                    {{-- Tampilkan tombol hanya jika scholarship_status tidak true --}}
                                    <form onsubmit="return confirm('Yakin mau hapus data ini?')"
                                        action="{{ route('pendaftaran.destroy', $item->id) }}" class="inline-block"
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
    <div class="pt-4">
        <p class=" font-semibold text-base px-2 py-1 {{-- border-b-2 --}}">HISTORY PENERIMAAN BEASISWA</p>
        <div class="overflow-x-auto">
            <table class="mt-3 min-w-full bg-white border-gray-300">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-blue-500 text-white">
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
