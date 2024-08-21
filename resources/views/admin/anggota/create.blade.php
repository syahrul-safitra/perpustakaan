@extends('admin.layouts.main')

@section('container')
    <div class="row">
        <div class="col-lg-10">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Anggota</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('anggota') }}" method="POST" enctype=multipart/form-data>
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" id="name" name="name" value="{{ @old('name') }}"
                                class="form-control  @error('name')
                            is-invalid
                        @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nis">NIS</label>
                            <input type="text" id="nis" name="nis" value="{{ @old('nis') }}"
                                class="form-control  @error('nis')
                            is-invalid
                        @enderror">
                            @error('nis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ @old('email') }}"
                                class="form-control  @error('email')
                            is-invalid
                        @enderror">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" name="password" value="{{ @old('password') }}"
                                class="form-control  @error('password')
                            is-invalid
                        @enderror">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input type="file" onchange="previewImage()" id="image" name="gambar"
                                class="mb-3 form-control @error('gambar') 'is-invalid' @enderror">
                            <img src="" alt="" id="img-preview" width="300px;height:300px">
                            @error('gambar')
                                <p class="text-danger">{{ $message }}</p>
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
