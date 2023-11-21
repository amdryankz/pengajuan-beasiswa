@extends('admin.dashboard')

@section('navbar', 'Upload Khusus')

@section('content')
    <h2 class="text-xl font-semibold mb-2">Beasiswa Khusus</h2>

    <div class="mb-4">
        <a href="{{ route('khusus.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded">+
            Tambah Beasiswa Khusus
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-2 border-collapse">
            <thead>
                <tr class="border-b-2 bg-sky-800 text-white text-xs">
                    <th class="px-1 py-1 text-center border-r">No</th>
                    <th class="px-2 py-1 text-center border-r">Nama Beasiswa</th>
                    <th class="px-2 py-1 text-center border-r">Tahun</th>
                    <th class="px-2 py-1 text-center border-r">Nama Donatur</th>
                    <th class="px-2 py-1 text-center border-r">Nominal</th>
                    <th class="px-2 py-1 text-center border-r">Durasi</th>
                    <th class="px-2 py-1 text-center border-r">Mulai Pendaftaran</th>
                    <th class="px-2 py-1 text-center border-r">Akhir Pendaftaran</th>
                    <th class="px-2 py-1 text-center border-r">IPK</th>
                    <th class="px-2 py-1 text-center border-r">Mulai Penentuan</th>
                    <th class="px-2 py-1 text-center border-r">Akhir Penentuan</th>
                    <th class="px-2 py-1 text-center border-r">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php $displayedIds = []; ?>
                @foreach ($data as $item)
                    @if (!in_array($item->scholarship_data_id, $displayedIds))
                        <tr class="border-b-2 text-xs">
                            <td class="px-1 py-1">{{ $i++ }}</td>
                            <td class="px-2 py-1">{{ $item->scholarships->name }}</td>
                            <td class="px-2 py-1">{{ $item->scholarships->year }}</td>
                            <td class="px-2 py-1">{{ $item->scholarships->donor->name }}</td>
                            <td class="px-2 py-1">{{ $item->scholarships->value }}/{{ $item->scholarships->status_value }}</td>
                            <td class="px-2 py-1">{{ $item->scholarships->duration }}</td>
                            <td class="px-2 py-1">{{ $item->scholarships->start_regis_at }}</td>
                            <td class="px-2 py-1">{{ $item->scholarships->end_regis_at }}</td>
                            <td class="px-2 py-1">{{ $item->scholarships->min_ipk }}</td>
                            <td class="px-2 py-1">{{ $item->scholarships->start_graduation_at }}</td>
                            <td class="px-2 py-1">{{ $item->scholarships->end_graduation_at }}</td>
                            <td class="px-2 py-1">
                                <a href="{{ route('khusus.listStudents', $item->scholarship_data_id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Detail</a>
                            </td>
                        </tr>
                        <?php $displayedIds[] = $item->scholarship_data_id; ?>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
