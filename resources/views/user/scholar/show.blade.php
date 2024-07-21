@extends('user.dashboard')

@section('content')
    <div class="container mx-auto p-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('pendaftaran.store', $scholarship->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-2">
            @csrf
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-blue-600 p-6 text-white">
                    <h2 class="text-2xl font-bold">Informasi Beasiswa: {{ $scholarship->name }}</h2>
                </div>

                <div class="p-4 space-y-4">
                    <div class="bg-blue-50 py-2 px-2 rounded-lg border-2 border-blue-200 shadow-sm">
                        <h5 class="text-xl font-semibold text-left mx-4 my-2 pb-10">Pendaftaran Beasiswa
                            {{ $scholarship->scholarship->name }}</h5>

                        @php
                            $now = \Carbon\Carbon::now();
                            $end_date = \Carbon\Carbon::parse($scholarship->end_registration_at);
                            $days_left = $end_date->diffInDays($now);
                        @endphp

                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-6">
                            <div class="flex flex-col items-center space-y-2">
                                <i class="bi bi-cash-stack text-sky-500 text-4xl"></i>
                                <span class="text-sky-500 text-center font-semibold">Nominal</span>
                                <span class="px-1 py-[0.5] rounded text-white bg-sky-400 text-center font-semibold">Rp
                                    {{ number_format($scholarship->amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex flex-col items-center space-y-2">
                                <!-- Ganti ikon untuk durasi -->
                                <i class="bi bi-hourglass-split text-sky-500 text-4xl"></i>
                                <span class="text-sky-500 text-center font-semibold">Durasi</span>
                                <span
                                    class="px-1 py-[0.5] rounded text-white bg-sky-400 text-center font-semibold">{{ $scholarship->duration }}
                                    Bulan</span>
                            </div>
                            <div class="flex flex-col items-center space-y-2">
                                <i class="bi bi-calendar-check text-sky-500 text-4xl"></i>
                                <span class="text-sky-500 text-center font-semibold">Akhir Pendaftaran</span>
                                <span
                                    class="px-1 py-[0.5] rounded text-white bg-sky-400 text-center font-semibold">{{ $end_date->format('d M Y') }}</span>
                            </div>
                            <div class="flex flex-col items-center space-y-2">
                                <i class="bi bi-bar-chart-line text-sky-500 text-4xl"></i>
                                <span class="text-sky-500 text-center font-semibold">Minimal IPK</span>
                                <span
                                    class="px-1 py-[0.5] rounded text-white bg-sky-400 text-center font-semibold">{{ number_format($scholarship->min_ipk, 2) }}</span>
                            </div>
                        </div>

                        @if ($days_left <= 5)
                            <div class="text-red-500 font-semibold text-left mx-2 my-2 mt-10">Masa pendaftaran tersisa
                                {{ $days_left }}
                                hari lagi!</div>
                        @endif
                    </div>

                </div>

                <div class="p-6 space-y-6">
                    <h5 class="text-lg font-semibold text-gray-800">Berkas yang Diperlukan</h5>
                    <p class="text-sm text-gray-500 mt-2">
                        Berikut adalah beberapa hal yang perlu diperhatikan saat mengunggah file PDF:
                    </p>
                    <ul class="list-disc list-inside text-sm text-gray-500 mt-2 pl-5">
                        <li>File harus memiliki format <strong>PDF</strong>.</li>
                        <li>Ukuran file tidak boleh melebihi batas yang ditentukan yaitu <strong>10MB</strong>.</li>
                        <li>Periksa kembali file sebelum mengunggah untuk memastikan semua informasi yang diperlukan telah
                            disertakan.</li>
                        <li>Upload file sesuai dengan berkas yang ditentukan.</li>
                    </ul>

                    <div class="bg-white p-4 shadow rounded-lg">
                        <label for="supervisor_approval_file" class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="text-pink-500">*</span> Surat Rekomendasi Dosen Wali
                        </label>
                        <div
                            class="relative border-2 border-gray-300 border-dashed rounded-lg p-4 bg-gray-50 text-gray-600">
                            <input type="file" id="file_input" name="supervisor_approval_file" required
                                class="absolute inset-0 opacity-0 cursor-pointer">
                            <div class="flex flex-col items-center justify-center h-full">
                                <!-- PDF Icon SVG -->
                                <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 2v12a2 2 0 002 2h10a2 2 0 002-2V6l-6-6H8a2 2 0 00-2 2zM6 14h12M6 18h12M6 10h6">
                                    </path>
                                </svg>
                                <p class="mt-2 text-sm">Drag & Drop your PDF file here, or click to select</p>
                                <div id="file_name_0" class="mt-2 text-sm text-blue-500">No file chosen</div>
                                <!-- Display file name here -->
                            </div>
                        </div>
                        @error('supervisor_approval_file')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    @foreach ($fileRequirements as $file_requirement)
                        <div class="bg-white p-4 shadow rounded-lg">
                            <label for="file_requirement_{{ $file_requirement->id }}"
                                class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="text-pink-500">*</span> {{ $file_requirement->name }}
                            </label>
                            <div
                                class="relative border-2 border-gray-300 border-dashed rounded-lg p-4 bg-gray-50 text-gray-600">
                                <input type="file" id="file_requirement_{{ $file_requirement->id }}"
                                    name="file_requirements[{{ $file_requirement->id }}]" required
                                    class="absolute inset-0 opacity-0 cursor-pointer">
                                <div class="flex flex-col items-center justify-center h-full">
                                    <!-- PDF Icon SVG -->
                                    <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 2v12a2 2 0 002 2h10a2 2 0 002-2V6l-6-6H8a2 2 0 00-2 2zM6 14h12M6 18h12M6 10h6">
                                        </path>
                                    </svg>
                                    <p class="mt-2 text-sm">Drag & Drop your PDF file here, or click to select</p>
                                    <div id="file_name_{{ $file_requirement->id }}" class="mt-2 text-sm text-blue-500">No
                                        file chosen</div> <!-- Display file name here -->
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <input type="hidden" name="scholarship_data_id" value="{{ $scholarship->id }}">


                    <div class="flex space-x-4 mt-6">
                        <button type="submit" name="daftar"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Daftar</button>
                        <a href="{{ route('pendaftaran.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">Kembali</a>
                    </div>
                </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Function to handle file upload
            const handleFileUpload = (fileInput, fileNameDisplay) => {
                // Handle file selection
                fileInput.addEventListener('change', (event) => {
                    const files = event.target.files;
                    if (files.length > 0) {
                        fileNameDisplay.textContent = files[0].name; // Display the name of the file
                    } else {
                        fileNameDisplay.textContent =
                            'No file chosen'; // Default text if no file is selected
                    }
                });

                // Handle file drop
                const dropArea = fileInput.closest('.relative');
                dropArea.addEventListener('dragover', (event) => {
                    event.preventDefault();
                    dropArea.classList.add('bg-gray-100');
                });

                dropArea.addEventListener('dragleave', () => {
                    dropArea.classList.remove('bg-gray-100');
                });

                dropArea.addEventListener('drop', (event) => {
                    event.preventDefault();
                    dropArea.classList.remove('bg-gray-100');
                    const files = event.dataTransfer.files;
                    if (files.length > 0) {
                        fileInput.files = files; // Update the input files list
                        fileNameDisplay.textContent = files[0].name; // Display the name of the file
                    }
                });

                // Open file dialog on drop area click
                dropArea.addEventListener('click', () => fileInput.click());
            };

            // Handle file input for supervisor_approval_file
            const supervisorFileInput = document.querySelector('#file_input');
            const supervisorFileNameDisplay = document.querySelector('#file_name_0');
            if (supervisorFileInput && supervisorFileNameDisplay) {
                handleFileUpload(supervisorFileInput, supervisorFileNameDisplay);
            }

            // Handle file input for file requirements
            document.querySelectorAll('.relative').forEach(dropArea => {
                const fileInput = dropArea.querySelector('input[type="file"]');
                const fileNameDisplay = dropArea.querySelector('[id^="file_name_"]');
                if (fileInput && fileNameDisplay) {
                    handleFileUpload(fileInput, fileNameDisplay);
                }
            });
        });
    </script>
@endsection
