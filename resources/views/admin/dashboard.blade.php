    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>Dashboard</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ asset('admin') }}/vendors/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="{{ asset('admin') }}/vendors/base/vendor.bundle.base.css">
        <!-- endinject -->

        <!-- plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('admin') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
        <!-- End plugin css for this page -->

        <!-- inject:css -->
        <link rel="stylesheet" href="{{ asset('admin') }}/css/style.css">
        <!-- endinject -->

        <link rel="shortcut icon" href="{{ asset('admin') }}/images/favicon.png" />


        {{-- <link rel="stylesheet" href="css/style.css" /> --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <script src="https://cdn.tailwindcss.com"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap");
        </style>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />

        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
    </head>

    @section('navbar', 'Beranda')

    <body class="bg-gray-200">

        {{-- sidebar --}}
        <aside id="sidebar" class="fixed left-0 top-16 z-50 w-60 h-full overflow-y-auto bg-slate-50 shadow-lg"
            data-te-sidenav-init data-te-sidenav-hidden="false" data-te-sidenav-position="absolute">
            <ul class="list-none pt-3 px-2" data-te-sidenav-menu-ref>
                @if (Auth::user() && Auth::user()->role)
                    @php $roleName = Auth::user()->role->name; @endphp
                    @switch($roleName)
                        @case('Admin')
                            <li class="relative text-slate-800">
                                <a id="beranda" href="{{ url('/adm/beranda') }}"
                                    class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/beranda') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                                    data-te-sidenav-link-ref>
                                    <span>
                                        <ion-icon class="px-auto text-xl hidden sm:block" name="home-sharp"></ion-icon>
                                    </span>
                                    <span class="pl-2 text-base">Beranda</span>
                                </a>
                            </li>
                            <p class="pt-2 pb-2 pl-1 text-slate-500 opacity-50">Beasiswa</p>
                            <li class="relative text-slate-800 mb-1.5">
                                <a id="donatur" href="{{ url('/adm/donatur') }}"
                                    class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/donatur**') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                                    data-te-sidenav-link-ref>
                                    <ion-icon class="px-auto text-xl hidden sm:block" name="wallet-sharp"></ion-icon>
                                    <span class="pl-2 text-base">Donatur</span>
                                </a>
                            </li>
                            <li class="relative text-slate-800 mb-1.5">
                                <a id="berkas" href="{{ url('/adm/berkas') }}"
                                    class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/berkas**') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                                    data-te-sidenav-link-ref>
                                    <ion-icon class="px-auto text-xl hidden sm:block" name="documents-sharp"></ion-icon>
                                    <span class="pl-2 text-base">Berkas</span>
                                </a>
                            </li>
                            <li class="relative text-slate-800 mb-1.5">
                                <a id="beasiswa" href="{{ url('/adm/beasiswa') }}"
                                    class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/beasiswa*') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                                    data-te-sidenav-link-ref>
                                    <ion-icon class="px-auto text-xl hidden sm:block" name="newspaper-sharp"></ion-icon>
                                    <span class="pl-2 text-base">Beasiswa</span>
                                </a>
                            </li>
                            <li class="relative text-slate-800 mb-1.5">
                                <a id="beasiswa" href="{{ url('/adm/pengelolaan') }}"
                                    class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/pengelolaan*') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                                    data-te-sidenav-link-ref>
                                    <ion-icon class="px-auto text-xl hidden sm:block" name="create-sharp"></ion-icon>
                                    <span class="pl-2 text-base">Pengelolaan</span>
                                </a>
                            </li>
                            <li class="relative text-slate-800 mb-1.5">
                                <a id="beasiswakhusus" href="{{ url('/adm/beasiswa-khusus') }}"
                                    class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/beasiswa-khusus') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                                    data-te-sidenav-link-ref>
                                    <ion-icon class="px-auto text-xl hidden sm:block" name="clipboard-sharp"></ion-icon>
                                    <span class="pl-2 text-base">Beasiswa Khusus</span>
                                </a>
                            </li>
                            <p class="pt-2 pb-2 pl-1 text-slate-500 opacity-50">Laporan</p>
                            <li class="relative text-slate-800 mb-1.5">
                                <a id="pengusul" href="{{ url('/adm/pengusul') }}"
                                    class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/pengusul*') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                                    data-te-sidenav-link-ref>
                                    <ion-icon class="px-auto text-xl hidden sm:block" name="person-add-sharp"></ion-icon>
                                    <span class="pl-2 text-base">Pengusul</span>
                                </a>
                            </li>
                            <li class="relative text-slate-800 mb-1.5">
                                <a id="Kelulusan" href="{{ url('/adm/kelulusan') }}"
                                    class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/kelulusan*') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                                    data-te-sidenav-link-ref>
                                    <ion-icon class="px-auto text-xl hidden sm:block" name="file-tray-full-sharp"></ion-icon>
                                    <span class="pl-2 text-base">Kelulusan</span>
                                </a>
                            </li>
                            <li class="relative text-slate-800 mb-1.5">
                                <a id="berlangsung" href="{{ url('/adm/berlangsung') }}"
                                    class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/berlangsung*') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                                    data-te-sidenav-link-ref>
                                    <ion-icon class="px-auto text-xl hidden sm:block" name="checkmark-circle-sharp"></ion-icon>
                                    <span class="pl-2 text-base">Berlangsung</span>
                                </a>
                            </li>
                            <li class="relative text-slate-800 mb-1.5">
                                <a id="alumni" href="{{ url('/adm/alumni') }}"
                                    class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/alumni*') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                                    data-te-sidenav-link-ref>
                                    <ion-icon class="px-auto text-xl hidden sm:block" name="school-sharp"></ion-icon>
                                    <span class="pl-2 text-base">Alumni</span>
                                </a>
                            </li>
                            <p class="pt-2 pb-2 pl-1 text-slate-500 opacity-50">Akun</p>
                            <li class="relative text-slate-800 mb-1.5">
                                <a id="pengguna" href="{{ url('/adm/akses') }}"
                                    class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/akses*') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                                    data-te-sidenav-link-ref>
                                    <ion-icon class="px-auto text-xl hidden sm:block" name="person-sharp"></ion-icon>
                                    <span class="pl-2 text-base">Pengguna</span>
                                </a>
                            </li>
                            <li class="relative text-slate-800 mb-1.5">
                                <a id="Upload Khusus" href="{{ url('/adm/logout') }}"
                                    class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/logout') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                                    data-te-sidenav-link-ref>
                                    <ion-icon class="px-auto text-xl hidden sm:block" name="log-out-sharp"></ion-icon>
                                    <span class="pl-2 text-base">Logout</span>
                                </a>
                            </li>
                        @break

                        @case('Operator Fakultas Hukum')
                            <li class="relative text-slate-800">
                                <a id="beranda" href="{{ url('/adm/beranda') }}"
                                    class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/beranda') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                                    data-te-sidenav-link-ref>
                                    <span>
                                        <ion-icon class="px-auto text-xl hidden sm:block" name="home-sharp"></ion-icon>
                                    </span>
                                    <span class="pl-2 text-base">Beranda</span>
                                </a>
                            </li>
                            <p class="pt-2 pb-2 pl-1 text-slate-500 opacity-50">Laporan</p>
                            <li class="relative text-slate-800 mb-1.5">
                                <a id="pengusul" href="{{ url('/adm/pengusul') }}"
                                    class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/pengusul*') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                                    data-te-sidenav-link-ref>
                                    <ion-icon class="px-auto text-xl hidden sm:block" name="person-add-sharp"></ion-icon>
                                    <span class="pl-2 text-base">Pengusul</span>
                                </a>
                            </li>
                            <li class="relative text-slate-800 mb-1.5">
                                <a id="Kelulusan" href="{{ url('/adm/kelulusan') }}"
                                    class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/kelulusan*') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                                    data-te-sidenav-link-ref>
                                    <ion-icon class="px-auto text-xl hidden sm:block" name="file-tray-full-sharp"></ion-icon>
                                    <span class="pl-2 text-base">Kelulusan</span>
                                </a>
                            </li>
                            <li class="relative text-slate-800 mb-1.5">
                                <a id="berlangsung" href="{{ url('/adm/berlangsung') }}"
                                    class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/berlangsung*') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                                    data-te-sidenav-link-ref>
                                    <ion-icon class="px-auto text-xl hidden sm:block"
                                        name="checkmark-circle-sharp"></ion-icon>
                                    <span class="pl-2 text-base">Berlangsung</span>
                                </a>
                            </li>
                            <li class="relative text-slate-800 mb-1.5">
                                <a id="alumni" href="{{ url('/adm/alumni') }}"
                                    class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/alumni*') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                                    data-te-sidenav-link-ref>
                                    <ion-icon class="px-auto text-xl hidden sm:block" name="school-sharp"></ion-icon>
                                    <span class="pl-2 text-base">Alumni</span>
                                </a>
                            </li>
                            <p class="pt-2 pb-2 pl-1 text-slate-500 opacity-50">Akun</p>
                            <li class="relative text-slate-800 mb-1.5">
                                <a id="Upload Khusus" href="{{ url('/adm/logout') }}"
                                    class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/logout') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                                    data-te-sidenav-link-ref>
                                    <ion-icon class="px-auto text-xl hidden sm:block" name="log-out-sharp"></ion-icon>
                                    <span class="pl-2 text-base">Logout</span>
                                </a>
                            </li>
                        @break
                    @endswitch
                @endif
            </ul>
        </aside>
        {{-- end sidebar --}}

        {{-- Main content --}}
        <div class="flex-1">
            <nav class="fixed top-0 left-0 w-full bg-gradient-to-r from-blue-600 to-slate-800 text-white z-50">
                <div class="container mx-auto">
                    <div class="pb-2 flex justify-between items-center">
                        <div class="flex flex-row items-center gap-4 text-base font-poppins">
                            <div class="w-100 h-fit">
                                <img class="w-[165px] pt-4"
                                    src="https://beasiswa.usk.ac.id/adm/public/images/logo_beasiswa_admin.png"
                                    alt="Logo Beasiswa USK" />
                            </div>
                            <button class="pt-4 pb-1 text-slate-100 text-2xl">
                                <ion-icon name="chevron-back-circle"></ion-icon>
                            </button>
                            <div class="pt-2 text-white text-center text-xl">
                                <h2 class="whitespace-nowrap overflow-ellipsis overflow-hidden">
                                    @yield('navbar')
                                </h2>
                            </div>
                        </div>
                        <div class="flex pr-4 pt-2 items-center">
                            <ion-icon class="pr-2 pt-1 gap-2 text-3xl hidden sm:block"
                                name="person-circle-outline"></ion-icon>
                            <h2 class="font-poppins text-base hidden pt-[6px] sm:block text-white">
                                @if (Auth::check())
                                    {{ Auth::user()->name }}
                                @endif
                            </h2>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="ml-56 p-12">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <div class="card w-full bg-gray-200 p-6">
                            <div class="card-body text-base">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#facultyFilter').select2();
            });
        </script>

        <script defer>
            $(document).ready(function() {
                var table = $('#myTable').DataTable(); // Inisialisasi objek DataTable

                $('#facultyFilter').on('change', function() {
                    var faculty = $(this).val();
                    table.columns(3).search(faculty)
                .draw(); // Menggunakan variabel table untuk memanipulasi DataTable
                });
            });
        </script>

    </body>

    </html>
