@extends('user.dashboard')

@section('content')
    <div class="container">
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

        <form action="{{ route('dashboard.store', $scholarship->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    Detail Beasiswa: {{ $scholarship->name }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">Nama Beasiswa: {{ $scholarship->scholarship->name }}</h5>
                    <p class="card-text">Durasi Beasiswa: {{ $scholarship->duration }} Bulan</p>
                    <p class="card-text">Mulai Pendaftaran: {{ $scholarship->start_regis_at }}</p>
                    <p class="card-text">Akhir Pendaftaran: {{ $scholarship->end_regis_at }}</p>
                    <p class="card-text">Minimal IPK: {{ $scholarship->min_ipk }}</p>
                    <div class="form-group">
                        <label for="dosen_wali_approval">Surat Izin Dosen Wali</label>
                        <input type="file" class="form-control" id="dosen_wali_approval" name="dosen_wali_approval"
                            required>
                        @error('dosen_wali_approval')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <h5 class="mt-3">Berkas yang Diperlukan</h5>
                    <ul>
                        @foreach ($fileRequirements as $file_requirement)
                            <div class="form-group">
                                <label
                                    for="file_requirement_{{ $file_requirement->id }}">{{ $file_requirement->name }}</label>
                                <input type="file" class="form-control"
                                    id="file_requirement_{{ $file_requirement->id }}"
                                    name="file_requirements[{{ $file_requirement->id }}]" required>
                                @error('file_requirements.' . $file_requirement->id)
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                    </ul>
                    <input type="hidden" name="scholarship_data_id" value="{{ $scholarship->id }}">
                </div>
            </div>
            <button class="btn btn-primary" name="daftar" type="submit">Daftar</button>
            <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
