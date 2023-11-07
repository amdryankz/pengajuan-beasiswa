@extends('admin.dashboard')

@section('navbar', 'Donatur')

@section('content')
    <div class="">
        <h2 class="text-xl font-semibold mb-4">Donatur</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="">
            <button class="bg-blue-500 hover:bg-blue-700 py-2 px-4 rounded mb-3">
                <a href="{{ route('donatur.create') }}" class="text-white font-bold">
                    + Tambah Donatur
                </a>
            </button>
        </div>

        <div class="table-responsive border border-gray-300">
            <div>
                <table class="border-collapse w-full">
                    <thead class="">
                        <tr>
                            <th class="p-2 w-[5%] text-center border border-gray-300">No</th>
                            <th class="p-2 border table-fixed border-gray-300">Nama Donatur</th>
                            <th class="p-2 border w-1/12 text-center border-gray-300">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($data as $item)
                            <tr
                                class="table-fixed border border-gray-300 @if ($loop->even) @else bg-slate-50 @endif">
                                <td class="p-2 border text-center border-gray-300">{{ $i++ }}</td>
                                <td class="p-2 border border-gray-300">{{ $item->name }}</td>
                                <td class="p-2 border border-gray-300">
                                    <div class="flex items-center justify-center ml-2">
                                        <a href="{{ route('donatur.edit', $item->id) }}"
                                            class="bg-green-500 hover:bg-green-600 text-slate-50 hover:text-slate-50 px-3 py-1 mr-2 rounded-xl">Edit</a>
                                        <button class="bg-red-500 hover:bg-red-600 text-slate-50 px-3 py-1 mr-1 rounded-xl"
                                            data-name="{{ $item->name }}"
                                            data-url="{{ route('donatur.destroy', $item->id) }}">
                                            Hapus
                                        </button>
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

    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <link rel="stylesheet" href="path/to/toastr.css">
    <script src="path/to/toastr.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('button[data-url]');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const name = this.getAttribute('data-name');
                    const url = this.getAttribute('data-url');

                    Swal.fire({
                        title: "Apakah anda yakin?",
                        text: "Ingin menghapus data " + name + "!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Anda dapat mengirimkan formulir penghapusan di sini jika pengguna mengonfirmasi
                            const deleteForm = document.createElement('form');
                            deleteForm.action = url;
                            deleteForm.method = 'POST';
                            deleteForm.innerHTML =
                                '<input type="hidden" name="_method" value="DELETE">@csrf';
                            deleteForm.style.display = 'none';
                            document.body.appendChild(deleteForm);
                            deleteForm.submit();

                            // Menampilkan SweetAlert "Deleted!" setelah penghapusan berhasil
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });

                        }
                    });
                });
            });
        });
    </script>
@endsection
