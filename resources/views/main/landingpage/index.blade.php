<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Viga" rel="stylesheet">

    <style>
        .text-background {
            color: white;
            background-size: cover;
            -webkit-background-clip: text;
            background-clip: text;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        html {
            scroll-behavior: smooth;
        }

        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="bg-cover bg-no-repeat sticky top-0 z-50 bg-gray-500">

        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <a class="text-lg font-bold text-white hover:text-black" href="#">Beasiswa USK</a>
                <!-- Dropdown untuk mode mobile -->
                <div class="block lg:hidden">
                    <button id="mobile-menu-btn" class="focus:outline-none focus:shadow-outline" type="button"
                        aria-label="toggle menu">
                        <svg class="h-6 w-6 fill-current text-gray-100" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M20 4H4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zM3 10a1 1 0 0 1 1-1h16a1 1 0 0 1 0 2H4a1 1 0 0 1-1-1zm18 6a1 1 0 0 0-1-1H4a1 1 0 0 0 0 2h16a1 1 0 0 0 1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- /Dropdown untuk desktop -->
                <div class="hidden lg:flex lg:items-center lg:w-auto" id="menu sm:hidden">
                    <a class="text-gray-100 hover:text-blue-600 text-sm font-semibold mx-2 lg:mx-4"
                        href="#">Home</a>
                    <a class="text-gray-100 hover:text-blue-600 text-sm font-semibold mx-2 lg:mx-4"
                        href="#berita">Berita</a>
                    <a class="text-gray-100 hover:text-blue-600 text-sm font-semibold mx-2 lg:mx-4"
                        href="#panduan">Panduan</a>
                    <a class="text-gray-100 hover:text-blue-600 text-sm font-semibold mx-2 lg:mx-4"
                        href="#tentang">Tentang</a>
                    <a class="text-gray-100 hover:text-blue-600 text-sm font-semibold mx-2 lg:mx-4"
                        href="#kontak">Kontak</a>
                    <a class="bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700 text-sm font-semibold py-2 px-4 rounded-md mx-2 lg:mx-4"
                        href="{{ route('loginUser') }}">Login</a>
                </div>
            </div>
            <!-- Dropdown menu untuk mode mobile -->
            <div class="lg:hidden" id="dropdown-menu">
                <div class="absolute top-12 right-0 mr-4 bg-gray-200 rounded-md shadow-lg w-40">
                    <a class="block px-4 py-2 bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700"
                        href="#">Home</a>
                    <a class="block px-4 py-2 bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700"
                        href="#berita">Berita</a>
                    <a class="block px-4 py-2 bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700"
                        href="#panduan">Panduan</a>
                    <a class="block px-4 py-2 bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700"
                        href="#tentang">Tentang</a>
                    <a class="block px-4 py-2 bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700"
                        href="#kontak">Kontak</a>
                    <a class="block px-4 py-2 bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700"
                        href="{{ route('loginUser') }}">Login</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- akhir Navbar -->

    <!-- Jumbotron -->
    <div class="py-72 parallax bg-cover bg-center bg-no-repeat"
        style="background-image: url('https://images.unsplash.com/photo-1590012314607-cda9d9b699ae?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl font-bold leading-tight text-background">Selamat Datang <span> di </span>
                    <br>Beasiswa <span> Universitas </span> Syiah Kuala
                </h1>
            </div>
        </div>
    </div>
    <!-- akhir Jumbotron -->


    <!-- Container Pengumuman dan Berita -->
    <div id="berita" class="py-10 parallax bg-cover bg-center bg-no-repeat"
        style="background-image: url('https://images.unsplash.com/photo-1590012314607-cda9d9b699ae?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
        <div class="container mx-auto px-4">

            <!-- Grid Berita -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pb-6">
                @foreach ($data as $index => $announcement)
                    <!-- Item Berita -->
                    <div
                        class="flex flex-col bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-1 {{ $index >= 6 ? 'hidden' : '' }} news-item">
                        <!-- Gambar Berita -->
                        <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}"
                            class="w-full h-48 object-cover rounded-t-lg">
                        <!-- Detail Berita -->
                        <div class="p-6 flex flex-col justify-between flex-grow">
                            <!-- Judul Berita -->
                            <h4 class="text-lg font-semibold mb-2">{{ $announcement->title }}</h4>
                            <!-- Tanggal Berita -->
                            <p class="text-sm text-gray-600 mb-4">Tanggal:
                                {{ $announcement->created_at->format('d M Y') }}
                            </p>
                            <!-- Tombol Baca Selengkapnya -->
                            <a href="{{ url('/' . $announcement->slug) }}"
                                class="text-blue-500 hover:underline self-end">Baca Selengkapnya</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End Grid Berita -->

            <!-- Buttons to Toggle News View -->
            @if (count($data) > 6)
                <div class="text-center mt-4">
                    <button id="showMoreButton"
                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-300">Lihat
                        Semua Berita</button>
                    <button id="showLessButton"
                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-300 hidden">Lihat
                        Sebagian Berita</button>
                </div>
            @endif
        </div>
    </div>
    <!-- End Container -->


    <!-- Panduan Section -->
    <div id="panduan" class="py-10 parallax bg-black bg-cover bg-center bg-no-repeat"
        style="background-image: url('https://images.unsplash.com/photo-1522252234503-e356532cafd5');">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center bg-white bg-opacity-75 rounded-lg shadow-lg p-8">
                <div class="md:w-1/2 mb-6 md:mb-0 md:pr-6 transition-transform duration-300 transform hover:scale-105">
                    <img src="https://images.unsplash.com/photo-1522252234503-e356532cafd5" alt="Panduan Beasiswa"
                        class="w-full rounded-lg">
                </div>
                <div class="md:w-1/2">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Panduan Mendaftar Beasiswa</h2>
                    <p class="text-xl text-gray-700 mb-4">Berikut adalah panduan langkah-langkah untuk mahasiswa
                        yang ingin mendaftar beasiswa:</p>
                    <ol class="list-decimal pl-6 mb-4 text-lg">
                        <li class="mb-2"><span class="font-semibold">Persiapan:</span> Siapkan dokumen-dokumen
                            yang diperlukan dengan melihat syarat dan ketentuan pada beasiswa yang ingin anda
                            daftar.</li>
                        <li class="mb-2"><span class="font-semibold">Pendaftaran:</span> Lengkapi biodata
                            mahasiswa pada halaman profil dan lengkapi formulir pendaftaran yang tersedia di halaman
                            pendaftaran beasiswa.</li>
                        <li class="mb-2"><span class="font-semibold">Seleksi:</span> Ikuti proses seleksi yang
                            mencakup tes tertulis, wawancara, atau evaluasi kriteria tertentu.</li>
                        <li class="mb-2"><span class="font-semibold">Pengumuman:</span> Tunggu pengumuman
                            penerimaan beasiswa dari pihak penyelenggara.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Tentang Section -->
    <div id="tentang" class="py-10 parallax bg-black bg-cover bg-center bg-no-repeat"
        style="background-image: url('https://images.unsplash.com/photo-1516979187457-637abb4f9353?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center bg-white bg-opacity-75 rounded-lg shadow-lg p-8">
                <div class="md:w-1/2">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tentang Beasiswa USK</h2>
                    <p class="text-lg text-gray-700 mb-4">Beasiswa USK adalah program beasiswa yang diselenggarakan
                        oleh Universitas Syiah Kuala (USK) untuk mendukung mahasiswa dalam menyelesaikan pendidikan
                        mereka.</p>
                    <p class="text-lg text-gray-700 mb-4">Program ini bertujuan untuk memberikan kesempatan kepada
                        mahasiswa yang memiliki potensi akademik dan kebutuhan finansial untuk meraih prestasi
                        akademik dan mengembangkan diri secara maksimal tanpa terkendala oleh biaya pendidikan.</p>
                </div>

                <div class="md:w-1/2 mb-6 md:mb-0 md:pl-6 transition-transform duration-300 transform hover:scale-105">
                    <img src="https://images.unsplash.com/photo-1457369804613-52c61a468e7d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Tentang Beasiswa USK" class="w-full rounded-lg">
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Kontak Section -->
    <div id="kontak" class="parallax bg-cover bg-center bg-no-repeat bg-gray-500">
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-6 text-white text-center">Informasi Kontak</h2>
            <div class="text-center text-white">
                <p><span class="font-semibold"></span> Jln. Teuku Nyak Arief
                    Darussalam, Banda Aceh, Aceh, 23111
                    INDONESIA</p>
                <p><span class="font-semibold">Hotline:</span> 081313223</p>
                <p><span class="font-semibold">Email:</span> kemahasiswaan@usk.ac.id</p>
            </div>
        </div>

        <footer class="text-white py-4">
            <div class="container mx-auto px-4 text-center w-full">
                <p>&copy; 2024 Beasiswa USK</p>
                <p> BIDANG KEMAHASISWAAN DAN KEWIRAUSAHAAN</p>
            </div>
        </footer>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"
        integrity="sha384-+0sJN7ix2aW1YO4M/uq33Yfkv88H6mIcsLDOlhXdqOMs6gVzpX4W+GQz7ukz7A2Q" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"
        integrity="sha384-DztxXOtFwn0gHz5ldC4fNcfIE6FqOoflDcJcATz2WkUaZ5q2AifcUnbUa7p4UmDe" crossorigin="anonymous">
    </script>

    <!-- Hamburger -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const dropdownMenu = document.getElementById('dropdown-menu');

            // Sembunyikan dropdown menu saat dokumen dimuat
            dropdownMenu.classList.add('hidden');

            mobileMenuBtn.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });
        });

        document.getElementById('showMoreButton').addEventListener('click', function() {
            const hiddenItems = document.querySelectorAll('.news-item.hidden');
            hiddenItems.forEach(item => item.classList.remove('hidden'));
            document.getElementById('showMoreButton').classList.add('hidden');
            document.getElementById('showLessButton').classList.remove('hidden');
        });

        document.getElementById('showLessButton').addEventListener('click', function() {
            const newsItems = document.querySelectorAll('.news-item');
            newsItems.forEach((item, index) => {
                if (index >= 6) {
                    item.classList.add('hidden');
                }
            });
            document.getElementById('showMoreButton').classList.remove('hidden');
            document.getElementById('showLessButton').classList.add('hidden');
        }); // Button Berita Show More
    </script>

</body>

</html>
