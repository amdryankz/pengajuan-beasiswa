@extends('user.dashboard')

@section('content')
    <div class="container">
        <h2 class="text-center mb-4 text-xl text-blue-600 font-bold">BIODATA MAHASISWA</h2>
        <div class="row">
            <!-- Kolom kiri (informasi yang tidak dapat diubah) -->
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm rounded">
                    <div class="card-body">
                        <h5 class="card-title text-lg font-semibold fs-5">Informasi Pribadi</h5>
                        <ul class="list-group list-group-flush text-base">
                            <div class="flex flex-col space-y-2">
                                <div class="flex flex-col mb-1">
                                    <span class="font-semibold">NIM:</span>
                                    <div class="border-sky-500 border-solid border-1 rounded-md p-2 mt-1 bg-slate-50">
                                        <span>{{ $user->nim }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col mb-1">
                                    <span class="font-semibold">Nama:</span>
                                    <div class="border-sky-500 border-solid border-1 rounded-md p-2 mt-1 bg-slate-50">
                                        <span>{{ $user->name }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col mb-1">
                                    <span class="font-semibold">Fakultas:</span>
                                    <div class="border-sky-500 border-solid border-1 rounded-md p-2 mt-1 bg-slate-50">
                                        <span>{{ $user->fakultas }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col mb-1">
                                    <span class="font-semibold">Jurusan:</span>
                                    <div class="border-sky-500 border-solid border-1 rounded-md p-2 mt-1 bg-slate-50">
                                        <span>{{ $user->prodi }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col mb-1">
                                    <span class="font-semibold">IPK Terakhir:</span>
                                    <div class="border-sky-500 border-solid border-1 rounded-md p-2 mt-1 bg-slate-50">
                                        <span>{{ number_format($user->ipk, 2, '.', '') }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col mb-1">
                                    <span class="font-semibold">Jumlah SKS yang telah diambil:</span>
                                    <div class="border-sky-500 border-solid border-1 rounded-md p-2 mt-1 bg-slate-50">
                                        <span>{{ $user->total_sks }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col mb-1">
                                    <span class="font-semibold">Jenis Kelamin:</span>
                                    <div class="border-sky-500 border-solid border-1 rounded-md p-2 mt-1 bg-slate-50">
                                        <span>{{ $user->jk }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col mb-1">
                                    <span class="font-semibold">Tanggal Lahir:</span>
                                    <div class="border-sky-500 border-solid border-1 rounded-md p-2 mt-1 bg-slate-50">
                                        <span>{{ $user->birthdate->format('d-m-Y') }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col mb-1">
                                    <span class="font-semibold">Tempat Lahir:</span>
                                    <div class="border-sky-500 border-solid border-1 rounded-md p-2 mt-1 bg-slate-50">
                                        <span>{{ $user->birthplace }}</span>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>


            <!-- Kolom kanan (update data) -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-base fs-5">Update Informasi</h5>
                        <form action="{{ route('biodata.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="no_hp" class="form-label font-semibold text-base">Nomor HP:</label>
                                <input type="text" name="no_hp"
                                    class="form-control border-sky-500 border-solid border-1 rounded-md p-2 text-base bg-slate-50"
                                    value="{{ old('no_hp', $user->no_hp) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="no_rek" class="form-label font-semibold text-base">Nomor Rekening:</label>
                                <input type="text" name="no_rek"
                                    class="form-control border-sky-500 border-solid border-1 rounded-md p-2 text-base bg-slate-50"
                                    value="{{ old('no_rek', $user->no_rek) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="name_rek" class="form-label font-semibold text-base">Nama Pada Rekening:</label>
                                <input type="text" name="name_rek"
                                    class="form-control border-sky-500 border-solid border-1 rounded-md p-2 text-base bg-slate-50"
                                    value="{{ old('name_rek', $user->name_rek) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="name_bank" class="form-label font-semibold text-base">Nama Bank:</label>
                                <input type="text" name="name_bank"
                                    class="form-control border-sky-500 border-solid border-1 rounded-md p-2 text-base bg-slate-50"
                                    value="{{ old('name_bank', $user->name_bank) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="name_parent" class="form-label font-semibold text-base">Nama Orang Tua:</label>
                                <input type="text" name="name_parent"
                                    class="form-control border-sky-500 border-solid border-1 rounded-md p-2 text-base bg-slate-50"
                                    value="{{ old('name_parent', $user->name_parent) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="income_parent" class="form-label font-semibold text-base">Penghasilan Orang Tua:</label>
                                <select name="income_parent"
                                    class="form-select text-slate-900 border-sky-500 border-solid border-1 rounded-md p-2 text-base bg-slate-50"
                                    required>
                                    <option value="" selected disabled>Pilih</option>
                                    <option value="<= Rp 500.000"
                                        {{ old('income_parent', $user->income_parent) == '<= Rp 500.000' ? 'selected' : '' }}>
                                        <= Rp 500.000</option>
                                    <option value="Rp 500.000 - Rp 1.000.000"
                                        {{ old('income_parent', $user->income_parent) == 'Rp 500.000 - Rp 1.000.000' ? 'selected' : '' }}>
                                        Rp 500.000 - Rp 1.000.000</option>
                                    <option value="Rp 1.000.000 - Rp 1.500.000"
                                        {{ old('income_parent', $user->income_parent) == 'Rp 1.000.000 - Rp 1.500.000' ? 'selected' : '' }}>
                                        Rp 1.000.000 - Rp 1.500.000</option>
                                    <option value="Rp 1.500.000 - Rp 2.000.000"
                                        {{ old('income_parent', $user->income_parent) == 'Rp 1.500.000 - Rp 2.000.000' ? 'selected' : '' }}>
                                        Rp 1.500.000 - Rp 2.000.000</option>
                                    <option value="Rp 2.000.000 - Rp 2.500.000"
                                        {{ old('income_parent', $user->income_parent) == 'Rp 2.000.000 - Rp 2.500.000' ? 'selected' : '' }}>
                                        Rp 2.000.000 - Rp 2.500.000</option>
                                    <option value="Rp 2.500.000 - Rp 3.000.000"
                                        {{ old('income_parent', $user->income_parent) == 'Rp 2.500.000 - Rp 3.000.000' ? 'selected' : '' }}>
                                        Rp 2.500.000 - Rp 3.000.000</option>
                                    <option value="Rp 3.000.000 - Rp 4.000.000"
                                        {{ old('income_parent', $user->income_parent) == 'Rp 3.000.000 - Rp 4.000.000' ? 'selected' : '' }}>
                                        Rp 3.000.000 - Rp 4.000.000</option>
                                    <option value="Rp 4.000.000 - Rp 5.000.000"
                                        {{ old('income_parent', $user->income_parent) == 'Rp 4.000.000 - Rp 5.000.000' ? 'selected' : '' }}>
                                        Rp 4.000.000 - Rp 5.000.000</option>
                                    <option value="Rp 5.000.000 - Rp 7.500.000"
                                        {{ old('income_parent', $user->income_parent) == 'Rp 5.000.000 - Rp 7.500.000' ? 'selected' : '' }}>
                                        Rp 5.000.000 - Rp 7.500.000</option>
                                    <option value="Rp 7.500.000 - Rp 10.000.000"
                                        {{ old('income_parent', $user->income_parent) == 'Rp 7.500.000 - Rp 10.000.000' ? 'selected' : '' }}>
                                        Rp 7.500.000 - Rp 10.000.000</option>
                                    <option value="Rp 10.000.000 - Rp 15.000.000"
                                        {{ old('income_parent', $user->income_parent) == 'Rp 10.000.000 - Rp 15.000.000' ? 'selected' : '' }}>
                                        Rp 10.000.000 - Rp 15.000.000</option>
                                    <option value="> Rp 15.000.000"
                                        {{ old('income_parent', $user->income_parent) == '> Rp 15.000.000' ? 'selected' : '' }}>
                                        > Rp 15.000.000</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="job_parent" class="form-label font-semibold text-base">Pekerjaan Orang Tua:</label>
                                <input type="text" name="job_parent"
                                    class="form-control border-sky-500 border-solid border-1 rounded-md p-2 text-base bg-slate-50"
                                    value="{{ old('job_parent', $user->job_parent) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label font-semibold text-base">Alamat Orang Tua:</label>
                                <input type="text" name="address"
                                    class="form-control border-sky-500 border-solid border-1 rounded-md p-2 text-base bg-slate-50"
                                    value="{{ old('address', $user->address) }}" required>
                            </div>
                            <div class="mt-8">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Perbarui Profil
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
