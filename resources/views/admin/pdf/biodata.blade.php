 <div class="mb-4 text-start text-lg">
     <a href="{{ route('registrations.index') }}"
         class="inline-flex items-start px-2 py-1 text-blue-600 hover:bg-blue-100 rounded-lg">
         <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
         </svg>
     </a>
 </div>
 <div class="flex justify-center items-center">
     <div class="bg-white p-8 rounded-lg ring-2 ring-gray-600 shadow-md w-full max-w-3xl">
         <h1 class="text-3xl font-bold mb-4">Detail Pendaftaran Beasiswa</h1>

         <p class="mb-2 text-base">Nama Mahasiswa: {{ $user->name }}</p>
         <p class="mb-2 text-base">NIM: {{ $user->nim }}</p>
         <p class="mb-2 text-base">Prodi: {{ $user->prodi }}</p>
         <p class="mb-4 text-base">Nama Beasiswa: {{ $scholarship->name }}</p>
     </div>
 </div>
