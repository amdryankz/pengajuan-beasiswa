@extends('admin.dashboard')

@section('content')
    <p class="card-title">Pengguna</p>
    <div class="pb-3"><a href="{{ route('access.create') }}" class="btn btn-primary">+ Tambah Pengguna</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-1">No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Hak Akses</th>
                    <th>Status</th>
                    <th class="col-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->nip }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->role ? $item->role->name : 'Tidak ada' }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="{{ route('access.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form onsubmit="return confirm('Yakin mau hapus data ini?')"
                                action="{{ route('access.destroy', $item->id) }}" class="d-inline" method="POST">
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
