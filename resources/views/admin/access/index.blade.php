@extends('admin.dashboard')

@section('navbar', 'Pengguna')

@section('content')
    <p class="text-2xl font-bold mb-4">Pengguna</p>
    <div class="mb-4">
        <a href="{{ route('access.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Pengguna
        </a>
    </div>
    <div class="overflow-x-auto">
        <table id="myTable" class="min-w-full bg-white border border-gray-300" >
            <thead>
                <tr class="border-b-2 bg-sky-800 text-white text-sm">
                    <th class="py-1 px-1 border-b border-r text-center">No</th>
                    <th class="py-1 px-2 border-b border-r">NIP</th>
                    <th class="py-1 px-2 border-b border-r">Nama</th>
                    <th class="py-1 px-2 border-b border-r">Hak Akses</th>
                    <th class="py-1 px-2 border-b border-r">Status</th>
                    <th class="py-1 px-4 border-b border-r text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($data as $item)
                    <tr class="text-sm text-start">
                        <td class="py-1 px-1 border-b text-center">{{ $i++ }}</td>
                        <td class="py-1 px-2 border-b">{{ $item->nip }}</td>
                        <td class="py-1 px-2 border-b">{{ $item->name }}</td>
                        <td class="py-1 px-2 border-b">{{ $item->role ? $item->role->name : 'Tidak ada' }}</td>
                        <td class="py-1 px-2 border-b">{{ $item->status }}</td>
                        <td class="py-1 px-4 border-b">
                            <div class="flex space-x-2">
                                <a href="{{ route('access.edit', $item->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded flex items-center">
                                    <ion-icon name="create-sharp" class="mr-1"></ion-icon>
                                </a>
                                <form onsubmit="return confirm('Yakin mau hapus data ini?')"
                                    action="{{ route('access.destroy', $item->id) }}" class="inline-block" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded flex items-center">
                                        <ion-icon name="trash-sharp" class="mr-1"></ion-icon>
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
