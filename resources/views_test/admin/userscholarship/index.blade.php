@extends('admin.dashboard')

@section('content')
    <p class="card-title">List Pendaftaran Beasiswa</p>
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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Prodi</th>
                    <th>Nama Beasiswa</th>
                    <th>Aksi</th>
                    <th>Status</th>
                    <th>Biodata</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item['user']->name }}</td>
                        <td>{{ $item['user']->nim }}</td>
                        <td>{{ $item['user']->prodi }}</td>
                        <td>{{ $item['scholarship']->name }}</td>
                        <td>
                            <a href="{{ route('admin.scholarship.detail', ['user_id' => $item['user']->id, 'scholarship_id' => $item['scholarship']->id]) }}"
                                class="btn btn-info">Detail</a>
                        </td>
                        <td>
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
                        <td><a href="{{ route('admin.scholarship.pdf', ['user_id' => $item['user']->id, 'scholarship_id' => $item['scholarship']->id]) }}"
                                target="_blank">Lihat</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
