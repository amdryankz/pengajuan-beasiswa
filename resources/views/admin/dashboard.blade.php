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
      <script src="//unpkg.com/alpinejs" defer></script>


      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      {{-- <script type="text/javascript">
          $(function() {
              $(document).on('click', '#deleteForm', function(e) {
                  e.preventDefault();
                  var link = $(this).attr("href");

                  Swal.fire({
                      title: "Are you sure?",
                      text: "You won't be able to revert this!",
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#3085d6",
                      cancelButtonColor: "#d33",
                      confirmButtonText: "Yes, delete it!"
                  }).then((result) => {
                      if (result.isConfirmed) {
                          Swal.fire({
                              title: "Deleted!",
                              text: "Your file has been deleted.",
                              icon: "success"
                          });
                      }
                  });
              })
          });
      </script> --}}



      <style>
          @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap");
      </style>

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
  </head>

  @section('navbar', 'Beranda')

  <body class="bg-gray-200">

      <nav class="flex-auto pl-0 pr-0 py-0 px-0 bg-gradient-to-r from-blue-600 to-slate-800 text-white">
          <div class="container mx-auto">
              <div class="pb-2 flex justify-between items-center">
                  <div class="flex flex-row justify-center gap-4 text-base font-poppins">
                      <div class="w-100 h-fit">
                          <img class="w-[165px] pt-4"
                              src="https://beasiswa.usk.ac.id/adm/public/images/logo_beasiswa_admin.png"
                              alt="Logo Beasiswa USK" />
                      </div>
                      <button class="pt-4 pb-1 text-slate-100 text-2xl ">
                          <ion-icon name="chevron-back-circle"></ion-icon>
                      </button>
                      <div class="pt-4 pl-10 text-white text-center text-xl">
                          <h2>
                              @yield('navbar')
                          </h2>
                      </div>

                  </div>
                  <div class="flex pr-4 pt-2">
                      <ion-icon class="pr-2 pt-1 gap-2 text-3xl hidden sm:block"
                          name="person-circle-outline"></ion-icon>
                      <h2 class="font-poppins text-base hidden pt-[6px] sm:block text-white">Hairul R S.T., M.Si.
                      </h2>
                  </div>
              </div>
          </div>
      </nav>

      {{-- sidebar --}}
      <nav id="sidebar" class="absolute left-0 top-15 z-[1035] w-60 h-full overflow-hidden bg-slate-50 shadow-lg"
          data-te-sidenav-init data-te-sidenav-hidden="false" data-te-sidenav-position="absolute">
          <ul class="list-none pt-3 px-2" data-te-sidenav-menu-ref>
              <li class="relative text-slate-800">
                  <a id="beranda" href="{{ url('/adm/dashboard') }}"
                      class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/dashboard') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
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
                      class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/donatur*') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-400' }}"
                      data-te-sidenav-link-ref>
                      <ion-icon class="px-auto text-xl hidden sm:block" name="wallet-sharp"></ion-icon>
                      <span class="pl-2 text-base">Donatur</span>
                  </a>
              </li>

              <li class="relative text-slate-800 mb-1.5">
                  <a id="berkas" href="{{ url('/adm/berkas') }}"
                      class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/berkas*') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                      data-te-sidenav-link-ref>
                      <ion-icon class="px-auto text-xl hidden sm:block" name="documents-sharp"></ion-icon>
                      <span class="pl-2 text-base">Berkas</span>
                  </a>
              </li>

              <li class="relative text-slate-800 mb-1.5">
                  <a id="beasiswa" href="{{ url('/adm/beasiswa') }}"
                      class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/beasiswa*') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                      data-te-sidenav-link-ref>
                      <ion-icon class="px-auto text-xl hidden sm:block" name="create-sharp"></ion-icon>
                      <span class="pl-2 text-base">Beasiswa</span>
                  </a>
              </li>

              <li class="relative text-slate-800 mb-1.5">
                  <a id="konfirmasi" href="{{ url('/adm/registrations') }}"
                      class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/registrations*') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                      data-te-sidenav-link-ref>
                      <ion-icon class="px-auto text-xl hidden sm:block" name="checkmark-sharp"></ion-icon>
                      <span class="pl-2 text-base">Konfirmasi</span>
                  </a>
              </li>


              <li class="relative text-slate-800 mb-1.5">
                  <a id="Upload Khusus" href="{{ url('/adm/#') }}"
                      class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/#') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                      data-te-sidenav-link-ref>
                      <ion-icon class="px-auto text-xl hidden sm:block" name="clipboard-sharp"></ion-icon>
                      <span class="pl-2 text-base">Upload Khusus</span>
                  </a>
              </li>

              <p class="pt-2 pb-2 pl-1 text-slate-500 opacity-50">Laporan</p>

              <li class="relative text-slate-800 mb-1.5">
                  <a id="Upload Khusus" href="{{ url('/adm/#') }}"
                      class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/#') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                      data-te-sidenav-link-ref>
                      <ion-icon class="px-auto text-xl hidden sm:block" name="hand-right-sharp"></ion-icon>
                      <span class="pl-2 text-base">Mahasiswa</span>
                  </a>
              </li>

              <li class="relative text-slate-800 mb-1.5">
                  <a id="Upload Khusus" href="{{ url('/adm/#') }}"
                      class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/#') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                      data-te-sidenav-link-ref>
                      <ion-icon class="px-auto text-xl hidden sm:block" name="school-sharp"></ion-icon>
                      <span class="pl-2 text-base">Kelulusan</span>
                  </a>
              </li>


              <li class="relative text-slate-800 mb-1.5">
                  <a id="Upload Khusus" href="{{ url('/adm/#') }}"
                      class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/#') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
                      data-te-sidenav-link-ref>
                      <ion-icon class="px-auto text-xl hidden sm:block" name="shield-checkmark-sharp"></ion-icon>
                      <span class="pl-2 text-base">Alumni</span>
                  </a>
              </li>

              <p class="pt-2 pb-2 pl-1 text-slate-500 opacity-50">Akun</p>

              <li class="relative text-slate-800 mb-1.5">
                  <a id="Upload Khusus" href="{{ url('/adm/#') }}"
                      class="flex h-10 items-center text-center  px-auto truncate rounded-xl px-[15px] py-[10px] {{ request()->is('adm/#') ? 'bg-blue-600 text-white' : 'hover:text-white hover:bg-blue-500' }}"
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
          </ul>
      </nav>
      {{-- end sidebar --}}



      <div class="flex h-full bg-gray-100">
          <div class="w-[255px] h-[1200px]"></div> <!-- Mengganti ml-[245px] dengan w-[245px] -->
          <div class="w-full mx-auto"> <!-- Mengganti class "main-panel mx-auto" -->
              <div class="p-1">
                  <div class="grid grid-cols-12 gap-4">
                      <div class="col-span-12">
                          <div class="card p-2 w-full">
                              <div class="card-body text-base">
                                  @yield('content')
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>



  </body>

  </html>
