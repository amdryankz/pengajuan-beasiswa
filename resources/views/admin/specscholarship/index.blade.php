@extends('admin.dashboard')

@section('content')
    <p class="card-title">Beasiswa Khusus</p>
    <div class="pb-3"><a href="{{ route('khusus.create') }}" class="btn btn-primary">+ Tambah Beasiswa Khusus</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Beasiswa</th>
                    <th>Tahun</th>
                    <th>Nama Donatur</th>
                    <th>Nominal</th>
                    <th>Durasi</th>
                    <th>Mulai Pendaftaran Beasiswa</th>
                    <th>Akhir Pendaftaran Beasiswa</th>
                    <th>IPK</th>
                    <th>Mulai Penentuan Kelulusan</th>
                    <th>Akhir Penentuan Kelulusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php $displayedIds = []; ?> <!-- Variabel untuk melacak scholarship_data_id yang sudah ditampilkan -->
                @foreach ($data as $item)
                    @if (!in_array($item->scholarship_data_id, $displayedIds))
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->scholarships->name }}</td>
                            <td>{{ $item->scholarships->year }}</td>
                            <td>{{ $item->scholarships->donor->name }}</td>
                            <td>{{ $item->scholarships->value }}/{{ $item->scholarships->status_value }}</td>
                            <td>{{ $item->scholarships->duration }}</td>
                            <td>{{ $item->scholarships->start_regis_at }}</td>
                            <td>{{ $item->scholarships->end_regis_at }}</td>
                            <td>{{ $item->scholarships->min_ipk }}</td>
                            <td>{{ $item->scholarships->start_graduation_at }}</td>
                            <td>{{ $item->scholarships->end_graduation_at }}</td>
                            <td>
                                <a href="{{ route('khusus.listStudents', $item->scholarship_data_id) }}"
                                    class="btn btn-sm btn-warning">Detail</a>
                            </td>
                        </tr>
                        <?php $displayedIds[] = $item->scholarship_data_id; ?> <!-- Tambahkan scholarship_data_id ke daftar yang sudah ditampilkan -->
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
