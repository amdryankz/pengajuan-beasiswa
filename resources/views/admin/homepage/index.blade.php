@extends('admin.dashboard')

@section('navbar', 'Beranda')

@section('content')
    <div class="flex justify-center items-start h-screen">
        <div class="flex flex-wrap justify-center gap-6">

            <!-- Card 1 -->
            <div
                class="bg-gradient-to-r from-purple-500 via-blue-500 to-cyan-500 p-8 m-6 rounded-3xl w-80 flex flex-col items-center">
                <i class="bi bi-mortarboard-fill text-white text-4xl mb-4"></i>
                <h2 class="text-white text-xl mb-2 text-center">Mahasiswa Aktif Beasiswa USK Keseluruhan</h2>
                <p class="text-white text-lg text-center">
                    <span class="font-bold text-xl">{{ $totalActive }}</span>
                </p>
            </div>

            <!-- Card 2 -->
            <div
                class="bg-gradient-to-r from-teal-500 via-green-500 to-lime-500 p-8 m-6 rounded-3xl w-80 flex flex-col items-center">
                <i class="bi bi-wallet-fill text-white text-4xl mb-4"></i>
                <h2 class="text-white text-xl mb-2 text-center">Jumlah Beasiswa Keseluruhan</h2>
                <p class="text-white text-lg text-center">
                    <span class="font-bold text-xl">{{ $totalScholarship }}</span>
                </p>
            </div>

            <!-- Card 3 -->
            <div
                class="bg-gradient-to-r from-amber-500 via-orange-500 to-red-500 p-8 m-6 rounded-3xl w-80 flex flex-col items-center">
                <i class="bi bi-bar-chart-fill text-white text-4xl mb-4"></i>
                <h2 class="text-white text-xl mb-2 text-center"> Total Alumni Beasiswa USK</h2>
                <p class="text-white text-lg text-center">
                    <span class="font-bold text-xl">{{ $totalAlumni }}</span>
                </p>
            </div>

            <!-- Table -->
            <div class="w-full m-6">
                <h2 class="text-xl ml-6 mb-4">Jumlah Mahasiswa per Beasiswa</h2>
                <table id="myTable" class="min-w-full bg-white border border-gray-300 text-sm">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-2 px-4 border-b">Nama Beasiswa</th>
                            <th class="py-2 px-4 border-b">Tahun Beasiswa</th>
                            @foreach ($fakultasList as $fakultas)
                                <th class="py-2 px-4 border-b">{{ $fakultas }}</th>
                            @endforeach
                            <th class="py-2 px-4 border-b">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($scholarshipData)
                            @foreach ($scholarshipData as $scholarshipId => $data)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $data['name'] }}</td>
                                    <td class="py-2 px-4 border-b">{{ $data['year'] }}</td>
                                    @foreach ($fakultasList as $fakultas)
                                        <td class="py-2 px-4 border-b">{{ $data['facultyTotals']->get($fakultas, 0) }}</td>
                                    @endforeach
                                    <td class="py-2 px-4 border-b">{{ $data['total'] }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="{{ count($fakultasList) + 3 }}" class="py-2 px-4 border-b text-center">Data
                                    Beasiswa tidak tersedia.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
