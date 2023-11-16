@extends('admin.dashboard')

@section('content')
    <div class="pb-3"><a href="{{ route('beasiswa.index') }}" class="btn btn-secondary">
            << Kembali</a>
    </div>
    <form action="{{ route('beasiswa.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Beasiswa</label>
            <input type="text" class="form-control form-control-sm" name="name" id="name" aria-describedby="helpId"
                placeholder="Nama Beasiswa" value="{{ Session::get('name') }}">
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Tahun</label>
            <select class="form-select" name="year" id="year">
                <option>-- Pilih --</option>
                @foreach ($tahunArray as $tahun)
                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="status_scholarship" class="form-label">Status Beasiswa</label>
            <select class="form-select" name="status_scholarship" id="status_scholarship">
                <option>-- Pilih --</option>
                <option>Umum</option>
                <option>Khusus</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="donors_id" class="form-label">Pilih Donatur</label>
            <select class="form-select" name="donors_id" id="donors_id">
                <option>-- Pilih --</option>
                @foreach ($data as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="value" class="form-label">Nominal</label>
            <input type="text" class="form-control form-control-sm" name="value" id="value"
                aria-describedby="helpId" placeholder="Nominal" value="{{ Session::get('value') }}">
        </div>
        <div class="mb-3">
            <label for="status_value" class="form-label">Per</label>
            <select class="form-select" name="status_value" id="status_value">
                <option>-- Pilih --</option>
                <option>Bulan</option>
                <option>Tahun</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Durasi</label>
            <select class="form-select" name="duration" id="duration">
                <option>-- Pilih --</option>
                @for ($i = 1; $i <= 48; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal">Mulai Pendaftaran Beasiswa</label>
            <input type="date" id="start_regis_at" name="start_regis_at">
        </div>
        <div class="mb-3">
            <label for="tanggal">Akhir Pendaftaran Beasiswa</label>
            <input type="date" id="end_regis_at" name="end_regis_at">
        </div>
        <div class="mb-3">
            <label for="min_ipk" class="form-label">Minimal IPK</label>
            <input type="text" class="form-control form-control-sm" name="min_ipk" id="min_ipk"
                aria-describedby="helpId" placeholder="IPK" value="{{ Session::get('min_ipk') }}">
        </div>
        <div class="mb-3">
            <label for="tanggal">Mulai Penentuan Kelulusan</label>
            <input type="date" id="start_graduation_at" name="start_graduation_at">
        </div>
        <div class="mb-3">
            <label for="tanggal">Akhir Penentuan Kelulusan</label>
            <input type="date" id="end_graduation_at" name="end_graduation_at">
        </div>
        <div class="mb-3">
            <label for="kuota_fakultas_1">Kuota Fakultas 1:</label>
            <input type="number" name="kuota[MIPA]" id="kuota_fakultas_1" required><br>

            <label for="kuota_fakultas_2">Kuota Fakultas 2:</label>
            <input type="number" name="kuota[Ekonomi]" id="kuota_fakultas_2" required><br>
        </div>
        <div class="mb-3">
            <label>Persyaratan</label>
            @foreach ($file as $requirement)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="requirements[]"
                        value="{{ $requirement->id }}">
                    <label class="form-check-label">{{ $requirement->name }}</label>
                </div>
            @endforeach
        </div>

        <button class="btn btn-primary" name="simpan" type="submit">SIMPAN</button>
    </form>
@endsection
