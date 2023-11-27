@extends('user.dashboard')

@section('content')
    <p class="card-title">List Pendaftaran Beasiswa</p>
    <div class="overflow-x-auto border rounded-lg">
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
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300">No</th>
                    <th class="border border-gray-300">Nama Beasiswa</th>
                    <th class="border border-gray-300">Mulai Pendaftaran Beasiswa</th>
                    <th class="border border-gray-300">Akhir Pendaftaran Beasiswa</th>
                    <th class="border border-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($data as $item)
                    <tr>
                        <td class="border border-gray-300">{{ $i++ }}</td>
                        <td class="border border-gray-300">{{ $item->name }}</td>
                        <td class="border border-gray-300">{{ $item->start_regis_at->format('d-m-Y') }}</td>
                        <td class="border border-gray-300">{{ $item->end_regis_at->format('d-m-Y') }}</td>
                        <td class="border border-gray-300">
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
    <div class="overflow-x-auto border rounded-lg">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300">No</th>
                    <th class="border border-gray-300">Nama Beasiswa</th>
                    <th class="border border-gray-300">Status Berkas</th>
                    <th class="border border-gray-300">Status Beasiswa</th>
                    <th class="border border-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($dataUser as $item)
                    <tr>
                        <td class="border border-gray-300">{{ $i++ }}</td>
                        <td class="border border-gray-300">{{ $item->scholarshipData->name }}</td>
                        <td class="border border-gray-300">
                            @if ($item->status_file === null)
                                Diproses
                            @elseif ($item->status_file == false)
                                Ditolak
                            @elseif ($item->status_file == true)
                                Lulus Berkas
                            @endif
                        </td>
                        <td class="border border-gray-300">
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
                        <td class="border border-gray-300">
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
    <div class="overflow-x-auto border rounded-lg">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300">No</th>
                    <th class="border border-gray-300">Nama Beasiswa</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($alumniData as $item)
                    <tr>
                        <td class="border border-gray-300">{{ $i++ }}</td>
                        <td class="border border-gray-300">{{ $item['scholarship']->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
