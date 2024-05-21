@extends('admin.dashboard')

@section('navbar', 'Berita Pengumuman')

@section('content')

    <div class="bg-gray-50 min-h-screen py-6">
        <div class="container mx-auto px-6">
            <div class="bg-white shadow-md rounded-md overflow-hidden">
                <div
                    class="border-b-2 border-gray-100 px-2 py-4 transition duration-300 ease-in-out transform hover:shadow-md mx-auto my-auto text-start">
                    <h1 class="text-2xl font-medium font-sans text-slate-700 mx-1 my-2">{{ $data->title }}</h1>
                </div>

                <div class="p-6">
                    <div class="text-gray-700">
                        <div
                            class="my-2 flex items-center justify-center border-1 py-2 px-1 transition duration-300 ease-in-out transform hover:shadow-md rounded-lg max-w-full">
                            <img src="{{ asset('storage/' . $data->image) }}" alt="Gambar Pengumuman"
                                class="max-w-full w-full max-h-96 object-contain rounded-lg">
                        </div>
                        <div class="flex justify-start items-start mb-4">
                            <p><i
                                    class="bi bi-calendar2-date mr-2"></i>{{ \Carbon\Carbon::parse($data->created_at)->locale('id')->isoFormat('dddd') }},
                                <span
                                    class="font-medium">{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</span>
                            </p>
                            <p class="ml-4"><i class="bi bi-card-text mr-1"></i> Nomor : <span
                                    class="font-medium">{{ $data->letter_number }}</span></p>
                        </div>
                    </div>
                    <div class="text-gray-700 leading-relaxed">
                        {!! $data->content !!}
                    </div>
                </div>
                <div class="p-6 border-t border-gray-200 text-start">
                    <a href="{{ route('pengumuman.edit', $data->id) }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 mr-2">Edit</a>
                    <a href="{{ route('pengumuman.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">Kembali</a>
                </div>
            </div>
        </div>
    </div>

@endsection
