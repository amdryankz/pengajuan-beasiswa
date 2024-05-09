@extends('admin.dashboard')

@section('navbar', 'Beranda')

@section('content')
    <div class="flex justify-center items-start h-screen">
        <div class="flex flex-wrap justify-center gap-6">
            <!-- Chart: Mahasiswa Aktif, Alumni, dan Beasiswa -->
            <div class="bg-white p-10 shadow-md m-6 rounded-3xl w-auto">
                <h2 class="text-xl mb-4 text-center border-b pb-2">Data Mahasiswa Aktif, Alumni, dan Beasiswa</h2>
                <canvas id="combinedChart" width="800" height="300"></canvas>
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

        // elemen canvas untuk Chart
        let combinedCtx = document.getElementById('combinedChart').getContext('2d');

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
    </script>
@endsection
