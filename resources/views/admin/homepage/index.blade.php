@extends('admin.dashboard')

@section('navbar', 'Beranda')

@section('content')
    <div class="flex min-h-screen overflow-auto justify-center w-auto">
        <div class="bg-white p-6 shadow-md rounded-md min-w-full">
            <div class="flex mb-6">
                <div class="bg-blue-200 p-1 rounded-sm mb-4 md:mb-0 md:w-1/4 mr-4">
                    <h1 class="text-base font-semibold ml-2">Mahasiswa Aktif</h1>
                    <p class="text-gray-600 text-base ml-2">{{ $totalActive }}</p>
                </div>
                <div class="bg-red-200 p-1 rounded-sm mb-4 md:mb-0 md:w-1/4 mr-4">
                    <h1 class="text-base font-semibold ml-2">Alumni</h1>
                    <p class="text-gray-600 text-base ml-2">{{ $totalAlumni }}</p>
                </div>
                <div class="bg-green-200 p-1 rounded-sm mb-4 md:mb-0 md:w-1/4 mr-4">
                    <h1 class="text-base font-semibold ml-2">Jumlah Fakultas</h1>
                    <p class="text-gray-600 text-base ml-2">12</p>
                </div>
                <div class="bg-yellow-200 p-1 rounded-sm mb-4 md:mb-0 md:w-1/4">
                    <h1 class="text-base font-semibold ml-2">Jumlah Beasiswa</h1>
                    <p class="text-gray-600 text-base ml-2">{{ $totalScholarship }}</p>
                </div>
            </div>

            <div class="pt-6">
                <h2 class="text-xl mb-4 text-center font-medium border-b-4 pb-2">DATA MAHASISWA AKTIF, ALUMNI, DAN BEASISWA
                </h2>
                <div class="mb-6">
                    <canvas id="combinedChart" width="800" height="300"></canvas>
                </div>
                <h2 class="text-xl mb-4 text-center font-medium border-b-4 pb-2">JUMLAH MAHASISWA AKTIF BEASISWA</h2>
                <div>
                    <canvas id="facultyChart" width="800" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data Mahasiswa Aktif, Alumni, dan Beasiswa
        let combinedData = {
            'Mahasiswa Aktif': {{ intval($totalActive) }},
            'Alumni': {{ intval($totalAlumni) }},
            'Jumlah Beasiswa': {{ intval($totalScholarship) }}
        };

        // Data Jumlah Beasiswa per Fakultas
        let facultyData = {
            labels: {!! json_encode($facultyList) !!},
            datasets: [{
                label: 'Jumlah Beasiswa per Fakultas',
                data: {!! json_encode($totalsByFaculty->values()->toArray()) !!},
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1
            }]
        };

        // elemen canvas untuk Chart
        let combinedCtx = document.getElementById('combinedChart').getContext('2d');
        let facultyCtx = document.getElementById('facultyChart').getContext('2d');

        // Gambar Chart
        let combinedChart = new Chart(combinedCtx, {
            type: 'bar',
            data: {
                labels: Object.keys(combinedData),
                datasets: [{
                    label: 'Jumlah',
                    data: Object.values(combinedData),
                    backgroundColor: [
                        'rgba(54, 162, 235, 1)', // Blue for Active Students
                        'rgba(255, 99, 132, 1)', // Red for Alumni
                        'rgba(255, 206, 86, 1)' // Yellow for Scholarships
                    ],
                    borderWidth: 1,
                    barThickness: 50
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
                        callback: function(value) {
                            if (value % 1 === 0) {
                                return value;
                            }
                        }
                    }
                }
            }
        });

        // Gambar Chart Jumlah Beasiswa per Fakultas
        let facultyChart = new Chart(facultyCtx, {
            type: 'line',
            data: facultyData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0,
                        grid: {
                            display: true
                        },
                        callback: function(value) {
                            if (value % 1 === 0) {
                                return value;
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
