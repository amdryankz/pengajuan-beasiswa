@extends('admin.dashboard')

@section('navbar', 'Detail Beasiswa')

@section('content')
    <div>
        <div class="mb-4 text-start text-lg">
            <a href="{{ route('pengelolaan.index') }}"
                class="inline-flex items-start px-2 py-1 text-blue-600 hover:bg-blue-100 rounded-lg">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
        </div>

        <div class="bg-slate-50 p-6 rounded-lg shadow-lg ">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold">Detail Beasiswa</h2>
            </div>

            <div>
                <!-- Tampilkan informasi beasiswa disini -->
                <p class="mb-2 text-base"><span class="font-semibold text-lg">Nama Beasiswa :</span>
                    {{ $beasiswa->scholarship->name }}
                </p>
                <p class="mb-2 text-base"><span class="font-semibold text-lg">Tahun :</span> {{ $beasiswa->year }}</p>
                <!-- ... tambahkan informasi lainnya ... -->

                <!-- Tampilkan informasi Kuota -->
                <h3 class="mt-4 text-xl font-semibold">Kuota :</h3>
                @php
                    $quotafaculty = json_decode($beasiswa->quota, true);
                @endphp

                <table class="table-auto mt-2 w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Fakultas</th>
                            <th class="px-4 py-2">Kuota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quotafaculty as $faculty => $quota)
                            <tr>
                                <td class="border px-4 py-2">{{ $faculty }}</td>
                                <td class="border px-4 py-2">{{ $quota }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Tampilkan informasi Berkas -->
                <h3 class="mt-4 text-xl font-semibold">Berkas yang Diperlukan :</h3>
                <ul class="list-disc pl-6 text-base">
                    @foreach ($beasiswa->requirements as $requirement)
                        <li>{{ $requirement->name }}</li>
                    @endforeach
                </ul>
                <h3 class="mt-4 text-xl font-semibold">Surat Keputusan Kelulusan (SK) :</h3>
                <ul class="list-disc pl-6 text-base">
                    @if ($beasiswa->sk_file)
                        <li>
                            <a href="{{ asset('storage/' . $beasiswa->sk_file) }}" target="_blank"
                                class="text-blue-500 hover:underline">Lihat File
                                SK</a>
                        </li>
                    @else
                        <li>
                            SK belum diupload
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection
