
 <div class="flex justify-center items-center">
     <div class="bg-white p-8 rounded-lg ring-2 ring-gray-600 shadow-md w-full max-w-3xl">
         <h1 class="text-3xl font-bold mb-4">Detail Pendaftaran Beasiswa</h1>

         <p class="mb-2 text-base">Nama Mahasiswa: {{ $user->name }}</p>
         <p class="mb-2 text-base">NIM: {{ $user->nim }}</p>
         <p class="mb-2 text-base">Prodi: {{ $user->prodi }}</p>
         <p class="mb-4 text-base">Nama Beasiswa: {{ $scholarship->name }}</p>
     </div>
 </div>
