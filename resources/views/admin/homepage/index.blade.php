@extends('admin.dashboard')

@section('navbar', 'Beranda')

@section('content')
    <div class="flex justify-center items-start h-screen">
        <div class="flex flex-wrap justify-center">

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

            <div class="w-full m-6">
                <h2 class="text-2xl mb-4">Jumlah Aktif Mahasiswa per Beasiswa</h2>
                <table id="myTable" class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Beasiswa</th>
                            <th class="border border-gray-300 px-4 py-2">Tahun</th>
                            <th class="border border-gray-300 px-4 py-2">Jumlah Mahasiswa Aktif</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($totalActiveByScholarship as $scholarship)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $scholarship->scholarship->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $scholarship->year }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $scholarship->users_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
