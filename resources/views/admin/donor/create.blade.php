@extends('admin.dashboard')

@section('navbar', 'Donatur')

@section('content')
    <div>
        <div class="mb-4 text-start text-lg">
            <a href="{{ route('donatur.index') }}"
                class="inline-flex items-start px-2 py-1 text-blue-600 hover:bg-blue-100 rounded-lg">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
            <div class="mb-4 text-center">
                <h1 class="text-2xl font-semibold text-slate-700" style="text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                    Tambah Donatur</h1>
            </div>
            <form action="{{ route('donatur.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block ml-1 ">
                        <span
                            class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-red-600 after:ml-0.5">
                            Nama Donatur</span>

                        <input type="text" name="name" id="name"
                            class="border-solid border-1 border-neutral-200 w-full block focus:border-blue-500 rounded-md text-sm py-2 px-3 placeholder:text-slate-400"
                            placeholder="Nama Donatur" value="{{ Session::get('name') }}" required>
                    </label>
                </div>
        </div>
        <div class="mt-4 text-white">
            <button class="bg-blue-500 px-4 py-2 rounded-md float-left hover:bg-blue-600" name="simpan"
                type="submit">Simpan</button>
            </form>
        </div>
    </div>
@endsection
