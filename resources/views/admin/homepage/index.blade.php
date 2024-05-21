@extends('admin.dashboard')

@section('navbar', 'Beranda')

@section('content')
    <div class="flex min-h-screen overflow-auto justify-center w-auto">
        <div class="bg-white p-6 shadow-md rounded-md min-w-full">
            <div class="flex mb-6">
                <div class="bg-blue-200 p-1 rounded-sm mb-4 md:mb-0 md:w-1/4 mr-4">
                    <h1 class="text-base font-semibold ml-2">Penerima Beasiswa</h1>
                    <p class="text-gray-600 text-base ml-2">{{ $totalActive }}</p>
                </div>
                <div class="bg-red-200 p-1 rounded-sm mb-4 md:mb-0 md:w-1/4 mr-4">
                    <h1 class="text-base font-semibold ml-2">Lulusan Penerima Beasiswa</h1>
                    <p class="text-gray-600 text-base ml-2">{{ $totalAlumni }}</p>
                </div>
                <div class="bg-green-200 p-1 rounded-sm mb-4 md:mb-0 md:w-1/4 mr-4">
                    <h1 class="text-base font-semibold ml-2">Jumlah Fakultas</h1>
                    <p class="text-gray-600 text-base ml-2">{{12}}</p>
                </div>
                <div class="bg-yellow-200 p-1 rounded-sm mb-4 md:mb-0 md:w-1/4 mr-4">
                    <h1 class="text-base font-semibold ml-2">Jumlah Beasiswa</h1>
                    <p class="text-gray-600 text-base ml-2">{{ $totalScholarship }}</p>
                </div>
            </div>

            <div class="pt-6">
                <h2 class="text-xl mb-4 text-center font-medium border-b-4 pb-2">Rekapitulasi Mahasiswa Penerima Beasiswa</h2>
                <!-- Filter by faculty -->
                <div class="flex justify-center mb-4">
                    <label for="facultySelect" class="mr-2">Filter Fakultas:</label>
                    <select id="facultySelect" onchange="filterByFaculty()">
                        <option value="">Semua Fakultas</option>
                        @foreach($facultyList as $faculty)
                            <option value="{{ $faculty }}">{{ $faculty }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Chart -->
                <div>
                    <canvas id="facultyChart" width="800" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Original data and labels
        const originalLabels = {!! json_encode(array_keys($totalsByFaculty->toArray())) !!};
        const originalData = {!! json_encode(array_values($totalsByFaculty->toArray())) !!};

        let facultyCtx = document.getElementById('facultyChart').getContext('2d');
        let facultyChart;

        function drawChart(labels, data) {
            facultyChart = new Chart(facultyCtx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Beasiswa per Fakultas',
                        data: data,
                        borderColor: 'rgba(255, 99, 132, 1)', // Warna garis
                        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna latar belakang
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            precision: 0,
                            grid: {
                                display: true
                            },
                            ticks: {
                                callback: function(value) {
                                    if (value % 1 === 0) {
                                        return value;
                                    }
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Menyembunyikan elemen legend
                        }
                    }
                }
            });
        }

        // Initialize chart with original data
        drawChart(originalLabels, originalData);

        function filterByFaculty() {
            let selectedFaculty = document.getElementById('facultySelect').value;
            if (selectedFaculty === '') {
                // Show data for all faculties
                facultyChart.destroy();
                drawChart(originalLabels, originalData);
            } else {
                // Show data for selected faculty
                let filteredLabels = [selectedFaculty];
                let filteredData = [originalData[originalLabels.indexOf(selectedFaculty)] || 0];
                facultyChart.destroy();
                drawChart(filteredLabels, filteredData);
            }
        }
    </script>
@endsection
