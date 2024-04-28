@extends('admin.dashboard')

@section('navbar', 'Beasiswa')

@section('content')
    <div class="mb-4 text-start bg-white p-4">
        <a href="{{ route('pengelolaan.index') }}"
            class="inline-flex items-start px-2 py-1 mb-4 text-blue-600 hover:bg-blue-100 rounded-lg">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <form action="{{ route('pengelolaan.store') }}" method="POST" class="grid grid-cols-2 gap-4">
            @csrf
            {{-- kiri --}}
            <div class="col-span-1">
                <div class="mb-4">
                    <label for="scholarships_id" class="mb-1 ml-1 block text-sm font-medium text-gray-600">Pilih
                        Beasiswa</label>
                    <select
                        class="form-select w-full px-3 py-2 border-1 border-solid border-neutral-200 rounded-md focus:border-sky-500 outline-none text-sm"
                        name="scholarships_id" id="scholarships_id">
                        <option value="" disabled selected class="text-gray-600 hidden">Nama Beasiswa</option>
                        @foreach ($data as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="donors_id" class="mb-1 ml-1 block text-sm font-medium text-gray-600">Nama Donatur</label>
                    <select
                        class="form-select w-full px-3 py-2 border-1 border-solid border-neutral-200 rounded-md focus:border-sky-500 outline-none text-sm"
                        name="donors_id" id="donors_id" disabled>
                        <option value="" class="text-gray-600 hidden">Donatur</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="year" class="mb-1 ml-1 block text-sm font-medium text-gray-600">Tahun</label>
                    <select
                        class="form-select w-full px-3 py-2 border-1 border-solid border-neutral-200 rounded-md focus:border-sky-500 outline-none text-sm"
                        name="year" id="year" required>
                        <option value="" disabled selected class="text-gray-600 hidden">Tahun</option>
                        @foreach ($tahunArray as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="amount" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Nominal</label>
                    <input type="text"
                        class="w-full px-3 py-2 placeholder-gray-400 border-solid border-1 border-neutral-200 rounded-md  focus:border-sky-500 text-sm"
                        name="amount" id="amount" placeholder="Nominal" value="{{ old('amount') }}" required>
                </div>

                <div class="mb-4">
                    <label for="amount_period" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Per</label>
                    <select
                        class="form-select w-full px-3 py-2 border-1 border-solid border-neutral-200 rounded-md focus:border-sky-500 outline-none text-sm"
                        name="amount_period" id="amount_period">
                        <option value="" disabled selected class="text-gray-600 hidden">Bulan/Tahun</option>
                        <option value="Bulan">Bulan</option>
                        <option value="Tahun">Tahun</option>
                    </select>
                </div>
            </div>

            {{-- kanan --}}
            <div class="col-span-1">
                <div class="mb-4">
                    <label for="duration" class="mb-1  ml-1 block text-sm font-medium text-gray-600">Durasi</label>
                    <select
                        class="form-select w-full px-3 py-2 border-1 border-solid border-neutral-200 rounded-md focus:border-sky-500 outline-none text-sm"
                        name="duration" id="duration">
                        <option value="" disabled selected class="text-gray-600 hidden">Durasi Beasiswa</option>
                        @for ($i = 1; $i <= 48; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-4">
                    <label for="start_registration_at" class="block text-sm font-medium text-gray-600 mb-1">
                        Mulai Pendaftaran Beasiswa
                    </label>
                    <input type="date" id="start_registration_at" name="start_registration_at"
                        class="block w-full px-3 py-2 border-1 border-gray-300 rounded-md focus:ring-1 outline-none focus:ring-sky-500 text-sm"
                        value="{{ old('start_registration_at') }}">
                </div>

                <div class="mb-4">
                    <label for="end_registration_at" class="block text-sm font-medium text-gray-600 mb-1">
                        Akhir Pendaftaran Beasiswa
                    </label>
                    <input type="date" id="end_registration_at" name="end_registration_at"
                        class="block w-full px-3 py-2 border-1 border-gray-300 rounded-md focus:ring-1 focus:ring-sky-500 text-sm"
                        value="{{ old('end_registration_at') }}">
                </div>

                <div class="mb-4">
                    <label for="min_ipk" class="block text-sm font-medium text-gray-600 mb-1">
                        Minimal IPK
                    </label>
                    <input type="text" id="min_ipk" name="min_ipk" placeholder="IPK"
                        class="block w-full px-3 py-2 border-1 border-gray-300 rounded-md focus:ring-1 focus:ring-sky-500 text-sm"
                        value="{{ old('min_ipk') }}">
                </div>
            </div>

            {{-- Kuota fakultas --}}
            <div class="mb-4 col-span-2">
                <label class="block text-base font-semibold text-gray-600 mb-2 ml-1">Kuota Fakultas</label>
                <p class="text-sm text-red-400 mb-2 ml-1">
                    <span class="text-red-500">*</span> Isi dengan jumlah kuota yang tersedia untuk setiap fakultas.
                </p>
                <hr class="mb-4 border-t border-gray-300 my-2">
                <div class="grid grid-cols-4 gap-4">
                    @php
                        $facultyList = [
                            'MIPA',
                            'Ekonomi',
                            'Kedokteran',
                            'Hukum',
                            'Teknik',
                            'Pertanian',
                            'Kedokteran Hewan',
                            'Keguruan dan Ilmu Pendidikan',
                            'Keperawatan',
                            'Kedokteran Gigi',
                            'Kelautan dan Perikanan',
                            'Ilmu Sosial dan Politik',
                            'Pascasarjana',
                        ];
                    @endphp
                    @foreach ($facultyList as $faculty)
                        <div class="m-2">
                            <label for="quota_faculty_{{ $loop->index + 1 }}"
                                class="mb-1 ml-1 block text-sm font-medium text-gray-600">{{ $faculty }}</label>
                            <input type="number" name="quota[{{ $faculty }}]"
                                id="quota_faculty_{{ $loop->index + 1 }}"
                                class="px-3 py-2 border-1 border-sky-500 rounded-md focus:ring-2 focus:ring-sky-700 appearance-none text-sm"
                                required placeholder="{{ $faculty }}" value="{{ old('quota.' . $faculty) }}">
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Persyaratan --}}
            <div class="mb-4 col-span-2 text-base">
                <label class="block font-semibold text-gray-600 mb-2 ml-1">Persyaratan</label>
                <hr class="mb-4 border-t-0 border-gray-300 my-2">
                <table id="myTable" class="w-full border-collapse border border-white font-normal text-base">
                    <thead>
                        <tr class="bg-sky-800 text-slate-50">
                            <th class="border border-white px-4 py-2">Nama Persyaratan</th>
                            <th class="border border-white px-4 py-2 text-center">Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($file as $item)
                            <tr
                                class="table-fixed border border-gray-300 @if ($loop->even) @else bg-slate-50 @endif">
                                <td class="border border-slate-100 px-4 py-3 text-base whitespace-pre-wrap">
                                    <div class="max-w-full">
                                        {{ $item->name }}
                                    </div>
                                </td>
                                <td class="border border-slate-100 px-4 py-3 text-center text-base">
                                    <input class="form-checkbox m-0" type="checkbox" name="requirements[]"
                                        value="{{ $item->id }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Save Button --}}
            <div class="mb-4 text-start text-sm col-span-2">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded" name="simpan"
                    type="submit">SIMPAN</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('scholarships_id').addEventListener('change', function() {
            var scholarshipId = this.value;
            var donorSelect = document.getElementById('donors_id');
            donorSelect.innerHTML = '';
            @foreach ($data as $item)
                if ({{ $item->id }} == scholarshipId) {
                    var option = document.createElement('option');
                    option.value = '{{ $item->donors->id }}';
                    option.text = '{{ $item->donors->name }}';
                    donorSelect.add(option);
                }
            @endforeach
        });
    </script>
@endsection
