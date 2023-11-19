@extends('user.dashboard')

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
                    <th>Nama Beasiswa</th>
                    <th>Mulai Pendaftaran Beasiswa</th>
                    <th>Akhir Pendaftaran Beasiswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->start_regis_at }}</td>
                        <td>{{ $item->end_regis_at }}</td>
                        <td>
                            <a href="{{ route('dashboard.show', $item->id) }}" class="btn btn-sm btn-warning">Daftar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <br>
    <p class="card-title">History Pendaftaran Beasiswa</p>
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
                    <th>Nama Beasiswa</th>
                    <th>Status Berkas</th>
                    <th>Status Beasiswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($dataUser as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->scholarshipData->name }}</td>
                        <td>
                            @if ($item->status_file === null)
                                Diproses
                            @elseif ($item->status_file == false)
                                Ditolak
                            @elseif ($item->status_file == true)
                                Lulus Berkas
                            @endif
                        </td>
                        <td>
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
                        <td>
                            <form onsubmit="return confirm('Yakin mau hapus data ini?')"
                                action="{{ route('dashboard.destroy', $item->id) }}" class="d-inline" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit" name="submit">Batal Daftar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <br>
    <p class="card-title">History Penerimaan Beasiswa</p>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Beasiswa</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($alumniData as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item['scholarship']->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
