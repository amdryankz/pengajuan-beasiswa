@extends('admin.dashboard')

@section('content')
    <div class="pb-3"><a href="{{ route('khusus.index') }}" class="btn btn-secondary">
            << Kembali</a>
    </div>
    <form action="{{ route('khusus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="scholarship_data_id" class="form-label">Pilih Beasiswa</label>
            <select class="form-select" name="scholarship_data_id" id="scholarship_data_id">
                <option>-- Pilih --</option>
                @foreach ($data as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="donor_id" class="form-label">Nama Donatur</label>
            <select class="form-select" name="donor_id" id="donor_id" disabled>
                <option>-- Pilih --</option>
            </select>
        </div>
        <div class="mb-3">
            <input type="file" name="list_students" id="list_students">
        </div>
        <button class="btn btn-primary" name="simpan" type="submit">SIMPAN</button>
    </form>

    <script>
        document.getElementById('scholarship_data_id').addEventListener('change', function() {
            var scholarshipId = this.value;
            var donorSelect = document.getElementById('donor_id');

            // Hapus semua opsi sebelum menambahkan yang baru
            donorSelect.innerHTML = '';

            // Tambahkan opsi yang sesuai dengan beasiswa yang dipilih
            @foreach ($data as $item)
                if ({{ $item->id }} == scholarshipId) {
                    var option = document.createElement('option');
                    option.value = {{ $item->donor->id }};
                    option.text = '{{ $item->donor->name }}';
                    donorSelect.add(option);
                }
            @endforeach

        });
    </script>
@endsection
