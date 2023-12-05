@extends('admin.dashboard')

@section('navbar', 'Tambah Pengguna')

@section('content')
    <div class="bg-white p-6 rounded-md shadow-md">
        <div class="pb-3">
            <a href="{{ route('access.index') }}"
                class="inline-flex items-start px-2 py-1 text-blue-600 hover:bg-blue-100 rounded-lg">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
        </div>
        <form action="{{ route('access.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nip" class="block text-sm font-medium text-gray-600">NIP</label>
                <input type="number"
                    class="mt-1 p-2 w-full rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-sky-500"
                    name="nip" id="nip" aria-describedby="helpId" placeholder="NIP">
            </div>
            <div class="mb-3">
                <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
                <input type="text"
                    class="mt-1 p-2 w-full rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-sky-500"
                    name="name" id="name" aria-describedby="helpId" placeholder="Name">
            </div>
            <div class="mb-3">
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <input type="password"
                    class="mt-1 p-2 w-full rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-sky-500"
                    name="password" id="password" required>
            </div>
            <div class="mb-3">
                <label for="role_id" class="block text-sm font-medium text-gray-600">Hak Akses</label>
                <select
                    class="mt-1 p-2 w-full rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-sky-500"
                    name="role_id" id="role_id">
                    <option value="" hidden>-- Pilih --</option>
                    @foreach ($roles as $item)
                        <option value="{{ $item->id }}" {{ $disabledOptions[$item->id] ? 'disabled' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded" name="simpan"
                type="submit">SIMPAN</button>
        </form>
    </div>
@endsection
