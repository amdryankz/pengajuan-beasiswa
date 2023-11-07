@extends('admin.dashboard')

@section('content')
    <div class="pb-3"><a href="{{ route('donatur.index') }}" class="btn btn-secondary">
            << Kembali</a>
    </div>
    <form action="{{ route('donatur.update', $data->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="name" class="form-label">Nama Donatur</label>
            <input type="text" class="form-control form-control-sm" name="name" id="name" aria-describedby="helpId"
                placeholder="Nama Donatur" value="{{ $data->name }}">
        </div>
        <button class="btn btn-primary" name="simpan" type="submit">SIMPAN</button>
    </form>
@endsection