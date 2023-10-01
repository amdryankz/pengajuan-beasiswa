@extends('admin.dashboard')

@section('content')
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
                <a
                    href="{{ route('admin.scholarship.download', ['file_path' => $file->file_path]) }}">{{ $file->file_path }}</a>
            </li>
        @endforeach
    </ul>
@endsection
