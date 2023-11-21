@extends('admin.dashboard')

@section('navbar', 'Beasiswa')

@section('content')
    <h2 class="text-xl font-semibold mb-2">Beasiswa</h2>

    <div class="mb-4">
        <a href="{{ route('beasiswa.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block">
            + Tambah Beasiswa
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto min-w-full border-2 border-collapse">
            <thead>
                <tr class="border-b-2 bg-sky-800 text-white text-xs">
                    <th class="px-2 py-1 text-center border-r">No</th>
                    <th class="px-2 py-1 text-center border-r">Nama Beasiswa</th>
                    <th class="px-2 py-1 text-center border-r">Tahun</th>
                    <th class="px-2 py-1 text-center border-r">Nama Donatur</th>
                    <th class="px-2 py-1 text-center border-r">Nominal (Rp)</th>
                    <th class="px-3 py-1 text-center border-r">Durasi</th>
                    <th class="px-2 py-1 text-center border-r">Mulai Pendaftaran</th>
                    <th class="px-2 py-1 text-center border-r">Akhir Pendaftaran</th>
                    <th class="px-2 py-1 text-center border-r">Mulai Kelulusan</th>
                    <th class="px-2 py-1 text-center border-r">Akhir Kelulusan</th>
                    <th class="px-2 py-1 text-center border-r">IPK</th>
                    <th class="px-2 py-1 text-center border-r">Detail</th>
                    <th class="px-2 py-1 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    @php $rowColor = $loop->iteration % 2 == 0 ? 'bg-gray-100' : 'bg-white'; @endphp
                    <tr class="border-b-2 text-xs {{ $rowColor }}">
                        <td class="px-1 py-1 text-center border-r">{{ $loop->iteration }}</td>
                        <td class="px-2 py-1 text-center border-r">{{ $item->name }}</td>
                        <td class="px-2 py-1 text-center border-r">{{ $item->year }}</td>
                        <td class="px-2 py-1 text-center border-r">{{ $item->donor->name }}</td>
                        <td class="px-2 py-1 text-center border-r">Rp.{{ $item->value }}/{{ $item->status_value }}</td>
                        <td class="text-center border-r">{{ $item->duration }} Bulan</td>
                        <td class="px-2 py-1 text-center border-r">{{ $item->start_regis_at->format('d-m-Y') }}</td>
                        <td class="px-2 py-1 text-center border-r">{{ $item->end_regis_at->format('d-m-Y') }}</td>
                        <td class="px-2 py-1 text-center border-r">{{ $item->start_graduation_at->format('d-m-Y') }}</td>
                        <td class="px-2 py-1 text-center border-r">{{ $item->end_graduation_at->format('d-m-Y') }}</td>
                        <td class="px-2 py-1 text-center border-r">{{ number_format($item->min_ipk, 2, '.', '') }}</td>
                        <td class="px-2 py-1 text-center border-r">
                            <a href="{{ route('beasiswa.show', $item->id) }}"
                                class="flex bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-xs items-center">
                                <ion-icon name="information-circle-outline" class="mr-1"></ion-icon> Detail
                            </a>
                        </td>
                        <td class="px-2 py-1 text-sm text-center">
                            <div class="flex">
                                <a href="{{ route('beasiswa.edit', $item->id) }}"
                                    class="flex bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded text-xs items-center mr-1">
                                    <ion-icon name="pencil-sharp" class="mr-1"></ion-icon>
                                </a>
                                <form onsubmit="return confirm('Yakin mau hapus data ini?')"
                                    action="{{ route('beasiswa.destroy', $item->id) }}" class="inline-block"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="flex bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs items-center">
                                        <ion-icon name="trash-sharp" class="mr-1"></ion-icon>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
