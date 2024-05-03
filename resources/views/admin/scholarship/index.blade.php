@extends('admin.dashboard')

@section('navbar', 'Beasiswa')

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
                <h2 class="text-xl font-semibold mb-4">Beasiswa</h2>
                <button class="bg-blue-500 hover:bg-blue-700 py-2 px-4 rounded mb-3">
                    <a href="{{ route('beasiswa.create') }}" class="text-white font-bold">
                        + Tambah Beasiswa
                    </a>
                </button>
            </div>
            <hr>

            <div class="container mx-auto  border-gray-300 pb-4 mt-4">
                <table id="myTable" class="table table-striped w-full">
                    <thead>
                        <tr class="border-b-2 bg-sky-800 text-white text-sm">
                            <th class="p-2 w-[5%] text-center">No</th>
                            <th class="p-2">Nama Beasiswa</th>
                            <th class="p-2">Nama Sumber</th>
                            <th class="p-2 w-1/12 text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($data as $item)
                            <tr class="border-b border-gray-300 @if ($loop->even) bg-slate-50 @endif">
                                <td class="p-2 text-center">{{ $i++ }}</td>
                                <td class="p-2">{{ $item->name }}</td>
                                <td class="p-2">{{ $item->donor->name }}</td>
                                <td class="p-2">
                                    <div class="flex items-center justify-center ml-2">
                                        <a href="{{ $item->slug ? route('beasiswa.edit', $item->slug) : route('beasiswa.edit', $item->id) }}"
                                            class="bg-green-500 hover:bg-green-600 hover:text-white text-slate-50 px-3 py-1 mr-2 rounded">
                                            <ion-icon name="create-sharp" class="mr-1"></ion-icon>
                                        </a>
                                        <button class="bg-red-500 hover:bg-red-600 text-slate-50 px-3 py-1 mr-1 rounded"
                                            data-name="{{ $item->name }}"
                                            data-url="{{ route('beasiswa.destroy', $item->id) }}">
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
