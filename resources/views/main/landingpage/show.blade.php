<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengumuman</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Viga" rel="stylesheet">
    <!-- Bootstap Icon -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-cover bg-center bg-no-repeat sticky top-0 z-50"
        style="background: linear-gradient(135deg, #3a7bd5 0%, #3a6073 100%);">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <a class="text-lg font-bold text-white hover:text-black" href="{{ url('/') }}">Beasiswa USK</a>
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
                    <a class="text-gray-100 text-sm font-semibold mx-2 lg:mx-4" href="{{ url('/') }}">Home</a>
                    <a class="text-gray-100 text-sm font-semibold mx-2 lg:mx-4" href="{{ url('/#berita') }}">Berita</a>
                    <a class="text-gray-100 text-sm font-semibold mx-2 lg:mx-4"
                        href="{{ url('/#panduan') }}">Panduan</a>
                    <a class="text-gray-100 text-sm font-semibold mx-2 lg:mx-4" href="{{ url('/#kontak') }}">Kontak</a>
                    <a class="bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700 text-sm font-semibold py-2 px-4 rounded-md mx-2 lg:mx-4"
                        href="{{ route('loginUser') }}">Login</a>
                </div>
            </div>
            <!-- Dropdown menu untuk mode mobile -->
            <div class="lg:hidden" id="dropdown-menu">
                <div class="absolute top-12 right-0 mr-4 bg-gray-200 rounded-md shadow-lg w-40">
                    <a class="block px-4 py-2 bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700"
                        href="{{ url('/') }}">Home</a>
                    <a class="block px-4 py-2 bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700"
                        href="{{ url('/#berita') }}">Berita</a>
                    <a class="block px-4 py-2 bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700"
                        href="{{ url('/#panduan') }}">Panduan</a>
                    <a class="block px-4 py-2 bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700"
                        href="{{ url('/#kontak') }}">Kontak</a>
                    <a class="block px-4 py-2 bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700"
                        href="{{ route('loginUser') }}">Login</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- akhir Navbar -->

    <!-- Container -->
    <div class="container mx-auto px-4 mt-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $pengumuman->title }}</h1>
            <img src="{{ asset('storage/' . $pengumuman->image) }}" alt="{{ $pengumuman->title }}"
                width="{{ $pengumuman->image_width }}" height="{{ $pengumuman->image_height }}"
                class="mx-auto my-auto object-contain mb-4">
            <div class="flex justify-start items-start mb-4 text-gray-600">
                <p><i
                        class="bi bi-calendar2-date mr-2"></i>{{ \Carbon\Carbon::parse($pengumuman->created_at)->locale('id')->isoFormat('dddd') }},
                    <span
                        class="font-medium">{{ \Carbon\Carbon::parse($pengumuman->created_at)->format('d M Y') }}</span>
                </p>
                <p class="ml-4"><i class="bi bi-card-text mr-1"></i> Nomor: <span
                        class="font-medium">{{ $pengumuman->letter_number }}</span></p>
            </div>
            <div class="text-gray-800 leading-relaxed">
                {!! $pengumuman->content !!}
            </div>
            <a href="{{ url('/') }}" class="text-blue-500 hover:underline mt-4 block">Kembali ke Beranda</a>
        </div>
    </div>
    <!-- End Container -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"
        integrity="sha384-+0sJN7ix2WkUaZ5q2AifcUnbUa7p4UmDe" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"
        integrity="sha384-DztxXOtFwn0gHz5ldC4FNcfIE6FqOoflDcJcATz2WkUaZ5q2AifcUnbUa7p4UmDe" crossorigin="anonymous">
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
    </script>

</body>

</html>
