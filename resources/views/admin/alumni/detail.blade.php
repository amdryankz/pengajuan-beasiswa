@extends('admin.dashboard')

@section('navbar', 'Alumni')

@section('content')
    <div class="bg-white mx-auto max-w-4xl p-4 border rounded-md  mb-8 text-start text-lg">
        <div class="mb-4">
            <a href="{{ route('alumni.index', ['scholarship_id' => $scholarship->id]) }}"
                class="inline-flex items-start p-2 text-blue-600 hover:bg-blue-100 rounded-lg">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
        </div>



        <div class="mx-auto max-w-4xl p-4 border shadow-sm rounded-md">
            <h1 class="text-3xl font-bold mb-8 text-center">Detail Pendaftar Beasiswa - {{ $scholarship->name }}</h1>
            <div class="mb-10 max-w-xl mx-auto flex justify-between">
                <div class="text-lg">
                    <div class="mb-3">
                        <span class="font-bold">Nama Mahasiswa:</span><br>
                        {{ $user->name }}
                    </div>
                    <div class="mb-3">
                        <span class="font-semibold">Jenis Kelamin:</span><br>
                        {{ $user->jk }}
                    </div>
                    <div class="mb-3">
                        <span class="font-bold">NIM:</span><br>
                        {{ $user->nim }}
                    </div>
                    <div class="mb-3">
                        <span class="font-semibold">Fakultas:</span><br>
                        {{ $user->fakultas }}
                    </div>
                    <div class="mb-3">
                        <span class="font-bold">Prodi:</span><br>
                        {{ $user->prodi }}
                    </div>
                    <div class="mb-3">
                        <span class="font-semibold">IPK:</span><br>
                        {{ $user->ipk }}
                    </div>
                    <div class="mb-3">
                        <span class="font-semibold">Jumlah SKS yang telah diambil:</span><br>
                        {{ $user->total_sks }}
                    </div>
                    <div class="mb-3">
                        <span class="font-semibold">Tempat / Tanggal Lahir:</span><br>
                        {{ $user->birthplace }} / {{ date('d F Y', strtotime($user->birthdate)) }}
                    </div>
                    <div class="mb-3">
                        <span class="font-semibold">Alamat:</span><br>
                        {{ $user->address }}
                    </div>
                </div>

                <div class="text-lg">
                    <div class="mb-3">
                        <span class="font-bold">Nomor Hp:</span><br>
                        {{ $user->no_hp }}
                    </div>
                    <div class="mb-3">
                        <span class="font-semibold">Nama Pemilik Rekening:</span><br>
                        {{ $user->name_rek }}
                    </div>
                    <div class="mb-3">
                        <span class="font-bold">Nomor Rekening:</span><br>
                        {{ $user->no_rek }}
                    </div>
                    <div class="mb-3">
                        <span class="font-bold">Nama Bank:</span><br>
                        {{ $user->name_bank }}
                    </div>
                    <div class="mb-3">
                        <span class="font-semibold">Nama Orang Tua:</span><br>
                        {{ $user->name_parent }}
                    </div>
                    <div class="mb-3">
                        <span class="font-semibold">Pekerjaan Orang Tua:</span><br>
                        {{ $user->job_parent }}
                    </div>
                    <div class="mb-3">
                        <span class="font-semibold">Penghasilan Orang tua:</span><br>
                        {{ $user->income_parent }}
                    </div>

                </div>
            </div>

            <h2 class="text-2xl font-bold mb-2 text-center">Berkas yang Diunggah</h2>
            <ul class="list-disc pl-4 mx-auto max-w-2xl">
                @foreach ($files as $file)
                    <li class="mb-2">
                        @if ($file->files)
                            <span class="text-lg font-bold">{{ $file->files->name }}</span><br>
                            <a href="{{ route('admin.scholarship.download', ['file_path' => $file->file_path]) }}"
                                class="text-blue-500 hover:underline text-base" target="_blank">
                                {{ $file->file_path }}
                            </a>
                        @else
                            <span class="text-lg text-red-500">File not available</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
