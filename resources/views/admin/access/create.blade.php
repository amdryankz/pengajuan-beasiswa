@extends('admin.dashboard')

@section('content')
    <div class="pb-3"><a href="{{ route('access.index') }}" class="btn btn-secondary">
            << Kembali</a>
    </div>
    <form action="{{ route('access.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="number" class="form-control form-control-sm" name="nip" id="nip" aria-describedby="helpId"
                placeholder="NIP ">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control form-control-sm" name="name" id="name"
                aria-describedby="helpId" placeholder="NIP ">
        </div>
        <div>
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="role_id" class="form-label">Hak Akses</label>
            <select class="form-select" name="role_id" id="role_id">
                <option>-- Pilih --</option>
                @foreach ($roles as $item)
                    <option value="{{ $item->id }}" {{ $disabledOptions[$item->id] ? 'disabled' : '' }}>
                        {{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary" name="simpan" type="submit">SIMPAN</button>
    </form>
@endsection
