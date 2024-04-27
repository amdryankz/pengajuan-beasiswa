@extends('admin.dashboard')

@section('navbar', 'Sumber Beasiswa')

@section('content')

    <div class="p-4">
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

        <section class="bg-white p-4 mb-4">
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-4">Sumber Beasiswa</h2>
                <button class="bg-blue-500 hover:bg-blue-700 py-2 px-4 rounded mb-3">
                    <a href="{{ route('donatur.create') }}" class="text-white font-bold">
                        + Tambah Sumber
                    </a>
                </button>
            </div>
            <hr>

            <div class="container mx-auto  border-gray-300 pb-4 mt-4">
                <table id="myTable" class="border-collapse w-full">
                    <thead>
                        <tr class="border-b-2 bg-sky-800 text-white text-sm">
                            <th class="p-2 w-[5%] text-center border border-gray-300">No</th>
                            <th class="p-2 border table-fixed border-gray-300">Nama Sumber</th>
                            <th class="p-2 border w-1/12 text-center border-gray-300">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($data as $item)
                            <tr
                                class="table-fixed border border-gray-300 @if ($loop->even) bg-slate-50 @endif">
                                <td class="p-2 border text-center border-gray-300">{{ $i++ }}</td>
                                <td class="p-2 border border-gray-300">{{ $item->name }}</td>
                                <td class="p-2 border border-gray-300">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ $item->slug ? route('donatur.edit', $item->slug) : route('donatur.edit', $item->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded flex items-center">
                                            <ion-icon name="create-sharp" class="mr-1"></ion-icon>
                                        </a>
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded flex items-center"
                                            data-name="{{ $item->name }}"
                                            data-url="{{ route('donatur.destroy', $item->id) }}">
                                            <ion-icon name="trash-sharp" class="mr-1"></ion-icon>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
