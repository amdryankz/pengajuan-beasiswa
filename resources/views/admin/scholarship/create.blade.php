@extends('admin.dashboard')

@section('navbar', 'Beasiswa')

@section('content')
    <div class="p-4 pt-8 bg-white">
        <div class="mb-4 text-start text-lg">
            <a href="{{ route('beasiswa.index') }}"
                class="inline-flex items-start px-2 py-1 text-blue-600 hover:bg-blue-100 rounded-lg">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
            <div class="mb-4 text-center">
                <h1 class="text-2xl font-semibold text-slate-700" style="text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                    Tambah Beasiswa</h1>
            </div>
        </div>
        <div class="p-6 rounded-lg shadow-sm bg-gray-200">

            <form action="{{ route('beasiswa.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block ml-1">
                        <span
                            class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-red-600 after:ml-0.5">
                            Nama Beasiswa</span>
                        <input type="text" name="name" id="name"
                            class="border-solid border-1 border-neutral-200 w-full block focus:border-blue-500 rounded-md text-sm py-2 px-3 placeholder:text-slate-400"
                            placeholder="Nama Beasiswa" value="{{ Session::get('name') }}" required>
                    </label>
                </div>
                <div class="mb-4">
                    <label for="donors_id" class="block ml-1">
                        <span
                            class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-red-600 after:ml-0.5">
                            Pilih Donatur</span>
                        <select
                            class="form-select w-full px-3 py-2 border-1 border-solid border-neutral-200 rounded-md focus:border-sky-500 outline-none text-sm"
                            name="donors_id" id="donors_id">
                            <option value="" disabled selected class="text-gray-600 hidden">Nama Donatur</option>
                            @foreach ($donor as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
        </div>
        <div class="mt-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" name="simpan"
                type="submit">Simpan</button>
        </div>
        </form>
    </div>
@endsection
