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
@endsection
