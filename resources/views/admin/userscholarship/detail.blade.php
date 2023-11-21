@extends('admin.dashboard')

@section('navbar', 'Detail Pengusul')

@section('content')
    <div class="mb-4 text-start text-lg">
        <a href="{{ route('registrations.index', ['scholarship_id' => $scholarship->id] ) }}"
            class="inline-flex items-start px-2 py-1 text-blue-600 hover:bg-blue-100 rounded-lg">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
    </div>

    <div class="mx-auto max-w-4xl p-4 border rounded-md">
        <h1 class="text-3xl font-bold mb-8 text-center">Detail Pendaftar Beasiswa</h1>
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
                    {{ $user->birthplace }} / {{ $user->birthdate }}
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
                    <label for="{{$file->file_requirement_id}}">{{$file->files->name}}</label><br>
                    <a href="{{ route('admin.scholarship.download', ['file_path' => $file->file_path]) }}"
                        class="text-blue-500 hover:underline text-base" target="_blank">
                        {{ $file->file_path }}
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="mx-auto mt-6 mb-6 p-4 flex justify-center items-center">
            @if ($files->isEmpty())
                <p>Tidak ada berkas yang tersedia</p>
            @else
                @if (!$files[0]->status)
                    <form action="{{ route('admin.scholarship.validate', ['scholarship_id' => $scholarship->id]) }}"
                        method="POST">
                        @csrf
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300 transition duration-300 ease-in-out">
                            <span class="flex items-center">
                                <span class="mr-2">Validasi</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </span>
                        </button>
                    </form>
                    <form
                        action="{{ route('admin.scholarship.cancelValidation', ['scholarship_id' => $scholarship->id]) }}"
                        method="POST">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 focus:outline-none focus:ring focus:border-blue-300 transition duration-300 ease-in-out ml-4">
                            <span class="flex items-center">
                                <span class="mr-2">Tolak Validasi</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </span>
                        </button>
                    </form>
                @else
                    <p>Berkas sudah divalidasi</p>
                @endif
            @endif
        </div>
    </div>
@endsection
