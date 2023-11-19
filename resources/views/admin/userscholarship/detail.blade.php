@extends('admin.dashboard')

@section('navbar', 'Detail Pengusul')

@section('content')
    <div class="mb-4 text-start text-lg">
        <a href="{{ route('registrations.index') }}"
            class="inline-flex items-start px-2 py-1 text-blue-600 hover:bg-blue-100 rounded-lg">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
    </div>
    <div class="flex justify-center items-center">
        <div class="bg-white p-8 rounded-lg ring-2 ring-gray-600 shadow-md w-full max-w-3xl">
            <h1 class="text-3xl font-bold mb-4">Detail Pendaftaran Beasiswa</h1>

            <p class="mb-2 text-base">Nama Mahasiswa: {{ $user->name }}</p>
            <p class="mb-2 text-base">NIM: {{ $user->nim }}</p>
            <p class="mb-2 text-base">Prodi: {{ $user->prodi }}</p>
            <p class="mb-4 text-base">Nama Beasiswa: {{ $scholarship->name }}</p>

            <h2 class="text-2xl font-bold mb-2">Berkas yang Diunggah</h2>
            <ul class="list-disc pl-4">
                @foreach ($files as $file)
                    <li class="mb-2">
                        <a href="{{ route('admin.scholarship.download', ['file_path' => $file->file_path]) }}"
                            class="text-blue-500 hover:underline text-base">
                            {{ $file->file_path }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="mt-4">
                @if ($files->isEmpty())
                    <p>Tidak ada berkas yang tersedia</p>
                @else
                    @if (!$files[0]->status)
                        <form action="{{ route('admin.scholarship.validate', ['scholarship_id' => $scholarship->id]) }}"
                            method="POST">
                            @csrf
                            <button type="submit"
                                class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300">
                                Validasi
                            </button>
                        </form>
                    @else
                        <form
                            action="{{ route('admin.scholarship.cancelValidation', ['scholarship_id' => $scholarship->id]) }}"
                            method="POST">
                            @csrf
                            <button type="submit"
                                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 focus:outline-none focus:ring focus:border-blue-300">
                                Batal Validasi
                            </button>
                        </form>
                    @endif
                @endif
            </div>

        </div>
    </div>
@endsection
