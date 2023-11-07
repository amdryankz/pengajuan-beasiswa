@extends('admin.dashboard')

@section('navbar', 'Berkas')

@section('content')
    <div class="">
        <h2 class="text-xl font-semibold mb-4">Berkas</h2>

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
                <a href="{{ route('berkas.create') }}" class="text-white font-bold">
                    + Tambah Berkas
                </a>
            </button>
        </div>

        <div class="table-responsive border border-gray-300">
            <div>
                <table class="border-collapse w-full">
                    <thead class="">
                        <tr>
                            <th class="p-2 w-[5%] text-center border border-gray-300">No</th>
                            <th class="p-2 border table-fixed border-gray-300">Nama Berkas</th>
                            <th class="p-2 border w-1/12 text-center border-gray-300">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($data as $item)
                            <tr class="table-fixed border border-gray-300 @if ($loop->even) @else bg-slate-50 @endif">
                                <td class="p-2 border text-center border-gray-300">{{ $i++ }}</td>
                                <td class="p-2 border border-gray-300">{{ $item->name }}</td>
                                <td class="p-2 border border-gray-300">
                                    <div class="flex items-center justify-center ml-2">
                                        <a href="{{ route('berkas.edit', $item->id) }}"
                                           class="bg-green-500 hover:bg-green-600 text-slate-50 hover:text-slate-50 px-3 py-1 mr-2 rounded-xl">Edit</a>
                                        <button class="bg-red-500 hover:bg-red-600 text-slate-50 px-3 py-1 mr-1 rounded-xl"
                                                id="showDeleteModal" data-name="{{ $item->name }}"
                                                data-url="{{ route('berkas.destroy', $item->id) }}">
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

    <div id="deleteConfirmationModal" class="fixed inset-0  items-center justify-center z-50 hidden">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Konfirmasi Hapus Data</p>
                    <button class="modal-close cursor-pointer z-50">
                        <span class="text-2xl">&times;</span>
                    </button>
                </div>
                <div class="mb-6">
                    <p id="deleteModalMessage">Apakah Anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="text-right space-x-4">
                    <button id="cancelButton" class="modal-close bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-xl">Batal</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-xl">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const deleteModal = document.getElementById('deleteConfirmationModal');
        const showDeleteModalButtons = document.querySelectorAll('#showDeleteModal');
        const cancelButton = document.getElementById('cancelButton');
        const deleteForm = document.getElementById('deleteForm');
        const deleteModalMessage = document.getElementById('deleteModalMessage');

        showDeleteModalButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const name = this.getAttribute('data-name');
                const url = this.getAttribute('data-url');
                deleteForm.setAttribute('action', url);
                deleteModalMessage.innerHTML = `Apakah Anda yakin ingin menghapus data <strong>${name}</strong>?`;
                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex');
            });
        });

        cancelButton.addEventListener('click', function () {
            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');
        });

        const modalCloseButtons = document.querySelectorAll('.modal-close');
        modalCloseButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('flex');
            });
        });
    </script>

    @endsection