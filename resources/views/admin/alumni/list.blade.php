@extends('admin.dashboard')

@section('navbar', 'Pengusul')

@section('content')
    <h2 class="text-lg font-semibold mb-4">Alumni Beasiswa</h2>
    <div class="table-responsive">
        <table class="min-w-full bg-white border border-gray-300 text-sm">
            <thead>
                <tr class="border-b-2 bg-sky-800 text-white text-start">
                    <th class="py-2 px-2 border-r">No</th>
                    <th class="py-2 px-2 border-r">Nama Beasiswa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($scholarships as $item)
                    <tr class="text-start">
                        <td class="py-2 px-2 border-r">{{ $loop->index + 1 }}</td>
                        <td class="py-2 px-2 border-r"><a href="{{ route('alumni.index', ['scholarship_id' => $item->id]) }}">
                                {{ $item->name }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
