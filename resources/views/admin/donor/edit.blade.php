@extends('admin.dashboard')

@section('navbar', 'Donatur')

@section('content')
    <div class="p-4">

        <div class="flex justify-center">
            <div class="w-3/4 bg-white p-8 rounded-lg shadow-sm">
                <div class="mb-4 text-center">
                    <div class="flex justify-between items-start mb-4">
                        <a href="{{ route('donatur.index') }}"
                            class="inline-flex items-start px-2 py-1 text-blue-600 hover:bg-blue-100 rounded-lg">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <h1 class="text-2xl font-semibold text-slate-700" style="text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                        Edit Donatur
                    </h1>

                </div>
                <form action="{{ route('donatur.update', $data->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="mb-6">
                        <label for="name" class="block ml-1">
                            <span
                                class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-red-600 after:ml-0.5">
                                Nama Donatur
                            </span>
                            <input type="text" name="name" id="name"
                                class="border-solid border-1 border-neutral-200 w-full block focus:border-blue-500 rounded-md text-sm py-2 px-3 placeholder:text-slate-400"
                                placeholder="Nama Donatur" value="{{ $data->name }}" required>
                        </label>
                    </div>
                    <div class="mt-6">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" name="simpan"
                            type="submit">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
