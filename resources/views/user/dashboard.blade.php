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
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
      <script src="https://cdn.tailwindcss.com"></script>
      <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
      <script src="//unpkg.com/alpinejs" defer></script>

      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

      {{-- alpine.js --}}
      <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

      <!-- Pengaturan Vite (jika digunakan) -->
      <!-- @vite('resources/css/app.css') -->

      <!-- Alpine.js -->
      <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>



  </head>

  <body class="bg-gray-200 flex">

      <!-- Sidebar -->
      <aside x-data="{ open: false }"
          class="bg-white text-gray-800 shadow w-1/6 fixed h-full transform translate-x-0 overflow-y-auto 
              transition-transform duration-300 flex-none">

          <!-- Logo -->
          <div class="p-2 relative bg-blue-600 ">
              <img src="https://beasiswa.usk.ac.id/adm/public/images/logo_beasiswa_admin.png" alt="Logo"
                  class="w-48 h-auto pl-2">
          </div>

          <!-- Daftar Menu -->
          <div class="p-4">
              <ul class="mt-2 space-y-4">

                  <li class="group relative" :class="{ 'active': isActive('mhs/#') }">
                      <a href="{{ url('/mhs/#') }}"
                          class="flex items-center rounded-md px-4 py-2 transition duration-300 group-hover:text-blue-600 group-hover:bg-transparent group-hover:border-sky-300 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 @if (request()->is('mhs/#')) text-blue-500 @endif">
                          <i
                              class="material-icons mr-2 group-hover:text-blue-500 @if (request()->is('mhs/#')) text-blue-500 @endif">home</i>
                          Beranda
                      </a>
                      <div
                          class="absolute top-0 left-0 h-full border-l-2 border-b-2 transition duration-300 ease-in-out @if (request()->is('mhs/#')) border-blue-500 @endif group-hover:border-blue-500">
                      </div>
                  </li>

                  <li class="group relative" :class="{ 'active': isActive('mhs/dashboard') }">
                      <a href="{{ url('/mhs/dashboard') }}"
                          class="flex items-center rounded-md px-4 py-2 transition duration-300 group-hover:text-blue-600 group-hover:bg-transparent group-hover:border-sky-300 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 @if (request()->is('mhs/dashboard')) text-blue-500 @endif">
                          <i
                              class="material-icons mr-2 group-hover:text-blue-500 @if (request()->is('mhs/dashboard')) text-blue-500 @endif">assignment</i>
                          Pendaftaran
                      </a>
                      <div
                          class="absolute top-0 left-0 h-full border-l-2 border-b-2 transition duration-300 ease-in-out @if (request()->is('mhs/dashboard')) border-blue-500 @endif group-hover:border-blue-500">
                      </div>
                  </li>


                  <li class="group relative" :class="{ 'active': isActive('mhs/biodata') }">
                      <a href="{{ url('/mhs/biodata') }}"
                          class="flex items-center rounded-md px-4 py-2 transition duration-300 group-hover:text-blue-600 group-hover:bg-transparent group-hover:border-sky-300 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 @if (request()->is('mhs/biodata')) text-blue-500 @endif">
                          <i
                              class="material-icons mr-2 group-hover:text-blue-500 @if (request()->is('mhs/biodata0')) text-blue-500 @endif">person</i>
                          Biodata
                      </a>
                      <div
                          class="absolute top-0 left-0 h-full border-l-2 border-b-2 transition duration-300 ease-in-out @if (request()->is('mhs/biodata')) border-blue-500 @endif group-hover:border-blue-500">
                      </div>
                  </li>




                  <li class="group relative">
                      <a href="{{ url('/mhs/logout') }}"
                          class="flex items-center rounded-md px-4 py-2  text-gray-700 transition duration-300 group-hover:text-red-600 group-hover:bg-transparent group-hover:border-pink-300 focus:outline-none focus:border-red-500 focus:ring focus:ring-red-200">
                          <i class="material-icons mr-2 text-gray-700 group-hover:text-red-500">exit_to_app</i> Keluar
                      </a>
                      <div
                          class="absolute top-0 left-0 h-full border-l-2 border-b-2 transition duration-300 ease-in-out @if (request()->is('mhs/logout')) border-blue-500 @endif group-hover:border-red-500">
                      </div>
                  </li>

              </ul>
          </div>
      </aside>

      <!-- Content -->
      <div class="flex-1 ml-60">
          <!-- Navbar -->
          <nav class="bg-white p-2 py-2 shadow flex items-center justify-between">
              <div class="flex items-center">
                  <div class="text-gray-800 font-bold ml-4">Dashboard Mahasiswa</div>
              </div>

              <!-- User Info -->
              <div class="flex items-center mr-4">
                  <div class="text-slate-600 text-sm">
                      @if (Auth::check())
                          <span class="font-bold">
                              {{ Auth::user()->name }}
                          </span>
                          <span class="font-bold block">
                              {{ Auth::user()->nim }}
                          </span>
                      @endif
                  </div>
              </div>

          </nav>

          <div class="p-10 pt-24">
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




      <!-- container-scroller -->

      <!-- plugins:js -->
      <script src="{{ asset('admin') }}/vendors/base/vendor.bundle.base.js"></script>
      <!-- endinject -->
      <!-- Plugin js for this page-->
      <script src="{{ asset('admin') }}/vendors/chart.js/Chart.min.js"></script>
      <script src="{{ asset('admin') }}/vendors/datatables.net/jquery.dataTables.js"></script>
      <script src="{{ asset('admin') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
      <!-- End plugin js for this page-->
      <!-- inject:js -->
      <script src="{{ asset('admin') }}/js/off-canvas.js"></script>
      <script src="{{ asset('admin') }}/js/hoverable-collapse.js"></script>
      <script src="{{ asset('admin') }}/js/template.js"></script>
      <!-- endinject -->
      <!-- Custom js for this page-->
      <script src="{{ asset('admin') }}/js/dashboard.js"></script>
      <script src="{{ asset('admin') }}/js/data-table.js"></script>
      <script src="{{ asset('admin') }}/js/jquery.dataTables.js"></script>
      <script src="{{ asset('admin') }}/js/dataTables.bootstrap4.js"></script>
      <!-- End custom js for this page-->

      <script src="{{ asset('admin') }}/js/jquery.cookie.js" type="text/javascript"></script>
  </body>


  </html>
