<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Viga" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

    <nav class="bg-cover bg-center bg-no-repeat sticky top-0 z-50"
        style="background-image: url('https://source.unsplash.com/random/1920x1080/?blue');">
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
                    <a class="text-gray-100 text-sm font-semibold mx-2 lg:mx-4" href="#">Home</a>
                    <a class="text-gray-100 text-sm font-semibold mx-2 lg:mx-4" href="#berita">Berita</a>
                    <a class="text-gray-100 text-sm font-semibold mx-2 lg:mx-4" href="#">Features</a>
                    <a class="text-gray-100 text-sm font-semibold mx-2 lg:mx-4" href="#">About</a>
                    <a class="bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700 text-sm font-semibold py-2 px-4 rounded-md mx-2 lg:mx-4"
                        href="{{ route('loginUser') }}">Login</a>
                </div>
            </div>
            <!-- Dropdown menu untuk mode mobile -->
            <div class="lg:hidden" id="dropdown-menu">
                <div class="absolute top-12 right-0 mr-4 bg-gray-200 rounded-md shadow-lg w-40">
                    <a class="block px-4 py-2 bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700" href="#">Home</a>
                    <a class="block px-4 py-2 bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700" href="#berita">Berita</a>
                    <a class="block px-4 py-2 bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700" href="#">Features</a>
                    <a class="block px-4 py-2 bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700" href="#">About</a>
                    <a class="block px-4 py-2 bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700" href="{{ route('loginUser') }}">Login</a>
                </div>
            </div>


    </nav>
    <!-- akhir Navbar -->

    <!-- Jumbotron -->
    <div class="py-48 bg-cover bg-center bg-no-repeat"
        style="background-image: url('https://source.unsplash.com/random/1920x1080/?blue');">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl font-bold leading-tight text-white">Get work done <span
                        class="text-blue-600">faster</span>
                    <br>and <span class="text-blue-600">better</span> with us
                </h1>
                {{-- <a href="{{ route('loginUser') }}"
                    class="bg-blue-100 hover:bg-blue-600 hover:text-white text-blue-700 font-semibold text-lg py-3 px-8 rounded-full mt-8 inline-block">Login
                    Mahasiswa</a> --}}
            </div>
        </div>
    </div>
    <!-- akhir Jumbotron -->

    <!-- container -->
    <div class="container mx-auto px-4">

        <!-- Title -->
        <h2 id="berita"
            class="text-xl font-semibold font-serif tracking-wide transition duration-500 ease-in-out mt-10 mb-2 text-center border-b border-gray-400 pb-2">
            BERITA BEASISWA</h2>

        <!-- info panel -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Berita 1 -->
            <div
                class="flex items-center bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <img src="https://source.unsplash.com/random/400x400/?scholar" alt="Scholar" class="w-16 h-16 mr-6">
                <div>
                    <h4 class="text-lg font-semibold">24 Hours</h4>
                    <p class="text-gray-700">Lorem ipsum dolor sit amet.</p>
                </div>
            </div>


            <!-- Berita 2 -->
            <div
                class="flex items-center bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <img src="https://source.unsplash.com/random/400x400/?student" alt="Student" class="w-16 h-16 mr-6">
                <div>
                    <h4 class="text-lg font-semibold">High-Res</h4>
                    <p class="text-gray-700">Lorem ipsum dolor sit amet.</p>
                </div>
            </div>

            <!-- Berita 3 -->
            <div
                class="flex items-center bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <img src="https://source.unsplash.com/random/400x400/?security" alt="Security" class="w-16 h-16 mr-6">
                <div>
                    <h4 class="text-lg font-semibold">Security</h4>
                    <p class="text-gray-700">Lorem ipsum dolor sit amet.</p>
                </div>
            </div>

            {{-- Berita 4 --}}
            <div
                class="flex items-center bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <img src="https://source.unsplash.com/random/400x400/?alert" alt="Alert" class="w-16 h-16 mr-6">
                <div>
                    <h4 class="text-lg font-semibold">Alert</h4>
                    <p class="text-gray-700">Lorem ipsum dolor sit amet.</p>
                </div>
            </div>

            {{-- Berita 5 --}}
            <div
                class="flex items-center bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <img src="https://source.unsplash.com/random/400x400/?campus" alt="" class="w-16 h-16 mr-6">
                <div>
                    <h4 class="text-lg font-semibold">Title</h4>
                    <p class="text-gray-700">Lorem ipsum dolor sit amet.</p>
                </div>
            </div>

            {{-- Berita 6 --}}
            <div
                class="flex items-center bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <img src="https://source.unsplash.com/random/400x400/?cars" alt="" class="w-16 h-16 mr-6">
                <div>
                    <h4 class="text-lg font-semibold">Title</h4>
                    <p class="text-gray-700">Lorem ipsum dolor sit amet.</p>
                </div>
            </div>

            {{-- Berita 7 --}}
            <div
                class="flex items-center bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <img src="https://source.unsplash.com/random/400x400/?worldcup" alt="" class="w-16 h-16 mr-6">
                <div>
                    <h4 class="text-lg font-semibold">Title</h4>
                    <p class="text-gray-700">Lorem ipsum dolor sit amet.</p>
                </div>
            </div>

            {{-- Berita 8 --}}
            <div
                class="flex items-center bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <img src="https://source.unsplash.com/random/400x400/?cristiano" alt=""
                    class="w-16 h-16 mr-6">
                <div>
                    <h4 class="text-lg font-semibold">Title</h4>
                    <p class="text-gray-700">Lorem ipsum dolor sit amet.</p>
                </div>
            </div>

            {{-- Berita 9 --}}
            <div
                class="flex items-center bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <img src="https://source.unsplash.com/random/400x400/?messi" alt="" class="w-16 h-16 mr-6">
                <div>
                    <h4 class="text-lg font-semibold">Title</h4>
                    <p class="text-gray-700">Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
        </div>
        <!-- end info panel -->

    </div>
    <!-- end container -->


    </div>
    <!-- end container -->

    {{-- <!-- Workingspace -->
        <div class="flex flex-col md:flex-row mt-20 md:items-center md:justify-between">
            <div class="md:w-1/2">
                <img src="https://source.unsplash.com/random/800x600/?graduation" alt="graduation" class="w-full">
            </div>
            <div class="md:w-1/2 mt-8 md:mt-0 md:pl-8"> <!-- Menambahkan padding kiri pada mode desktop -->
                <h2 class="text-3xl font-bold leading-tight mb-4">You <span class="text-blue-500">Work</span> Like at
                    <span class="text-blue-500">Home</span>
                </h2>
                <p class="text-gray-700">Bekerja dengan suasana hati yang lebih asik, menyenangkan dan mempelajari hal
                    baru setiap harinya.</p>
                <a href="#"
                    class="bg-red-500 hover:bg-red-600 text-white font-semibold text-lg py-3 px-8 rounded-full mt-8 inline-block">Gallery</a>
            </div>
        </div>

        <!-- akhir Workingspace -->

        <!-- Testimonial -->
        <section class="mt-20 mb-20">
            <div class="text-center">
                <p class="text-lg font-semibold text-gray-800">"Bekerja dengan suasana hati yang lebih asik dan
                    mempelajari hal baru setiap harinya."</p>
            </div>
            <div class="flex justify-center mt-8">
                <img src="https://source.unsplash.com/random/100x100/?person" alt="Testimonial 1"
                    class="w-16 h-16 mr-4">
                <img src="https://source.unsplash.com/random/200x200/?person" alt="Testimonial 2"
                    class="w-32 h-32 mx-4">
                <img src="https://source.unsplash.com/random/100x100/?person" alt="Testimonial 3"
                    class="w-16 h-16 ml-4">
            </div>
        </section>
        <!-- akhir Testimonial --> --}}

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-4 mt-60">
        <div class="container mx-auto px-4 text-center w-full">
            <p>&copy; 2024 Your Company. All rights reserved.</p>
        </div>
    </footer>
    <!-- End of Footer -->

    </div>
    <!-- akhir container -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"
        integrity="sha384-+0sJN7ix2aW1YO4M/uq33Yfkv88H6mIcsLDOlhXdqOMs6gVzpX4W+GQz7ukz7A2Q" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"
        integrity="sha384-DztxXOtFwn0gHz5ldC4fNcfIE6FqOoflDcJcATz2WkUaZ5q2AifcUnbUa7p4UmDe" crossorigin="anonymous">
    </script>

    {{-- Hamburger --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const dropdownMenu = document.getElementById('dropdown-menu');

            mobileMenuBtn.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
                dropdownMenu.classList.toggle('block');
            });
        });
    </script>

</body>

</html>
