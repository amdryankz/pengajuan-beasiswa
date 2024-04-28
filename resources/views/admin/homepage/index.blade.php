@extends('admin.dashboard')

@section('navbar', 'Beranda')

@section('content')
    <div class="flex justify-center items-start h-screen">
        <div class="flex flex-wrap justify-center gap-6">

            <!-- Card 1 -->
            <div
                class="bg-gradient-to-r from-purple-500 via-blue-500 to-cyan-500 p-8 m-6 rounded-3xl w-64 flex flex-col items-center">
                <i class="bi bi-mortarboard-fill text-white text-4xl mb-4"></i>
                <h2 class="text-white text-xl mb-2 text-center">Mahasiswa Aktif Beasiswa USK Keseluruhan</h2>
                <p class="text-white text-lg text-center">
                    <span class="font-bold text-xl">{{ $totalActive }}</span>
                </p>
            </div>

            <!-- Card 2 -->
            <div
                class="bg-gradient-to-r from-teal-500 via-green-500 to-lime-500 p-8 m-6 rounded-3xl w-64 flex flex-col items-center">
                <i class="bi bi-wallet-fill text-white text-4xl mb-4"></i>
                <h2 class="text-white text-xl mb-2 text-center">Jumlah Beasiswa Keseluruhan</h2>
                <p class="text-white text-lg text-center">
                    <span class="font-bold text-xl">{{ $totalScholarship }}</span>
                </p>
            </div>

            <!-- Card 3 -->
            <div
                class="bg-gradient-to-r from-amber-500 via-orange-500 to-red-500 p-8 m-6 rounded-3xl w-64 flex flex-col items-center">
                <i class="bi bi-bar-chart-fill text-white text-4xl mb-4"></i>
                <h2 class="text-white text-xl mb-2 text-center"> Total Alumni Beasiswa USK</h2>
                <p class="text-white text-lg text-center">
                    <span class="font-bold text-xl">{{ $totalAlumni }}</span>
                </p>
            </div>

            <!-- Table -->
            <div class="w-full m-6 overflow-x-auto">
                <h2 class="text-xl mb-4">Jumlah Mahasiswa per Beasiswa</h2>

                <!-- Pencarian -->
                <div class="mb-4">
                    <label for="search" class="block text-sm font-medium text-gray-700">Cari Beasiswa:</label>
                    <input type="text" id="search" name="search" class="mt-1 p-2 border rounded-md w-full"
                        placeholder="Nama Beasiswa">
                </div>

                <table id="{{-- myTable --}}" class="w-full bg-white border border-gray-300 text-sm">
                    <thead>
                        <tr class="bg-blue-500 text-white">
                            <th class="px-4 py-2 border-b">Nama Beasiswa</th>
                            <th class="px-4 py-2 border-b">Tahun Beasiswa</th>
                            <th class="px-4 py-2 border-b">Fakultas</th>
                            <th class="px-4 py-2 border-b">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($scholarshipData)
                            @foreach ($scholarshipData as $scholarshipId => $data)
                                @foreach ($facultyList as $faculty)
                                    <tr>
                                        <td class="px-4 py-2 border-b">{{ $data['name'] }}</td>
                                        <td class="px-4 py-2 border-b">{{ $data['year'] }}</td>
                                        <td class="px-4 py-2 border-b">{{ $faculty }}</td>
                                        <td class="px-4 py-2 border-b">{{ $data['facultyTotals']->get($faculty, 0) }}</td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="2" class="px-4 py-2 border-b font-bold">Total</td>
                                    <td class="px-4 py-2 border-b"></td>
                                    <td class="px-4 py-2 border-b font-bold">{{ $data['total'] }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="bg-blue-400 h-4"></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="px-4 py-2 border-b text-center">Data Beasiswa tidak tersedia.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script Pencarian -->
    <script>
        const searchInput = document.getElementById('search');
        const rows = document.querySelectorAll('tbody tr');

        searchInput.addEventListener('input', function() {
            const term = searchInput.value.toLowerCase();
            rows.forEach(row => {
                const name = row.querySelector('td:first-child').textContent.toLowerCase();
                if (name.includes(term)) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection
