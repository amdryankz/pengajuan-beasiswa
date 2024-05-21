@extends('admin.dashboard')

@section('navbar', 'Edit Pengumuman')

@section('content')

    <div class="bg-gray-100 min-h-screen py-6">
        <div class="container mx-auto px-6">
            <div class="flex items-center mb-4">
                <a href="{{ route('pengumuman.index') }}"
                    class="inline-flex items-center px-2 py-1 text-blue-600 hover:bg-blue-100 rounded-lg">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
            </div>
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Pengumuman</h1>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <form action="{{ route('pengumuman.update', $data->id) }}" method="POST" enctype="multipart/form-data"
                    class="px-8 py-6">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-semibold mb-2">Judul Pengumuman</label>
                        <input type="text" name="title" id="title"
                            class="border-gray-300 focus:ring-blue-500 px-2 py-2 focus:border-blue-500 rounded-md shadow-sm w-full @error('title') @enderror"
                            value="{{ $data->title }}" required autofocus>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 font-semibold mb-2">Gambar</label>
                        <div class="relative border border-gray-300 rounded-md overflow-hidden max-w-xs max-h-64">
                            <img src="{{ Storage::url($data->image) }}" alt="Gambar Pengumuman"
                                class="object-cover w-full h-full" id="preview-image">
                            <label for="image"
                                class="absolute inset-0 flex items-center justify-center bg-transparent bg-opacity-50 hover:bg-opacity-75 transition duration-300 ease-in-out cursor-pointer">
                                <span class="text-white font-semibold">Klik untuk mengganti gambar</span>
                                <input type="file" name="image" id="image"
                                    class="absolute inset-0 opacity-0 w-full h-full cursor-pointer"
                                    onchange="previewImage()">
                            </label>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="letter_number" class="block text-gray-700 font-semibold mb-2">Nomor Surat</label>
                        <input type="text" name="letter_number" id="letter_number"
                            class="border-gray-300 focus:ring-blue-500 px-2 py-2 focus:border-blue-500 rounded-md shadow-sm w-full @error('letter_number') @enderror"
                            value="{{ $data->letter_number }}" required>
                        @error('letter_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block text-gray-700 font-semibold mb-2">Isi Pengumuman</label>
                        <div id="editor" style="height: 300px;">{!! $data->content !!}</div>
                        <input type="hidden" id="content" name="content">
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-500 text-white px-2 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        // Set value of hidden input to Quill's HTML content
        var form = document.querySelector('form');
        form.onsubmit = function() {
            var contentInput = document.querySelector('#content');
            contentInput.value = quill.root.innerHTML;
        };
    </script>

    <script>
        function previewImage() {
            const input = document.getElementById('image');
            const preview = document.getElementById('preview-image');
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                preview.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
