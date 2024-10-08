@extends('admin.dashboard')

@section('navbar', 'Pengusul')

@section('content')

    <div class="bg-white p-4 mb-8 text-start text-sm">
        <h2 class="text-lg font-semibold mb-4">Daftar Nama Beasiswa Pengusul Berkas</h2>

        <div class="container mx-auto  border-gray-300 pb-4 mt-4 table-responsive">
            <table id="myTable" class="border border-gray-300 text-base border-collapse w-full">
                <thead>
                    <tr class="border-b-4 bg-sky-800 text-white text-start">
                        <th class="p-2 w-[5%] text-center border border-gray-300">No</th>
                        <th class="p-2 border table-fixed border-gray-300">Nama Beasiswa</th>
                        <th class="p-2 border w-1/12 text-center border-gray-300">Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($scholarships as $item)
                        <tr
                            class="table-fixed border border-gray-300 @if ($loop->even) @else bg-slate-50 @endif">
                            <td class="p-2 w-[5%] text-center border border-gray-300">{{ $loop->index + 1 }}</td>
                            <td class="p-2 border table-fixed border-gray-300">
                                <a
                                    href="{{ route('registrations.index', ['scholarship_id' => $item->id, 'slug' => $item->slug ?: Str::slug($item->scholarship->name)]) }}">
                                    {{ $item->scholarship->name }}
                                </a>
                            </td>
                            <td class="p-2 border w-1/12 text-center border-gray-300">{{ $item->year }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
