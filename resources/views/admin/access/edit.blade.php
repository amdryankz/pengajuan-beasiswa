@extends('admin.dashboard')

@section('content')
    <div class="pb-3"><a href="{{ route('access.index') }}" class="btn btn-secondary">
            << Kembali</a>
    </div>
    <form action="{{ route('access.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="number" class="form-control form-control-sm" name="nip" id="nip" aria-describedby="helpId"
                placeholder="NIP" value="{{ $user->nip }}" readonly>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control form-control-sm" name="name" id="name"
                aria-describedby="helpId" placeholder="Name" value="{{ $user->name }}" readonly>
        </div>
        <div class="mb-3">
            <label for="role_id" class="form-label">Hak Akses</label>
            <select class="form-select" name="role_id" id="role_id">
                <option value="">Tidak ada</option>
                @foreach ($roles as $item)
                    <option value="{{ $item->id }}" {{ $disabledOptions[$item->id] ? 'disabled' : '' }}
                        {{ $item->id == $user->role_id ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" name="status" id="status">
                <option value="Aktif" {{ $user->status === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Non-Aktif" {{ $user->status === 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
            </select>
        </div>
        <button class="btn btn-primary" name="simpan" type="submit">SIMPAN</button>
    </form>
@endsection
