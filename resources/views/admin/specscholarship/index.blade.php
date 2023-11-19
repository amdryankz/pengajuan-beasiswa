@extends('admin.dashboard')

@section('navbar', 'Upload Khusus')

@section('content')
    <h2 class="text-xl font-semibold mb-2">Beasiswa Khusus</h2>
    <div class="pt-2 pb-2">
        <a href="{{ route('khusus.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded">+
            Tambah Beasiswa Khusus</a>
    </div>
    <div class="overflow-x-auto pt-4">
        <table class="table-auto w-full bg-white border border-gray-200 text-xs">
            <thead>
                <tr>
                    <th class="px-2 py-1">No</th>
                    <th class="px-2 py-1">Nama Beasiswa</th>
                    <th class="px-2 py-1">Tahun</th>
                    <th class="px-2 py-1">Nama Donatur</th>
                    <th class="px-2 py-1">Nominal</th>
                    <th class="px-2 py-1">Durasi</th>
                    <th class="px-2 py-1">Mulai Pendaftaran</th>
                    <th class="px-2 py-1">Akhir Pendaftaran</th>
                    <th class="px-2 py-1">IPK</th>
                    <th class="px-2 py-1">Mulai Penentuan</th>
                    <th class="px-2 py-1">Akhir Penentuan</th>
                    <th class="px-2 py-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php $displayedIds = []; ?>
                @foreach ($data as $item)
                    @if (!in_array($item->scholarship_data_id, $displayedIds))
                        <tr>
                            <td class="px-2 py-1">{{ $i++ }}</td>
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
