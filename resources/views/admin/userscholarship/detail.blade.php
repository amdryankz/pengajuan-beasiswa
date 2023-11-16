@extends('admin.dashboard')

@section('content')
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
    <h1>Detail Pendaftaran Beasiswa</h1>

    <p>Nama Mahasiswa: {{ $user->name }}</p>
    <p>NIM: {{ $user->nim }}</p>
    <!-- Informasi lain tentang mahasiswa -->

    <p>Nama Beasiswa: {{ $scholarship->name }}</p>
    <!-- Informasi lain tentang beasiswa -->

    <h2>Berkas yang Diunggah</h2>
    <ul>
        @foreach ($files as $file)
            <li>
                <a href="{{ route('admin.scholarship.download', ['file_path' => $file->file_path]) }}"
                    target="_blank">{{ $file->file_path }}</a>
            </li>
        @endforeach
        @if (!$file->status_file)
            <form action="{{ route('admin.scholarship.validate', ['scholarship_id' => $scholarship->id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Validasi</button>
            </form>
        @else
            <form action="{{ route('admin.scholarship.cancelValidation', ['scholarship_id' => $scholarship->id]) }}"
                method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Batal Validasi</button>
            </form>
        @endif
    </ul>
@endsection
