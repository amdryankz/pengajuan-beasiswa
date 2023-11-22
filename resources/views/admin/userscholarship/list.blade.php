@extends('admin.dashboard')

@section('navbar', 'Pengusul')

@section('content')
    <h2 class="text-lg font-semibold mb-4">Daftar Nama Beasiswa</h2>


    <div class="mb-3 flex items-center relative">
        <div class="flex items-center">
            <input type="text" id="search" placeholder="Search..."
                class="p-1 border-2 rounded-lg border-gray-300 focus:ring-1 focus:ring-sky-500 placeholder:text-slate-300 placeholder:text-sm">
        </div>
    </div>

    <div class="table-responsive">
        <table class=" bg-white border border-gray-300 text-base border-collapse w-full">
            <thead>
                <tr class="border-b-2 bg-sky-800 text-white text-start">
                    <th class="p-2 w-[5%] text-center border border-gray-300">No</th>
                    <th class="p-2 border table-fixed border-gray-300">Nama Beasiswa</th>
                    <th class="p-2 border w-1/12 text-center border-gray-300">Tahun</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($scholarships as $item)
                    <tr class="table-fixed border border-gray-300 @if ($loop->even) @else bg-slate-50 @endif">
                        <td class="p-2 w-[5%] text-center border border-gray-300">{{ $loop->index + 1 }}</td>
                        <td class="p-2 border table-fixed border-gray-300"><a
                                href="{{ route('registrations.index', ['scholarship_id' => $item->id]) }}">{{ $item->name }}</a>
                        </td>
                        <td class="p-2 border w-1/12 text-center border-gray-300">{{ $item->year }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>




@endsection
