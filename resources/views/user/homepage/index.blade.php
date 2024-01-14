@extends('user.dashboard')

@section('content')
    <div class="px-8 mx-auto mt-6 flex items-center justify-center ">
        <div class="container">
            <div class="flex flex-col">

                <div class="h-28 sm:h-48 md:h-60 lg:h-72 w-full relative my-4 rounded-xl">
                    <img class="object-cover h-full w-full rounded-xl border border-gray-100 shadow-sm"
                        src="/fasilitasmahasiswa/assets/images/welcome.jpg" alt="images">

                    <h2
                        class="w-44  sm:w-60 md:w-96 mx-10 md:mx-20 flex font-medium sm:font-semibold  text-sm sm:text-xl md:text-2xl  absolute inset-y-0 items-center justify-center">
                        Halo {{ Auth::user()->name }}, Selamat Datang di Beasiswa USK
                    </h2>
                </div>

                <div class="flex flex-col gap-4 lg:gap-0 bg-white rounded-xl  h-full w-full my-4 relative"
                    x-data="{ selected: null }">
                    <button type="button"
                        class="p-5 flex justify-start items-center  text-xs sm:text-sm lg:text-base font-medium w-full h-full"
                        @click="selected !== 1 ? selected = 1 : selected = null">
                        <span class="text-md font-semibold text-slate-800">
                            Prosedur Pengajuan Peminjaman Fasilitas USK Tahun 2023
                        </span>
                    </button>
                    <div class="relative overflow-hidden transition-all max-h-0 duration-700" x-ref="container1"
                        x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                        <hr>
                        <div class="p-5 flex flex-col gap-5">
                            <div class="flex justify-center">
                                <div class="text-xs md:text-sm bg-[#F4F3F3] rounded-lg w-full h-full">
                                    <div class="font-medium mx-5 my-3 flex items-center">
                                        Memilih Prasarana
                                        <span
                                            class="ml-2 md:ml-3 bg-blue-500 text-white text-[11px] font-normal px-3  rounded-md">Tahap
                                            1</span>
                                    </div>
                                    <div class="flex mx-5 my-3 items-center">Pilihlah prasarana berdasarkan keperluan anda
                                    </div>
                                </div>
                            </div>
                            <div class="  flex justify-center">
                                <div class="text-xs md:text-sm bg-[#F4F3F3] rounded-lg w-full h-full">
                                    <div class="font-medium mx-5 my-3 flex items-center">
                                        Lihat Ketersediaan
                                        <span
                                            class="ml-2 md:ml-3 bg-blue-500 text-white text-[11px] font-normal px-3  rounded-md">Tahap
                                            2</span>
                                    </div>

                                    <div class="flex mx-5 my-3 items-center">Lihat apakah prasarana yang ingin anda sewa
                                        tersedia pada
                                        jadwal
                                    </div>
                                </div>
                            </div>
                            <div class=" flex justify-center">
                                <div class="text-xs md:text-sm bg-[#F4F3F3] rounded-lg w-full h-full">
                                    <div class="font-medium mx-5 my-3 flex items-center">
                                        Mengisi Formulir Sewa
                                        <span
                                            class="ml-2 md:ml-3 bg-blue-500 text-white text-[11px] font-normal px-3  rounded-md">Tahap
                                            3</span>
                                    </div>

                                    <div class="flex mx-5 my-3 items-center">Isilah formulir sewa berdasarkan kegiatan anda
                                    </div>
                                </div>
                            </div>
                            <div class=" flex justify-center">
                                <div class="text-xs md:text-sm bg-[#F4F3F3] rounded-lg w-full h-full">
                                    <div class="font-medium mx-5 my-3 flex items-center">
                                        Melakukan Pembayaran
                                        <span
                                            class="ml-2 md:ml-3 bg-blue-500 text-white text-[11px] font-normal px-3  rounded-md">Tahap
                                            4</span>
                                    </div>

                                    <div class="flex mx-5 my-3 items-center">Melakukan konfirmasi sewa dengan melakukan
                                        pembayaran sewa
                                    </div>
                                </div>
                            </div>
                            <div class=" flex justify-center">
                                <div class="text-xs md:text-sm bg-[#F4F3F3] rounded-lg w-full h-full">
                                    <div class="font-medium mx-5 my-3 flex items-center">
                                        Menunggu Konfirmasi
                                        <span
                                            class="ml-2 md:ml-3 bg-blue-500 text-white text-[11px] font-normal px-3  rounded-md">Tahap
                                            5</span>
                                    </div>

                                    <div class="flex mx-5 my-3 items-center">Menunggu konfirmasi admin terkait penyewaan,
                                        anda juga dapat
                                        menghubungi admin untuk mengingatkan terkait konfirmasi sewa
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
