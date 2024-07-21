<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>

    <!-- Pustaka ikon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css">

    <!-- Gaya khusus -->
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin') }}/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/vendors/base/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/css/style.css">
    <link rel="shortcut icon" href="{{ asset('admin') }}/images/favicon.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">

    {{-- alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* CSS untuk mengatur tampilan sidebar pada tampilan mobile */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
                position: fixed;
                top: 0;
                left: 0;
                /* Mengurangi tinggi sidebar */
                height: 10%;
                /* Ubah tinggi sidebar sesuai kebutuhan */
                /* Lebar sidebar ketika dibuka */
                width: 60%;
                /* Tetapkan lebar sidebar sesuai kebutuhan */
                z-index: 999;
                background-color: white;
            }

            .menu-btn {
                display: block;
                /* Tampilkan tombol menu di mobile */
                position: fixed;
                top: 10px;
                left: 10px;
                z-index: 1000;
                background-color: transparent;
                border: none;
                outline: none;
            }

            .content {
                transition: margin-left 0.3s;
                /* Animasi pergeseran konten utama */
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .content.shift-right {
                margin-left: 60%;
                /* Geser konten utama saat sidebar dibuka */
            }
        }
    </style>
</head>

<body class="bg-gray-200 flex flex-col md:flex-row min-h-screen">

    <!-- Sidebar -->
    <aside x-data="{ open: false }" :class="{ 'open': open }"
        class="sidebar text-gray-800 shadow fixed top-0 left-0 h-full md:h-auto md:relative w-60 bg-white z-50">

        <!-- Logo -->
        <div class="p-2 relative bg-transparent md:block hidden shadow-md border-b-2 border-b-blue-400"
            style="height: 56px; display: flex; align-items: center;">
            <img src="https://upload.wikimedia.org/wikipedia/id/2/27/Unsyiah.svg" alt="Logo"
                class="h-full pl-2 pr-2">
            <span class="text-gray-800 font-bold text-md">BEASISWA USK</span>
        </div>


        <!-- Menu -->
        <div class="p-4">
            <ul class="mt-2 space-y-4">
                <li class="group relative">
                    <a href="{{ url('/mhs/beranda') }}"
                        class="flex items-center rounded-md px-4 py-2 transition duration-300 group-hover:text-blue-600 group-hover:bg-transparent group-hover:border-sky-300 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 @if (request()->is('mhs/beranda')) text-blue-500 @endif">
                        <i
                            class="material-icons mr-2 group-hover:text-blue-500 @if (request()->is('mhs/beranda')) text-blue-500 @endif">home</i>
                        Beranda
                    </a>
                </li>
                <li class="group relative">
                    <a href="{{ url('/mhs/pendaftaran') }}"
                        class="flex items-center rounded-md px-4 py-2 transition duration-300 group-hover:text-blue-600 group-hover:bg-transparent group-hover:border-sky-300 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 @if (request()->is('mhs/pendaftaran')) text-blue-500 @endif">
                        <i
                            class="material-icons mr-2 group-hover:text-blue-500 @if (request()->is('mhs/pendaftaran')) text-blue-500 @endif">assignment</i>
                        Pendaftaran
                    </a>
                </li>
                <li class="group relative">
                    <a href="{{ url('/mhs/biodata') }}"
                        class="flex items-center rounded-md px-4 py-2 transition duration-300 group-hover:text-blue-600 group-hover:bg-transparent group-hover:border-sky-300 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 @if (request()->is('mhs/biodata')) text-blue-500 @endif">
                        <i
                            class="material-icons mr-2 group-hover:text-blue-500 @if (request()->is('mhs/biodata')) text-blue-500 @endif">person</i>
                        Biodata
                    </a>
                </li>
                <li class="group relative">
                    <a href="{{ url('/mhs/logout') }}"
                        class="flex items-center rounded-md px-4 py-2 text-gray-700 transition duration-300 group-hover:text-red-600 group-hover:bg-transparent group-hover:border-pink-300 focus:outline-none focus:border-red-500 focus:ring focus:ring-red-200">
                        <i class="material-icons mr-2 text-gray-700 group-hover:text-red-500">exit_to_app</i> Keluar
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 md:ml-1/5 lg:ml-1/6">

        <!-- Navbar -->
        <nav class="bg-white p-2 py-2 shadow flex items-center justify-between md:pl-6">
            <div class="flex items-center">
                <!-- Hamburger Icon -->
                <button @click="open = !open" class="md:hidden focus:outline-none text-gray-800 menu-btn py-[7px]">
                    <i class="material-icons">menu</i>
                </button>
                <div class="text-gray-800 font-bold ml-10">Dashboard Mahasiswa</div>
            </div>

            <!-- User Info -->
            <div class="flex items-center mr-4">
                <div class="text-slate-600 text-sm">
                    @if (Auth::check())
                        <span class="font-bold">{{ Auth::user()->name }}</span>
                        <span class="font-bold block">{{ Auth::user()->npm }}</span>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="p-10 pt-14">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <div class="card p-6 w-full">
                        <div class="card-body text-base">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk mengatur tampilan sidebar pada tampilan mobile -->
    <script>
        // Ambil elemen sidebar dan tombol menu
        const sidebar = document.querySelector('.sidebar');
        const menuBtn = document.querySelector('.menu-btn');

        // Tambahkan event listener pada tombol menu
        menuBtn.addEventListener('click', () => {
            // Toggle class 'open' pada sidebar
            sidebar.classList.toggle('open');
        });
    </script>

</body>

</html>
