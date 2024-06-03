@extends('admin.dashboard')

@section('navbar', 'Detail Beasiswa Khusus')

@section('content')

    <div class="bg-white rounded-lg shadow-md p-8">
        <a href="{{ route('pengelolaan-khusus.index') }}"
            class="inline-flex items-start px-2 py-1 mb-4 text-blue-600 hover:bg-blue-100 rounded-lg">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-4xl font-semibold mb-8">Detail Beasiswa</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h2 class="text-2xl font-semibold mb-4">Informasi Beasiswa</h2>
                <ul class="list-disc list-inside text-lg">
                    <li><span class="font-semibold">Nama Beasiswa:</span> {{ $beasiswa->scholarship->name }}</li>
                    <li><span class="font-semibold">Tahun:</span> {{ $beasiswa->year }}</li>
                    <li><span class="font-semibold">Jumlah:</span> Rp {{ number_format($beasiswa->amount, 0, ',', '.') }}
                    </li>

                    <li><span class="font-semibold">Durasi:</span> {{ $beasiswa->duration }} {{ $beasiswa->amount_period }}
                    </li>
                    <li><span class="font-semibold">Mulai Beasiswa:</span>
                        {{ \Carbon\Carbon::parse($beasiswa->start_scholarship)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}
                    </li>
                    <li><span class="font-semibold">Selesai Beasiswa:</span>
                        {{ \Carbon\Carbon::parse($beasiswa->end_scholarship)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection
