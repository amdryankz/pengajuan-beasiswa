@extends('admin.dashboard')

@section('navbar', 'Beranda')

@section('content')
    <div class="flex justify-center items-start h-screen">
        <div class="flex">
            <!-- Card 1 -->
            <div
                class="bg-gradient-to-r from-purple-500 via-blue-500 to-cyan-500 p-8 m-6 rounded-3xl w-80 flex flex-col items-center">
                <i class="bi bi-mortarboard-fill text-white text-4xl mb-4"></i>
                <h2 class="text-white text-xl mb-2 text-center">Mahasiswa Aktif USK Keseluruhan</h2>
                <p class="text-white text-lg text-center">
                    <span class="font-bold text-xl">1234</span>
                </p>
            </div>


            <!-- Card 2 -->
            <div
                class="bg-gradient-to-r from-teal-500 via-green-500 to-lime-500 p-8 m-6 rounded-3xl w-80 flex flex-col items-center">
                <i class="bi bi-wallet-fill text-white text-4xl mb-4"></i>
                <h2 class="text-white text-xl mb-2 text-center">Jumlah Beasiswa Keseluruhan</h2>
                <p class="text-white text-lg text-center">
                    <span class="font-bold text-xl">29</span>
                </p>
            </div>


            <!-- Card 3 -->
            <div
                class="bg-gradient-to-r from-amber-500 via-orange-500 to-red-500 p-8 m-6 rounded-3xl w-80 flex flex-col items-center">
                <i class="bi bi-bar-chart-fill text-white text-4xl mb-4"></i>
                <h2 class="text-white text-xl mb-2 text-center">Presentase Mahasiswa Aktif USK</h2>
                <p class="text-white text-lg text-center">
                    <span class="font-bold text-xl">28.89%</span>
                </p>
            </div>

        </div>
    </div>
@endsection
