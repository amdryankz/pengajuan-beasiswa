@extends('admin.dashboard')

@section('navbar', 'Beasiswa')

@section('content')
    <h2 class="text-xl font-semibold mb-2">Beasiswa</h2>

    <div class="mb-4">
        <a href="{{ route('beasiswa.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block">
            + Tambah Beasiswa
        </a>
    </div>

    <div class="overflow-x-auto overflow-hidden">
        <table class="table-auto min-w-full border-2 border-collapse mb-40">
            <thead>
                <tr class="border-b-2 bg-sky-800 text-white text-xs">
                    <th class="px-2 py-1 text-center border-r">No</th>
                    <th class="px-2 py-1 text-center border-r">Nama Beasiswa</th>
                    <th class="px-2 py-1 text-center border-r">Tahun</th>
                    <th class="px-2 py-1 text-center border-r">Nama Donatur</th>
                    <th class="px-2 py-1 text-center border-r">Nominal (Rp)</th>
                    <th class="px-3 py-1 text-center border-r">Durasi</th>
                    <th class="px-2 py-1 text-center border-r">Mulai Pendaftaran</th>
                    <th class="px-2 py-1 text-center border-r">Akhir Pendaftaran</th>
                    <th class="px-2 py-1 text-center border-r">Mulai Kelulusan</th>
                    <th class="px-2 py-1 text-center border-r">Akhir Kelulusan</th>
                    <th class="px-2 py-1 text-center border-r">IPK</th>
                    <th class="px-2 py-1 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    @php $rowColor = $loop->iteration % 2 == 0 ? 'bg-gray-100' : 'bg-white'; @endphp
                    <tr class="border-b-2 text-xs {{ $rowColor }}">
                        <td class="px-1 py-1 text-center border-r">{{ $loop->iteration }}</td>
                        <td class="px-2 py-1 text-center border-r">{{ $item->name }}</td>
                        <td class="px-2 py-1 text-center border-r">{{ $item->year }}</td>
                        <td class="px-2 py-1 text-center border-r">{{ $item->donor->name }}</td>
                        <td class="px-2 py-1 text-center border-r">Rp {{ $item->value }} / {{ $item->status_value }}</td>
                        <td class="text-center border-r">{{ $item->duration }} Bulan</td>
                        <td class="px-2 py-1 text-center border-r">{{ $item->start_regis_at->format('d-m-Y') }}</td>
                        <td class="px-2 py-1 text-center border-r">{{ $item->end_regis_at->format('d-m-Y') }}</td>
                        <td class="px-2 py-1 text-center border-r">{{ $item->start_graduation_at->format('d-m-Y') }}</td>
                        <td class="px-2 py-1 text-center border-r">{{ $item->end_graduation_at->format('d-m-Y') }}</td>
                        <td class="px-2 py-1 text-center border-r">{{ number_format($item->min_ipk, 2, '.', '') }}</td>
                        <td class="px-2 py-1 text-center border-r">
                            <div class="relative inline-block text-left" x-data="{ opendropdown: false }">
                                <button @click="opendropdown = !opendropdown"
                                    class="flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs items-center"
                                    id="aksiDropdown{{ $loop->iteration }}">
                                    <span class="mr-2">Aksi</span>
                                    <i class="bi bi-chevron-down"></i>
                                </button>

                                {{-- dropdown --}}
                                <template x-if="opendropdown">

                                    <div id="modalSK" x-cloak x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                        x-transition:leave="transition ease-in duration-300"
                                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                        class="z-10 bg-white divide-y divide-gray-100 rounded shadow w-24 absolute right-0 mt-2">
                                        <ul class="text-sm py-1 text-slate-700 m-2">
                                            <li>
                                                <a class="block px-[1px] py-[1px] rounded hover:bg-gray-100"
                                                    href="{{ route('beasiswa.show', $item->id) }}">
                                                    <span class="mr-1"><ion-icon
                                                            name="information-circle"></ion-icon></span>
                                                    Detail
                                                </a>
                                            </li>

                                            <li class="hover:bg-gray-100 rounded block px-[1px] py-[1px] ">
                                                <div x-data="{ openmodalSK: false }" x-cloak>
                                                    <button @click="openmodalSK = true"
                                                        class="block px-[1px] py-[1px] rounded text-sm  hover:text-blue-600">
                                                        <span class="mr-1"><ion-icon name="Document"></ion-icon></span>
                                                        Atur SK
                                                    </button>
                                                    <!-- Modal SK Kelulusan -->
                                                    <template x-if="openmodalSK">
                                                        <div id="modalSK" x-cloak
                                                            x-transition:enter="ease-out duration-300"
                                                            x-transition:enter-start="opacity-0 scale-90"
                                                            x-transition:enter-end="opacity-100 scale-100"
                                                            x-transition:leave="ease-in duration-300"
                                                            x-transition:leave-start="opacity-100 scale-100"
                                                            x-transition:leave-end="opacity-0 scale-90">
                                                            <div id="modalSK" x-cloak>
                                                                <div
                                                                    class="fixed top-0 left-32 w-full h-screen bg-black/50 flex justify-center items-center">
                                                                    <div
                                                                        class="p-10 w-1/2 bg-white rounded-lg border border-x-gray-200 shadow-md">
                                                                        <h2
                                                                            class="mb-2 text-2xl font-bold text-gray-800 text-center">
                                                                            Atur SK Kelulusan
                                                                        </h2>
                                                                        <form
                                                                            action="{{ route('beasiswa.updateSK', $item->id) }}"
                                                                            method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <!-- Tabel -->
                                                                            <div>
                                                                                <div class="text-lg">
                                                                                    <div class="mb-3">
                                                                                        <span class="font-bold">Nama
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
                                                                                        {{ $item->duration }} Bulan
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <span class="font-bold">Akhir
                                                                                            Pendaftaran Beasiswa</span>
                                                                                        {{ $item->end_regis_at->format('d-m-Y') }}
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <span class="font-bold">Akhir
                                                                                            Seleksi
                                                                                            Beasiswa</span>
                                                                                        {{ $item->end_graduation_at->format('d-m-Y') }}
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <span
                                                                                            class="font-bold">Nominal</span>
                                                                                        Rp {{ $item->value }} /
                                                                                        {{ $item->status_value }}
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <span class="font-bold">Nomor Surat
                                                                                            Keputusan Kelulusan</span>
                                                                                        <input type="text" name="no_sk"
                                                                                            value="{{ $item->no_sk ?? '' }}"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <span class="font-bold">Dokumen
                                                                                            Surat
                                                                                            Keputusan Kelulusan</span>
                                                                                        <input type="file" name="file_sk"
                                                                                            value="{{ $item->file_sk }}"
                                                                                            class="form-control">
                                                                                        @if ($item->file_sk)
                                                                                            <p>Dokumen sudah diupload</p>
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <span class="font-bold">Tanggal
                                                                                            Mulai
                                                                                            Berlaku Beasiswa</span>
                                                                                        <input type="date"
                                                                                            name="start_scholarship"
                                                                                            value="{{ $item->start_scholarship ? $item->start_scholarship->format('Y-m-d') : '' }}"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <span class="font-bold">Tanggal
                                                                                            Akhir
                                                                                            Berlaku Beasiswa</span>
                                                                                        <input type="date"
                                                                                            name="end_scholarship"
                                                                                            value="{{ $item->end_scholarship ? $item->end_scholarship->format('Y-m-d') : '' }}"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Tombol Simpan dan Batal -->
                                                                            <button
                                                                                class="text-white bg-blue-500 hover:bg-blue-700 font-medium rounded-lg text-base px-4 py-2.5"
                                                                                type="submit">Simpan</button>
                                                                            <button @click="openmodalSK = false"
                                                                                class="text-white bg-red-500 hover:bg-red-700 font-medium rounded-lg text-base px-4 py-2.5">Batal</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </template>
                                                </div>
                                            </li>

                                            <li>
                                                <a class="block px-[1px] py-[1px] rounded hover:bg-gray-100"
                                                    href="{{ route('beasiswa.edit', $item->id) }}">
                                                    <span class="mr-1"><ion-icon name="create"></ion-icon></span>
                                                    Edit
                                                </a>
                                            </li>
                                            <li class="hover:bg-gray-100 rounded block px-[1px] py-[1px] ">
                                                <form onsubmit="return confirm('Yakin mau hapus data ini?')"
                                                    action="{{ route('beasiswa.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="block px-[1px] py-[1px] rounded text-sm text-red-500 hover:text-red-600">
                                                        <span class="mr-1"><ion-icon name="trash"></ion-icon></span>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </template>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
