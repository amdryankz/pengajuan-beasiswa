@extends('admin.dashboard')

@section('navbar', 'Detail Pengusul')

@section('content')
    <div class="bg-white mx-auto max-w-4xl p-4 border rounded-md  mb-8 text-start text-lg">
        <div class="mb-4">
            <a href="{{ route('registrations.index', ['scholarship_id' => $scholarship->id]) }}"
                class="inline-flex items-start p-2 text-blue-600 hover:bg-blue-100 rounded-lg">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
        </div>

        <div class="mx-auto max-w-4xl p-4 border rounded-md">
            <h1 class="text-3xl font-bold mb-8 text-center">Detail Pengusul Beasiswa</h1>
            <div class="mb-10 max-w-xl mx-auto flex justify-between">
                <div class="text-lg">
                    <div class="mb-3">
                        <span class="font-bold">Nama Mahasiswa:</span><br>
                        {{ $user->name }}
                    </div>
                    <div class="mb-3">
                        <span class="font-semibold">Jenis Kelamin:</span><br>
                        {{ $user->gender }}
                    </div>
                    <div class="mb-3">
                        <span class="font-bold">NPM:</span><br>
                        {{ $user->npm }}
                    </div>
                    <div class="mb-3">
                        <span class="font-semibold">Fakultas:</span><br>
                        {{ $user->faculty }}
                    </div>
                    <div class="mb-3">
                        <span class="font-bold">Prodi:</span><br>
                        {{ $user->major }}
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
                        {{ $user->phone_number }}
                    </div>
                    <div class="mb-3">
                        <span class="font-semibold">Nama Pemilik Rekening:</span><br>
                        {{ $user->account_holder_name }}
                    </div>
                    <div class="mb-3">
                        <span class="font-bold">Nomor Rekening:</span><br>
                        {{ $user->bank_account_number }}
                    </div>
                    <div class="mb-3">
                        <span class="font-bold">Nama Bank:</span><br>
                        {{ $user->bank_name }}
                    </div>
                    <div class="mb-3">
                        <span class="font-semibold">Nama Orang Tua:</span><br>
                        {{ $user->parent_name }}
                    </div>
                    <div class="mb-3">
                        <span class="font-semibold">Pekerjaan Orang Tua:</span><br>
                        {{ $user->parent_job }}
                    </div>
                    <div class="mb-3">
                        <span class="font-semibold">Penghasilan Orang tua:</span><br>
                        {{ $user->parent_income }}
                    </div>

                </div>
            </div>

            <h2 class="text-2xl font-bold mb-2 text-center">Berkas yang Diunggah</h2>
            <ul class="list-disc pl-4 mx-auto max-w-2xl">
                @foreach ($files as $file)
                    <li class="mb-2">
                        @if ($file->files)
                            <span class="text-lg font-bold">{{ $file->files->name }}</span><br>
                            <a href="{{ route('admin.scholarship.checkFile', ['file_path' => $file->file_path]) }}"
                                class="text-blue-500 hover:underline text-base" target="_blank">
                                {{ $file->file_path }}
                            </a>
                        @else
                            <span class="text-lg text-red-500">File not available</span>
                        @endif
                    </li>
                @endforeach
            </ul>

            <ul class="list-disc pl-4 mx-auto max-w-2xl">
                <li class="mb-2">
                    @if ($file->supervisor_approval_file)
                        <span class="text-lg font-bold">Surat Rekomendasi Dosen Wali</span><br>
                        <a href="{{ route('admin.scholarship.checkFile', ['file_path' => $file->supervisor_approval_file]) }}"
                            class="text-blue-500 hover:underline text-base" target="_blank">
                            {{ $file->supervisor_approval_file }}
                        </a>
                    @else
                        <span class="text-lg text-red-500">File not available</span>
                    @endif
                </li>
            </ul>

            <div class="mx-auto mt-6 mb-6 p-4 flex justify-center items-center">
                @if ($files->isEmpty())
                    <p>Tidak ada berkas yang tersedia</p>
                @else
                    @if (!$files[0]->status)
                        <div class="flex flex-col items-center mt-2">

                            <div class="flex items-center">
                                <form
                                    action="{{ route('admin.scholarship.validate', ['scholarship_id' => $scholarship->id, 'user_id' => $user->id]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 focus:outline-none focus:ring focus:border-blue-300 transition duration-300 ease-in-out">
                                        <span class="flex items-center">
                                            <span class="mr-2">Lulus Berkas</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="h-4 w-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </span>
                                    </button>
                                </form>

                                <form
                                    action="{{ route('admin.scholarship.cancelValidation', ['scholarship_id' => $scholarship->id, 'user_id' => $user->id]) }}"
                                    method="POST" class="ml-4">
                                    @csrf
                                    <button type="submit"
                                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 focus:outline-none focus:ring focus:border-blue-300 transition duration-300 ease-in-out">
                                        <span class="flex items-center">
                                            <span class="mr-2">Tolak Berkas</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="h-4 w-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </span>
                                    </button>
                            </div>

                            <div class="mt-4 w-full">
                                <label for="reason" class="block text-base font-medium text-gray-700 mb-2">Alasan
                                    Penolakan:</label>
                                <textarea id="rejection_reason" name="reason" cols="50" rows="8"
                                    class="mt-1 block w-full rounded-md border-1 shadow-md focus:border-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50 resize-none"
                                    required></textarea>
                            </div>
                            </form>
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </div>
@endsection
