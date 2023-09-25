@extends('admin.dashboard')

@section('content')
    <p class="card-title">Beasiswa</p>
    <div class="pb-3"><a href="{{ route('beasiswa.create') }}" class="btn btn-primary">+ Tambah Beasiswa</a>
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
                    <th>Mulai Penentuan Kelulusan</th>
                    <th>Akhir Penentuan Kelulusan</th>
                    <th>IPK</th>
                    <th>Kuota</th>
                    <th>Berkas yang Diperlukan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->year }}</td>
                        <td>{{ $item->donor->name }}</td>
                        <td>{{ $item->value }}/{{ $item->status_value }}</td>
                        <td>{{ $item->duration }}</td>
                        <td>{{ $item->start_regis_at }}</td>
                        <td>{{ $item->end_regis_at }}</td>
                        <td>{{ $item->min_ipk }}</td>
                        <td>{{ $item->start_graduation_at }}</td>
                        <td>{{ $item->end_graduation_at }}</td>
                        <td>
                            @php
                                $kuotaFakultas = json_decode($item->kuota, true);
                            @endphp
                            @foreach ($kuotaFakultas as $fakultas => $kuota)
                                {{ $fakultas }}: {{ $kuota }}<br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($item->requirements as $requirement)
                                {{ $requirement->name }}<br>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('beasiswa.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form onsubmit="return confirm('Yakin mau hapus data ini?')"
                                action="{{ route('beasiswa.destroy', $item->id) }}" class="d-inline" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit" name="submit">Del</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
