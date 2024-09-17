@extends('user.layouts.main')

@section('container')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Buku Tamu</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('kunjungan') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" value="{{ @old('tanggal') }}"
                                class="form-control  @error('tanggal')
                        is-invalid
                    @enderror">
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" id="nama" name="nama" value="{{ @old('nama') }}"
                                class="form-control  @error('nama')
                        is-invalid
                    @enderror">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input type="text" id="kelas" name="kelas" value="{{ @old('kelas') }}"
                                class="form-control  @error('kelas')
                        is-invalid
                    @enderror">
                            @error('kelas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keperluan">Keperluan</label>
                            <input type="text" name="keperluan" value="{{ @old('keperluan') }}"
                                class="form-control  @error('keperluan')
                        is-invalid
                    @enderror">
                            @error('keperluan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <a href="{{ url('anggota') }}" class="btn btn-warning">Batal</a>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
