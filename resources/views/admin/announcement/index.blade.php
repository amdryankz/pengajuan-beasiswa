@extends('admin.dashboard')

@section('navbar', 'Pengumuman')

@section('content')

    <div class="bg-gray-50 min-h-screen py-6">
        <div class="container mx-auto px-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-800">Daftar Pengumuman Berita</h1>
                <a href="{{ route('pengumuman.create') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Buat
                    Pengumuman Baru</a>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full bg-white">
                    <thead class="bg-blue-500">
                        <tr>
                            <th class="w-1/3 px-4 py-2 text-left text-white font-semibold">Judul</th>
                            <th class="w-1/4 px-4 py-2 text-left text-white font-semibold">Tanggal</th>
                            <th class="w-1/4 px-4 py-2 text-left text-white font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($data as $announcement)
                            <tr class="border-t">
                                <td class="px-4 py-2 font-semibold font-sans">{{ $announcement->title }}</td>
                                <td class="px-4 py-2 font-semibold font-sans">
                                    {{ \Carbon\Carbon::parse($announcement->created_at)->format('d M Y') }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex items-center">
                                        <a href="{{ route('pengumuman.edit', $announcement->id) }}"
                                            class="text-blue-500 hover:underline font-semibold font-sans mr-4">Edit</a>
                                        <a href="{{ route('pengumuman.show', $announcement->id) }}"
                                            class="text-green-500 hover:underline font-semibold font-sans mr-4">Lihat</a>
                                        <form action="{{ route('pengumuman.destroy', $announcement->id) }}" method="POST"
                                            class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="text-red-500 hover:underline delete-btn font-semibold font-sans">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('.delete-form');

                    Swal.fire({
                        title: 'Apakah Anda yakin ingin menghapus pengumuman ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

@endsection
