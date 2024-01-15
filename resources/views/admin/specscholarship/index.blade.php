@extends('admin.dashboard')

@section('navbar', 'Upload Khusus')

@section('content')


    <div class="bg-white p-4">
        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">Beasiswa Khusus</h2>
            <a href="{{ route('pengelolaan-khusus.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block">+
                Tambah Beasiswa Khusus
            </a>
        </div>


        <div class="p-2">
            <table id="myTable" class="table-auto min-w-full border border-collapse max-h-[500px] overflow-y-auto">
                <thead>
                    <tr class="border-b-2 bg-sky-800 text-white text-sm font-semibold">
                        <th class="px-2 py-2 text-center border-r">No</th>
                        <th class="px-2 py-2 text-center border-r">Nama Beasiswa</th>
                        <th class="px-2 py-2 text-center border-r">Tahun</th>
                        <th class="px-2 py-2 text-center border-r">Nama Sumber</th>
                        <th class="px-2 py-2 text-center border-r">Nominal (Rp)</th>
                        <th class="px-3 py-2 text-center border-r">Durasi</th>
                        <th class="px-2 py-2 text-center border-r">Mulai Beasiswa</th>
                        <th class="px-2 py-2 text-center border-r">Akhir Beasiswa</th>
                        <th class="px-2 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($data as $item)
                        <tr class="border-b-2 text-sm font-normal">
                            <td class="px-1 py-1 text-center border-r">{{ $loop->iteration }}</td>
                            <td class="px-2 py-1 text-center border-r">{{ $item->scholarship->name }}</td>
                            <td class="px-2 py-1 text-center border-r">{{ $item->year }}</td>
                            <td class="px-2 py-1 text-center border-r">{{ $item->scholarship->donors->name }}</td>
                            <td class="px-2 py-1 text-center border-r">Rp {{ $item->value }} / {{ $item->status_value }}
                            </td>
                            <td class="text-center border-r">{{ $item->duration }} Bulan</td>
                            <td class="px-2 py-1 text-center border-r">{{ $item->start_scholarship->format('d-m-Y') }}</td>
                            <td class="px-2 py-1 text-center border-r">{{ $item->end_scholarship->format('d-m-Y') }}</td>
                            <td class="px-2 py-1 text-center border-r">
                                <div class="relative inline-block text-left" x-data="{ opendropdown: false }">
                                    <button @click="opendropdown = !opendropdown"
                                        class="flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs items-center"
                                        id="aksiDropdown{{ $loop->iteration }}">
                                        <span class="mr-2">Aksi</span>
                                        <i class="bi bi-chevron-down"></i>
                                    </button>

                                    {{-- dropdown --}}
                                    <div x-show="opendropdown" @click.away="opendropdown = false" x-cloak>

                                        <div id="modalSK" x-cloak x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                            class="z-10 bg-white divide-y divide-gray-100 rounded shadow w-24 absolute right-0 mt-2">
                                            <ul class="text-sm py-1 text-slate-700 m-2">
                                                <li class="flex items-center hover:bg-gray-100 rounded mb-0.5">
                                                    <a class="flex items-center"
                                                        href="{{ route('pengelolaan-khusus.show', $item->id) }}">
                                                        <ion-icon name="information-circle" class="mr-1"></ion-icon>
                                                        Detail
                                                    </a>
                                                </li>


                                                <li class="flex items-center hover:bg-gray-100 rounded mb-0.5">
                                                    <div x-data="{ openmodalSK: false }" x-cloak>
                                                        <button @click="openmodalSK = true"
                                                            class="flex items-center rounded text-sm  hover:text-blue-600">
                                                            <ion-icon name="Document" class="mr-1"></ion-icon>
                                                            Atur SK
                                                        </button>


                                                        <!-- Modal SK Kelulusan -->

                                                        <template x-if="openmodalSK">
                                                            <div>
                                                                <div
                                                                    class="fixed top-0 left-0 w-full h-full bg-black opacity-50">
                                                                </div>

                                                                <div id="modalSK" x-cloak
                                                                    x-transition:enter="ease-out duration-300"
                                                                    x-transition:enter-start="opacity-0 scale-90"
                                                                    x-transition:enter-end="opacity-100 scale-100"
                                                                    x-transition:leave="ease-in duration-300"
                                                                    x-transition:leave-start="opacity-100 scale-100"
                                                                    x-transition:leave-end="opacity-0 scale-90">
                                                                    <div id="modalSK" x-cloak>
                                                                        <div
                                                                            class="fixed top-10 left-1/3 w-1/2 h-screen flex justify-center items-center">
                                                                            <div
                                                                                class="p-10 bg-white rounded-lg border border-x-gray-200 shadow-md w-full max-w-screen-md">
                                                                                <h2
                                                                                    class="mb-2 text-lg font-bold text-gray-800 text-center">
                                                                                    Atur SK Kelulusan
                                                                                </h2>


                                                                                <form
                                                                                    action="{{ route('khusus.updateSK', $item->id) }}"
                                                                                    method="POST"
                                                                                    enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    @method('PUT')

                                                                                    {{-- kiri --}}
                                                                                    <div class="grid grid-cols-2 gap-4">
                                                                                        <!-- Kiri -->
                                                                                        <div class="col-span-1">
                                                                                            <!-- Tabel -->
                                                                                            <div class="text-sm">
                                                                                                <div class="mb-3">
                                                                                                    <span
                                                                                                        class="font-bold">Nama
                                                                                                        Beasiswa</span>
                                                                                                    {{ $item->name }}
                                                                                                </div>
                                                                                                <div class="mb-3">
                                                                                                    <span
                                                                                                        class="font-semibold">Tahun</span>
                                                                                                    {{ $item->year }}
                                                                                                </div>
                                                                                                <div class="mb-3">
                                                                                                    <span
                                                                                                        class="font-bold">Durasi</span>
                                                                                                    {{ $item->duration }}
                                                                                                    Bulan
                                                                                                </div>
                                                                                                {{-- <div class="mb-3">
                                                                                                <span
                                                                                                    class="font-bold">Akhir
                                                                                                    Pendaftaran
                                                                                                    Beasiswa</span>
                                                                                                {{ $item->end_regis_at }}
                                                                                            </div> --}}
                                                                                                {{-- <div class="mb-3">
                                                                                                <span
                                                                                                    class="font-bold">Akhir
                                                                                                    Seleksi Beasiswa</span>
                                                                                                {{ $item->end_graduation_at }}
                                                                                            </div> --}}
                                                                                                <div class="mb-3">
                                                                                                    <span
                                                                                                        class="font-bold">Nominal</span>
                                                                                                    Rp {{ $item->value }}
                                                                                                    /
                                                                                                    {{ $item->status_value }}
                                                                                                </div>
                                                                                                <div class="mb-3 max-w-xs">
                                                                                                    <span
                                                                                                        class="font-bold">Nomor
                                                                                                        Surat Keputusan
                                                                                                        Kelulusan:</span>
                                                                                                    <input type="text"
                                                                                                        name="no_sk"
                                                                                                        value="{{ $item->no_sk ?? '' }}"
                                                                                                        class="block form-control rounded-lg py-2  hover:ring-1 hover:ring-sky-500"
                                                                                                        required>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <!-- Kanan -->
                                                                                        <div class="col-span-1">
                                                                                            <div class="mb-3">
                                                                                                <span
                                                                                                    class="font-bold block">Dokumen
                                                                                                    Surat Keputusan
                                                                                                    Kelulusan:</span>
                                                                                                <input type="file"
                                                                                                    name="file_sk"
                                                                                                    value="{{ $item->file_sk }}"
                                                                                                    class="form-control rounded-lg py-2 hover:ring-1 hover:ring-sky-500"
                                                                                                    required>
                                                                                                @if ($item->file_sk)
                                                                                                    <p
                                                                                                        class="text-red-500 mt-0.5">
                                                                                                        *Dokumen sudah
                                                                                                        diupload
                                                                                                    </p>
                                                                                                @else
                                                                                                    <p>Dokumen belum
                                                                                                        diupload
                                                                                                    </p>
                                                                                                @endif
                                                                                            </div>
                                                                                            {{-- <div class="mb-3">
                                                                                            <span class="font-bold">Tanggal
                                                                                                Mulai Berlaku
                                                                                                Beasiswa</span>
                                                                                            <input type="date"
                                                                                                name="start_scholarship"
                                                                                                value="{{ $item->start_scholarship ? $item->start_scholarship->format('Y-m-d') : '' }}"
                                                                                                class="form-control rounded-lg py-2 hover:ring-1 hover:ring-sky-500"
                                                                                                required>
                                                                                        </div> --}}
                                                                                            {{-- <div class="mb-3">
                                                                                            <span class="font-bold">Tanggal
                                                                                                Akhir Berlaku
                                                                                                Beasiswa</span>
                                                                                            <input type="date"
                                                                                                name="end_scholarship"
                                                                                                value="{{ $item->end_scholarship ? $item->end_scholarship->format('Y-m-d') : '' }}"
                                                                                                class="form-control rounded-lg py-2 hover:ring-1 hover:ring-sky-500"
                                                                                                required>
                                                                                        </div> --}}
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Tombol Simpan dan Batal -->
                                                                                    <button
                                                                                        class="text-white bg-blue-500 hover:bg-blue-700 font-medium rounded-lg text-sm px-3 py-2"
                                                                                        type="submit">Simpan</button>
                                                                                    <button @click="openmodalSK = false"
                                                                                        class="text-white bg-red-500 hover:bg-red-700 font-medium rounded-lg text-sm px-3 py-2">Batal</button>
                                                                                </form>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </template>

                                                    </div>
                                                </li>

                                                <li class="flex items-center hover:bg-gray-100 rounded mb-0.5">
                                                    <a class="flex items-center"
                                                        href="{{ route('pengelolaan-khusus.edit', $item->id) }}">
                                                        <ion-icon name="create" class="mr-1"></ion-icon>
                                                        Edit
                                                    </a>
                                                </li>
                                                <li class="flex items-center hover:bg-gray-100 rounded mb-0.5">
                                                    <form onsubmit="return confirm('Yakin mau hapus data ini?')"
                                                        action="{{ route('pengelolaan-khusus.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="flex items-center rounded text-sm text-red-500 hover:text-red-600">
                                                            <ion-icon name="trash" class="mr-1"></ion-icon>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
