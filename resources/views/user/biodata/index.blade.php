@extends('user.dashboard')

@section('content')
    <div class="container">
        <h2>BIODATA</h2>
        <div class="row">
            <!-- Kolom kiri (informasi yang tidak dapat diubah) -->
            <div class="col-md-6">
                <div class="form-group row">
                    <label for="nim" class="col-sm-3 col-form-label">NPM</label>
                    <div class="col-sm-8">
                        <p class="form-control-static mt-3">{{ $user->nim }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <p class="form-control-static mt-3">{{ $user->name }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Fakultas</label>
                    <div class="col-sm-8">
                        <p class="form-control-static mt-3">{{ $user->fakultas }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Jurusan</label>
                    <div class="col-sm-8">
                        <p class="form-control-static mt-3">{{ $user->prodi }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">IPK Terakhir</label>
                    <div class="col-sm-8">
                        <p class="form-control-static mt-3">{{ number_format($user->ipk, 2, '.', '') }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Jumlah SKS yang telah diambil</label>
                    <div class="col-sm-8">
                        <p class="form-control-static mt-3">{{ $user->total_sks }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-8">
                        <p class="form-control-static mt-3">{{ $user->jk }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-8">
                        <p class="form-control-static mt-3">{{ $user->birthdate->format('d-m-Y') }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-8">
                        <p class="form-control-static mt-3">{{ $user->birthplace }}</p>
                    </div>
                </div>
            </div>

            <!-- Kolom kanan (update data) -->
            <div class="col-md-6">
                <form action="{{ route('biodata.update') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class=" col-form-label fs-5">Informasi Tambahan</label>
                    </div>
                    <div class="form-group row">
                        <label for="no_hp" class="col-sm-4 col-form-label">Nomor HP</label>
                        <div class="col-sm-8">
                            <input type="tel" name="no_hp" class="form-control"
                                value="{{ old('no_hp', $user->no_hp) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_rek" class="col-sm-4 col-form-label">Nomor Rekening</label>
                        <div class="col-sm-8">
                            <input type="text" name="no_rek" class="form-control"
                                value="{{ old('no_rek', $user->no_rek) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name_rek" class="col-sm-4 col-form-label">Nama Pada Rekening</label>
                        <div class="col-sm-8">
                            <input type="text" name="name_rek" class="form-control"
                                value="{{ old('name_rek', $user->name_rek) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name_bank" class="col-sm-4 col-form-label">Nama Bank</label>
                        <div class="col-sm-8">
                            <input type="text" name="name_bank" class="form-control"
                                value="{{ old('name_bank', $user->name_bank) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name_parent" class="col-sm-4 col-form-label">Nama Orang Tua</label>
                        <div class="col-sm-8">
                            <input type="text" name="name_parent" class="form-control"
                                value="{{ old('name_parent', $user->name_parent) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="income_parent" class="col-sm-4 col-form-label">Penghasilan Orang Tua</label>
                        <div class="col-sm-8 mt-2">
                            <select name="income_parent" class="form-control" required>
                                <option value="" selected disabled>Pilih</option>
                                <option value="<= Rp 500.000"
                                    {{ old('income_parent', $user->income_parent) == '<= Rp 500.000' ? 'selected' : '' }}>
                                    <= Rp 500.000</option>
                                <option value="Rp 500.000 - Rp 1.000.000"
                                    {{ old('income_parent', $user->income_parent) == 'Rp 500.000 - Rp 1.000.000' ? 'selected' : '' }}>
                                    Rp 500.000 - Rp 1.000.000</option>
                                <option
                                    value="Rp 1.000.000 - Rp 1.500.000"{{ old('income_parent', $user->income_parent) == 'Rp 1.000.000 - Rp 1.500.000' ? 'selected' : '' }}>
                                    Rp 1.000.000 - Rp 1.500.000</option>
                                <option
                                    value="Rp 1.500.000 - Rp 2.000.000"{{ old('income_parent', $user->income_parent) == 'Rp 1.500.000 - Rp 2.000.000' ? 'selected' : '' }}>
                                    Rp 1.500.000 - Rp 2.000.000</option>
                                <option
                                    value="Rp 2.000.000 - Rp 2.500.000"{{ old('income_parent', $user->income_parent) == 'Rp 2.000.000 - Rp 2.500.000' ? 'selected' : '' }}>
                                    Rp 2.000.000 - Rp 2.500.000</option>
                                <option
                                    value="Rp 2.500.000 - Rp 3.000.000"{{ old('income_parent', $user->income_parent) == 'Rp 2.500.000 - Rp 3.000.000' ? 'selected' : '' }}>
                                    Rp 2.500.000 - Rp 3.000.000</option>
                                <option
                                    value="Rp 3.000.000 - Rp 4.000.000"{{ old('income_parent', $user->income_parent) == 'Rp 3.000.000 - Rp 4.000.000' ? 'selected' : '' }}>
                                    Rp 3.000.000 - Rp 4.000.000</option>
                                <option
                                    value="Rp 4.000.000 - Rp 5.000.000"{{ old('income_parent', $user->income_parent) == 'Rp 4.000.000 - Rp 5.000.000' ? 'selected' : '' }}>
                                    Rp 4.000.000 - Rp 5.000.000</option>
                                <option
                                    value="Rp 5.000.000 - Rp 7.500.000"{{ old('income_parent', $user->income_parent) == 'Rp 5.000.000 - Rp 7.500.000' ? 'selected' : '' }}>
                                    Rp 5.000.000 - Rp 7.500.000</option>
                                <option
                                    value="Rp 7.500.000 - Rp 10.000.000"{{ old('income_parent', $user->income_parent) == 'Rp 7.500.000 - Rp 10.000.000' ? 'selected' : '' }}>
                                    Rp 7.500.000 - Rp 10.000.000</option>
                                <option
                                    value="Rp 10.000.000 - Rp 15.000.000"{{ old('income_parent', $user->income_parent) == 'Rp 10.000.000 - Rp 15.000.000' ? 'selected' : '' }}>
                                    Rp 10.000.000 - Rp 15.000.000</option>
                                <option
                                    value="> Rp 15.000.000"{{ old('income_parent', $user->income_parent) == '> Rp 15.000.000' ? 'selected' : '' }}>
                                    > Rp 15.000.000</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="job_parent" class="col-sm-4 col-form-label">Pekerjaan Orang Tua</label>
                        <div class="col-sm-8">
                            <input type="text" name="job_parent" class="form-control"
                                value="{{ old('job_parent', $user->job_parent) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-4 col-form-label">Alamat Orang Tua</label>
                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control"
                                value="{{ old('address', $user->address) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8 offset-sm-4">
                            <button type="submit" class="btn btn-primary">Perbarui Profil</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
