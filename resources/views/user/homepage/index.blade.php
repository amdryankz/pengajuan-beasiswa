@extends('user.dashboard')

@section('content')
    <div class="px-8 mx-auto mt-6 flex items-center justify-center ">
        <div class="container">
            <div class="flex flex-col">

                <div class="h-28 sm:h-48 md:h-60 lg:h-72 w-full relative my-4 rounded-xl">
                    <img class="object-cover h-full w-full rounded-xl border border-gray-100 shadow-sm"
                        src="https://images.unsplash.com/photo-1558591710-4b4a1ae0f04d?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D/" alt="images">

                    <h2
                        class="w-44 sm:w-60 md:w-96 mx-10 md:mx-20 flex font-medium sm:font-semibold text-sm sm:text-xl md:text-2xl absolute inset-y-0 items-center justify-center">
                        Halo {{ Auth::user()->name }}, Selamat Datang di Beasiswa USK
                    </h2>
                </div>

                <div class="flex flex-col gap-4 lg:gap-0 bg-white rounded-xl h-full w-full my-4 relative"
                    x-data="{ selected: null }">
                    <button type="button"
                        class="p-5 flex justify-start items-center text-xs sm:text-sm lg:text-base font-medium w-full h-full"
                        @click="selected !== 1 ? selected = 1 : selected = null">
                        <span class="text-md font-semibold text-slate-800">
                            Prosedur Pengajuan Pendaftaran Beasiswa USK Tahun 2024
                        </span>
                    </button>
                    <div class="relative overflow-hidden transition-all max-h-0 duration-700" x-ref="container1"
                        x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                        <hr>
                        <div class="p-5 flex flex-col gap-5">
                            <div class="flex justify-center">
                                <div class="text-xs md:text-sm bg-[#F4F3F3] rounded-lg w-full h-full shadow-md">
                                    <div class="font-medium mx-2 sm:mx-5 my-3 flex items-center">
                                        Memilih Beasiswa
                                        <span
                                            class="ml-2 md:ml-3 bg-blue-500 text-white text-[11px] font-normal px-2 sm:px-3 rounded-md">Tahap
                                            1</span>
                                    </div>
                                    <div class="flex mx-2 sm:mx-5 my-3 items-center">Pilihlah Beasiswa yang ingin anda daftar
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="text-xs md:text-sm bg-[#F4F3F3] rounded-lg w-full h-full shadow-md">
                                    <div class="font-medium mx-2 sm:mx-5 my-3 flex items-center">
                                        Lengkapi Dokumen
                                        <span
                                            class="ml-2 md:ml-3 bg-blue-500 text-white text-[11px] font-normal px-2 sm:px-3 rounded-md">Tahap
                                            2</span>
                                    </div>
                                    <div class="flex mx-2 sm:mx-5 my-3 items-center">Lengkapilah dokumen penting yang diperlukan sesuai syarat dan ketentuan dari beasiswa yang anda pilih sebelumnya
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="text-xs md:text-sm bg-[#F4F3F3] rounded-lg w-full h-full shadow-md">
                                    <div class="font-medium mx-2 sm:mx-5 my-3 flex items-center">
                                        Melengkapi Biodata
                                        <span
                                            class="ml-2 md:ml-3 bg-blue-500 text-white text-[11px] font-normal px-2 sm:px-3 rounded-md">Tahap
                                            3</span>
                                    </div>
                                    <div class="flex mx-2 sm:mx-5 my-3 items-center">Isilah biodata anda dengan lengkap pada halaman biodata
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="text-xs md:text-sm bg-[#F4F3F3] rounded-lg w-full h-full shadow-md">
                                    <div class="font-medium mx-2 sm:mx-5 my-3 flex items-center">
                                        Periksa Jadwal pendaftaran beasiswa
                                        <span
                                            class="ml-2 md:ml-3 bg-blue-500 text-white text-[11px] font-normal px-2 sm:px-3 rounded-md">Tahap
                                            4</span>
                                    </div>
                                    <div class="flex mx-2 sm:mx-5 my-3 items-center">Periksalah secara berkala tanggal pendaftaran dan akhir pendaftaran beasiswa supaya anda tidak terlewatkan beasiswa impian anda
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="text-xs md:text-sm bg-[#F4F3F3] rounded-lg w-full h-full shadow-md">
                                    <div class="font-medium mx-2 sm:mx-5 my-3 flex items-center">
                                        Menunggu proses
                                        <span
                                            class="ml-2 md:ml-3 bg-blue-500 text-white text-[11px] font-normal px-2 sm:px-3 rounded-md">Tahap
                                            5</span>
                                    </div>
                                    <div class="flex mx-2 sm:mx-5 my-3 items-center">Jika anda sudah mendaftar, maka silahkan menunggu proses konfirmasi berkas dokumen anda. Anda dapat menjumpai atau menghubungi Administrator di Biro Kemahasiswaan USK jika ada kendala.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
