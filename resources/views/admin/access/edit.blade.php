@extends('admin.dashboard')

@section('navbar', 'Tambah Pengguna')

@section('content')
    <div class="bg-white p-6 rounded-md shadow-md">
        <div class="mb-4">
            <a href="{{ route('access.index') }}"
                class="inline-flex items-start px-2 py-1 text-blue-600 hover:bg-blue-100 rounded-lg">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
        </div>
        <form action="{{ route('access.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nip" class="block text-sm font-medium text-gray-600">NIP</label>
                <input type="number"
                    class="mt-1 p-2 w-full rounded-md border-1 focus:outline-none focus:ring focus:border-sky-500"
                    name="nip" id="nip" placeholder="NIP" value="{{ $user->nip }}" readonly>
            </div>
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
                <input type="text"
                    class="mt-1 p-2 w-full rounded-md border-1 focus:outline-none focus:ring focus:border-sky-500"
                    name="name" id="name" placeholder="Name" value="{{ $user->name }}" readonly>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <input type="password"
                    class="mt-1 p-2 w-full rounded-md border-1 focus:outline-none focus:ring focus:border-sky-500"
                    name="password" id="password" required>
            </div>
            <div class="mb-4">
                <label for="role_id" class="block text-sm font-medium text-gray-600">Hak Akses</label>
                <select
                    class="mt-1 p-2 w-full rounded-md border-1  focus:outline-none focus:ring focus:border-sky-500"
                    name="role_id" id="role_id">
                    <option value="" hidden>-- Pilih --</option>
                    @foreach ($roles as $item)
                        <option value="{{ $item->id }}" {{ $disabledOptions[$item->id] ? 'disabled' : '' }}
                            {{ $item->id == $user->role_id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-600">Status</label>
                <select
                    class="mt-1 p-2 w-full rounded-md border-1 focus:outline-none focus:ring focus:border-sky-500"
                    name="status" id="status">
                    <option value="Aktif" {{ $user->status === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Non-Aktif" {{ $user->status === 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                </select>
            </div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded" name="simpan"
                type="submit">SIMPAN</button>
        </form>
    </div>
@endsection
