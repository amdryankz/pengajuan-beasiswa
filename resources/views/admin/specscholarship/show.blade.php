@extends('admin.dashboard')

@section('content')
    <h1>Detail Beasiswa</h1>
    <!-- Tampilkan informasi lainnya sesuai kebutuhan -->
    @if ($students->count() > 0)
        <ul>
            @foreach ($students as $student)
                <li>{{ $student }}</li>
            @endforeach
        </ul>
    @else
        <p>Belum ada daftar mahasiswa untuk beasiswa ini.</p>
    @endif
@endsection
